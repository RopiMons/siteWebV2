<?php

namespace Ropi\IdentiteBundle\Controller;

use Ropi\AuthenticationBundle\Form\changePWDType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ListingController extends Controller
{
    

    
    /**
     * @Route("/admin/user/listing", name="Ropi_admin_user_listing")
     * @Template()
     */
     public function listingUserAction(Request $request) {

         $repoUser= $this->getDoctrine()->getRepository("Ropi\identiteBundle\Entity\Personne");
         $users = $repoUser->findAll();

    dump($users);

        return array("users"=>$users);
    }
    

}
