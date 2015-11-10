<?php

namespace Ropi\IdentiteBundle\Controller;

use JMS\SecurityExtraBundle\Security\Util\String;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Ropi\IdentiteBundle\Form\PersonneModifAdminType;
use Ropi\IdentiteBundle\Form\PersonneModifType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
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


    /**
     * @Route("/my/account/modification/", name="Ropi_account_modification")
     * @Secure(roles={"ROLE_ADMIN"})
     * @Template()
     */
public function modifAccountAction(Request $request){
    $user = $this->container->get('security.context')->getToken()->getUser();

    return $this->modifuser($request,$user->getPersonne(),"Votre compte à bien été modifié!","home",new PersonneModifType(),"success");

}
    /**
     * @Route("/admin/user/{user}/modification/", name="Ropi_admin_user_modification")

     * @Template("RopiIdentiteBundle:Account:modifAccountAdmin.html.twig")
     */
    public function  modifUserAction(Request $request, Personne $user){

            return $this->modifuser($request, $user, "Le compte à bien été modifié!", "home",new PersonneModifAdminType());

    }



    private function modifuser(Request $request, Personne $personne, $message, $cheminRetour,$type,$typeMessage= "success"){


        $form = $this->createForm($type, $personne);

        if(!is_string($message) || !is_string($cheminRetour)){

            throw $this->createAccessDeniedException("Une erreur c'est produite!");
        }

        $form->add("Enregistrer","submit");
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();



            $em->persist($personne);

            $em->flush();
            //$this->MailValidation($user, $cle);
            $this->get("session")->getFlashBag(array(
                $typeMessage=>$message));
            return $this->redirect($this->generateUrl($cheminRetour));
        }
        return  Array(
            "form" => $form->createView(),"user"=>$personne->getIdentifiantWeb()
        );
    }

    /**
     * @route("/admin/user/{personne}/delete",name="Ropi_admin_user_delete")
     * @Secure(roles={"ROLE_ADMIN"})
     * @param Request $request
     * @param Personne $personne
     */
    public function DeleteUserAction(Request $request, Personne $personne){

        $this->remove($personne);

        return $this->redirectToRoute("Ropi_admin_user_listing");
    }

    private function remove($objet){

        if ($objet) {

            $this->getDoctrine()->getManager()->remove($objet);
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add(
                'success', 'Suppression effectuée :-)'
            );

        } else {
            throw $this->createNotFoundException();
        }
    }


}
