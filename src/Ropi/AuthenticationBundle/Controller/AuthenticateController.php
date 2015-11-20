<?php

namespace Ropi\AuthenticationBundle\Controller;

use Ropi\AuthenticationBundle\Form\IdentifiantWebType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Ropi\IdentiteBundle\Entity\Personne;

class AuthenticateController extends Controller
{
    
    /**
     * @Route("/login", name="login")
     *
     */
   public function loginAction() {
       if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
           return $this->redirect($this->generateUrl("Ropi_ok"));
       }
        $request = $this->getRequest();
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('RopiAuthenticationBundle:Authenticate:login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
        ));
    }
    /**
     * @Route("/my",name="Ropi_ok")
     * @Secure(roles={"ROLE_UTILISATEUR_ACTIVE","ROLE_COMMERCANT","ROLE_ADMIN","ROLE_CMS_CREATE"})
     */
     public function okAction() {
        
        $notification = array();
        $em = $this->getDoctrine()->getManager();

        $this->getUser()->setLastConnection(new \DateTime());
        $em->persist($this->getUser());
        $em->flush();
        
         /*
          * Gestion des notifications
          * il faut juste crée une vue notification et passer un tableau avec la vue et les parametre de la vue.
          */
        
        return $this->render("RopiAuthenticationBundle:Authenticate:ok.html.twig");
    }
    
    /**
     * @Route("/confirmation/{id}/{key}",name="Ropi_Key")
     *
     */
     public function testKeyAction(Request $request,IdentifiantWeb $id,$key) {
        
        if ($key != null && $id != null){
           
            
            $em = $this->getDoctrine()->getRepository('RopiAuthenticationBundle:KeyValidation');
            $validation = $em->findOneBy(array("id_identifiantWeb"=>$id->getId()));

           if(isset($validation) && $validation->getCle() == $key){
               dump(isset($validation));
               dump($validation->getCle() == $key);
                if($validation->getValidation()->modify('+2 day') >= new \DateTime())
               {
                   $ems2 = $this->getDoctrine() ->getRepository('RopiAuthenticationBundle:Permission');
                   $permission = $ems2->findOneBy(array("permission"=>'ROLE_UTILISATEUR_ACTIVE'));

                   $id->setActif(true);
                   $id->addPermission($permission);
                   $em = $this->getDoctrine()->getManager();
                    $em->persist($id);
                    $em->flush();
                    
                    $em->remove($validation);
                    $em->flush();

                        
                   $this->get("session")->getFlashBag()->add(
                       'success',"Votre compte à bien été validé" );
               }
               else{
                   $this->getDoctrine()->getManager()->remove($validation);
                   $this->getDoctrine()->getManager()->flush();

                   $this->get("session")->getFlashBag()->add(
                       'danger',"Votre clé de validation n'est plus valide" );
               }
               
           }
           else{
               $this->get("session")->getFlashBag()-> add(
                       'danger',"Votre clé de validation à déjà été utilisé ou à expiré" );
               }
            }
        
        
         /*
          * Gestion des notifications
          * il faut juste crée une vue notification et passer un tableau avec la vue et les parametre de la vue.
          */
        
        return $this->redirect($this->generateUrl("login"));
    }

    /**
     * @route("/admin/user/{personne}/IdentifiantWeb/",name="Ropi_admin_add_identifiantWeb")
     * @Template()
     * @Secure(roles={"ROLE_ADMIN"})
     * @param Request $request
     * @param Personne $personne
     */
    public function addIdentifiantWebAction(request $request, Personne $personne){

        if ($personne->getIdentifiantWeb() != null) throw $this->createAccessDeniedException("Vous ne pouvez pas crée un identifiant pour cette utilisateur, il en a déjà");

        $user = new IdentifiantWeb();
        $user->setPersonne($personne);
        $user->setActif(True);


        $type = new IdentifiantWebType();
        $form = $this->createForm($type, $user);
        $form->add("Enregistrer","submit");
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {




            $em = $this->getDoctrine()->getManager();

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user->getIdentifiantWeb());
            $user->getIdentifiantWeb()->setMotDePasse($encoder->encodePassword($user->getIdentifiantWeb()->getMotDePasse(), $user->getIdentifiantWeb()->getSalt()));


            $em->persist($user);

            $em->flush();


            $this->get("session")->getFlashBag()->add(
                'success',"L'identifiant à bien été crée!" );

            return $this->redirect($this->generateUrl("admin_home"));
        }
        return array("form"=>$form->createView());
    }

}
