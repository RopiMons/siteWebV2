<?php

namespace Ropi\IdentiteBundle\Controller;

use JMS\SecurityExtraBundle\Security\Util\String;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Ropi\IdentiteBundle\Form\AdresseType;
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
     * @Secure(roles={"ROLE_UTILISATEUR_ACTIVE","ROLE_COMMERCANT","ROLE_ADMIN","ROLE_CMS_CREATE"})
     */
    public function accountAction(Request $request)
    {

        $user = $this->container->get('security.context')->getToken()->getUser();


        return array('user'=> $user->getPersonne()) ;
    }


    /**
     * @Route("/my/account/modification/", name="Ropi_account_modification")

     * @Template()
     */
public function modifAccountAction(Request $request){
    $user = $this->container->get('security.context')->getToken()->getUser();

    return $this->modifuser($request,$user,"Votre compte à bien été modifié!","home",new PersonneModifType(),"success");

}
    /**
     * @Route("/admin/user/{user}/modification/", name="Ropi_admin_user_modification")
     * @Secure(roles={"ROLE_ADMIN"})
     * @Template("RopiIdentiteBundle:Account:modifAccountAdmin.html.twig")
     */
    public function  modifUserAction(Request $request, Personne $user){

       // $users = $this->getDoctrine()->getRepository("Ropi\AuthenticationBundle\Entity\IdentifiantWeb")->loadById($user->getIdentifiantWeb()->getId());


            return $this->modifuser($request, $user->getIdentifiantWeb(), "Le compte à bien été modifié!", "Ropi_admin_user_listing",new PersonneModifAdminType());

    }



    private function modifuser(Request $request, IdentifiantWeb $user, $message, $cheminRetour,$type,$typeMessage= "success"){



        if(!is_string($message) || !is_string($cheminRetour)){

            throw $this->createAccessDeniedException("Une erreur c'est produite!");
        }
        $form = $this->createForm($type, $user);
        $form->add("Enregistrer","submit");
        $form->handleRequest($request);


        if ( $form->isValid()) {

            $em = $this->getDoctrine()->getManager();


            $em->persist($user);

            $em->flush();
            //$this->MailValidation($user, $cle);
            $this->get("session")->getFlashBag(array(
                $typeMessage=>$message));
            return $this->redirect($this->generateUrl($cheminRetour));
        }
        return  Array(
            "form" => $form->createView(),"user"=>$user
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

    /**
     * @route("/my/adresse/nouvelle",name="Ropi_adress_add")
     *  @Secure(roles={"ROLE_UTILISATEUR_ACTIVE","ROLE_COMMERCANT","ROLE_ADMIN","ROLE_CMS_CREATE"})
     * @Template
     */
    public function AjoutAdresseAction(Request $request){
        $user = $this->container->get('security.context')->getToken()->getUser()->getPersonne();
        $Newaddesse = new Adresse();
        return $this->Adresse($request, $Newaddesse, $user);

    }

    /**
     * @route("/my/adresse/modification/{adresse}",name="Ropi_adress_modif")
     *  @Secure(roles={"ROLE_UTILISATEUR_ACTIVE","ROLE_COMMERCANT","ROLE_ADMIN","ROLE_CMS_CREATE"})
     * @Template("RopiIdentiteBundle:Account:AjoutAdresse.html.twig")
     */
    public function ModificationAdresseAction(Request $request,Adresse $adresse){


        return $this->Adresse($request, $adresse);

    }
    private function Adresse(Request $request, $Newaddesse, $user = null){
        $form = $this->createForm(new AdresseType(), $Newaddesse);
        $form->add("Enregistrer","submit");
        $form->handleRequest($request);


        if ( $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
                if(isset($user)) {
                    $Newaddesse->addPersonne($user);
                }
            //$user->addAdress($Newaddesse);
            $em->persist($Newaddesse);

            $em->flush();
            //$this->MailValidation($user, $cle);
            $this->get("session")->getFlashBag(array(
                "succes"=>"Une nouvelle adresse à été rajouté"));
            return $this->redirect($this->generateUrl("Ropi_account_modification"));
        }
        return  Array(
            "form" => $form->createView(),"user"=>$user
        );
    }



    /**
     * @route("/my/adresse/{adresse}/delete",name="Ropi_adress_del")
     *  @Secure(roles={"ROLE_UTILISATEUR_ACTIVE","ROLE_COMMERCANT","ROLE_ADMIN","ROLE_CMS_CREATE"})
     *
     */
    public function DeleteAdresseAction(Request $request, Adresse $adresse){
        $this->remove($adresse);

        return $this->redirectToRoute("Ropi_account_modification");
    }

}
