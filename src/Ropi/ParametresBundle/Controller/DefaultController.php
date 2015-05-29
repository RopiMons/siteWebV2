<?php

namespace Ropi\ParametresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller
{
    /**
     * @Secure(roles={"ROLE_ADMIN"})
     * 
     * @Route("/my/admin", name="admin_home")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        return array(
            'nvCommercants' => $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce")->getCountNoValidatesCommercant(),
        ) 
        ;
                
    }
}
