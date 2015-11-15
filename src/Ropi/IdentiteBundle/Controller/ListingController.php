<?php

namespace Ropi\IdentiteBundle\Controller;

use Ropi\AuthenticationBundle\Form\changePWDType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ListingController extends Controller
{
    

    
    /**
     * @Route("/admin/user/listing", name="Ropi_admin_user_listing")
     * @Secure(roles={"ROLE_ADMIN"})
     * @Template()
     */
     public function listingUserAction(Request $request) {

         $repoUser= $this->getDoctrine()->getRepository("Ropi\identiteBundle\Entity\Personne");
         $users = $repoUser->findAll();


        return array("users"=>$users);
    }
    

}
