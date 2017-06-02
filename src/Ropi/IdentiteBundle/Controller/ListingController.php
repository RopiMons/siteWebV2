<?php

namespace Ropi\IdentiteBundle\Controller;

use Ropi\AuthenticationBundle\Form\changePWDType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ListingController extends Controller
{
    

    
    /**
     * @Route("/admin/user/listing", name="Ropi_admin_user_listing")
     * @Security( "has_role('ROLE_ADMIN')")
     * @Template()
     */
     public function listingUserAction(Request $request) {

         $repoUser= $this->getDoctrine()->getRepository("Ropi\identiteBundle\Entity\Personne");
         $users = $repoUser->findByEnable(true);


        return array("users"=>$users);
    }
    

}
