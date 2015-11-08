<?php

namespace Ropi\IdentiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ropi\IdentiteBundle\Entity\Contact;
use Ropi\IdentiteBundle\Entity\Personne;
use Ropi\IdentiteBundle\Form\PersonneType;
use Ropi\IdentiteBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Ropi\IdentiteBundle\Entity\Adresse;
use Ropi\AuthenticationBundle\Entity\KeyValidation;


class AccountController extends Controller
{
    /**
     * @Route("/my/account/", name="ropi_account")
     * @Template()
     */
    public function accountAction(Request $request)
    {

        $user = $this->container->get('security.context')->getToken()->getUser();


        return array('user'=> $user->getPersonne()) ;
    }

}
