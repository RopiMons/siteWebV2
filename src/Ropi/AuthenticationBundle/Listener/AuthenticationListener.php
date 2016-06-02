<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 2/06/16
 * Time: 21:18
 */

namespace Ropi\AuthenticationBundle\Listener;


use Doctrine\ORM\EntityManager;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Ropi\AuthenticationBundle\Entity\Permission;
use Ropi\AuthenticationBundle\Entity\Role;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class AuthenticationListener implements EventSubscriberInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public static function getSubscribedEvents()
    {
        return array(
            SecurityEvents::INTERACTIVE_LOGIN => 'onAuthenticationSuccess',
        );
    }


    public function onAuthenticationSuccess(InteractiveLoginEvent $event){

        $token = $event->getAuthenticationToken();

        if($token->isAuthenticated()) {
            /* On détermine si la personne doit avoir les droits "commerçant" */

            $this->commercantDroit($token->getUser());
        }

    }

    private function commercantDroit(IdentifiantWeb $iw){

        $role = $this->entityManager->getRepository(Role::class)->findOneBy(array(
            'nom' => 'Commercant'
        ));

        $hasCommerces = $iw->getPersonne()->getCommerces()->count();
        $isCommercant = $iw->getRole()->contains($role);

        if($hasCommerces && !$isCommercant){
            $iw->addRole($role);
        }elseif(!$hasCommerces && $isCommercant){
            $iw->removeRole($role);
        }
        
        $this->entityManager->flush();
    }

}