<?php

namespace Ropi\AuthenticationBundle\Controller;

use Ropi\AuthenticationBundle\Entity\KeyValidation;
use Ropi\AuthenticationBundle\Form\changePWDType;
use Ropi\AuthenticationBundle\Form\IdentifiantWebType;
use Ropi\IdentiteBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
    public function loginAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('RopiAuthenticationBundle:Authenticate:login.html.twig', array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }
    /**
     * @Route("/my",name="Ropi_ok")
     * @Security("has_role('ROLE_UTILISATEUR_ACTIVE') or has_role('ROLE_COMMERCANT') or has_role('ROLE_ADMIN') or has_role('ROLE_CMS_CREATE')")
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
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @param Personne $personne
     */
    public function addIdentifiantWebAction(request $request, Personne $personne){

        if ($personne->getIdentifiantWeb() != null) throw $this->createAccessDeniedException("Vous ne pouvez pas crée un identifiant pour cette utilisateur, il en a déjà");

        $user = new IdentifiantWeb();
        $user->setPersonne($personne);
        $user->setActif(True);

        $form = $this->createForm(IdentifiantWebType::class, $user);
        $form->add("Enregistrer",SubmitType::class);
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

    /**
     * @Route("/motDePasseOublie", name="forget_pass")
     * @Template()
     */
    public function forgetPassAction(Request $request){

        $form = $this->createFormBuilder()
            ->add('email',EmailType::class,array(
                'label' => 'Merci d\'entré adresse email'
            ))
            ->add('Ré-initialiser mon mot de passe',SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();

            $this->addFlash('success','Si votre adresse mail est correcte, un mail de réinitialisation a été envoyé.');

            $contact = $this->getDoctrine()->getRepository(Contact::class)->findOneBy(array('valeur'=>$data["email"]));

            if($contact){
                try {

                    $manager = $this->getDoctrine()->getManager();

                    $iw = $contact->getPersonne()->getIdentifiantWeb();
                    $factory = $this->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($iw);
                    $iw->setMotDePasse($encoder->encodePassword(random_bytes(100), $iw->getSalt()));
                    $manager->persist($iw);

                    $key = new KeyValidation($iw->getSalt());
                    $key->setIdIdentifiantWeb($iw->getId());

                    $manager->persist($key);

                    $option = array(
                        'mail' => $data["email"],
                        'username' => $iw->getUsername(),
                        'lien' => $this->generateUrl("retrieve_my_pass",array('cle'=>$key->getCle())),
                    );

                    $mailer = $this->get("ropi.cms.mailerCSS");
                    $mailer->sendMail("RopiAuthenticationBundle:Mail:_resetPass.html.twig", $option, $data["email"], "[Ropi.Be] Réinitialisation de votre mot de passe");

                    $manager->flush();

                }catch (\Exception $e){

                }finally{
                    //return $this->redirectToRoute("home");
                }


            }
        }

        return array(
            'form'=>$form->createView()
        );

    }

    /**
     * @param KeyValidation $keyValidation
     * @Route("/oublieMotDePass/{cle}", name="retrieve_my_pass").
     * @Template("RopiAuthenticationBundle:Authenticate:forgetPass.html.twig")
     */
    public function retrieveMyPass(Request $request, KeyValidation $keyValidation){

        $iw = $this->getDoctrine()->getRepository(IdentifiantWeb::class)->find($keyValidation->getIdIdentifiantWeb());

        $form = $this->createFormBuilder()
            ->add('motDePasse',RepeatedType::class,array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'mot de passe:'),
                'second_options' => array('label' => 'Confirmation:'),
                'invalid_message' => 'Les mots de passe ne sont pas les mêmes',
            ))
            ->add('Modifier mon mot de passe',SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();

            $mdp = $form->getData()["motDePasse"];

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($iw);
            $iw->setMotDePasse($encoder->encodePassword($mdp, $iw->getSalt()));

            $manager->persist($iw);
            $manager->remove($keyValidation);

            $manager->flush();

            $this->addFlash('success','Vous pouvez maintenant utiliser votre nouveau mot de passe');

            return $this->redirectToRoute("login");

        }

        return array(
            'form' => $form->createView()
        );


    }

}
