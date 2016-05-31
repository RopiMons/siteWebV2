<?php

namespace IolaCorporation\NewsBundle\Controller;

use IolaCorporation\NewsBundle\Entity\Album;
use IolaCorporation\NewsBundle\Form\AlbumType;
use IolaCorporation\NewsBundle\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use IolaCorporation\NewsBundle\Form\NewsType;



class NewsController extends Controller
{
    public function indexAction()
    {
        $news =  $this->getDoctrine()->getRepository(News::class)->findNewNews(1,0);
        return $this->render('IolaCorporationNewsBundle:Default:news.html.twig',array('news'=>$news));
    }

    public function detailAction(News $news)
    {
        if($news->getEnable()) {
            $fiveNews =  $this->getDoctrine()->getRepository(News::class)->fiveNews($news->getId());
            return $this->render('IolaCorporationNewsBundle:Default:newsdetail.html.twig', array('news' => $news,'fiveNews'=>$fiveNews));
        }
        else{
            return $this->redirectToRoute( "iola_corporation_news_homepage");
        }
    }


    public function loadNewsAjaxAction(Request $request){
        $min =1;
        $max =1;



       $min = $request->get('min');
        $max = $request->get('max');
        $code = 100;
        $news =  $this->getDoctrine()->getRepository(News::class)->findNewNews($max,$min);
       $count = $this->getDoctrine()->getRepository(News::class)->countNews();

        if($count <= $max+$min ) $code = 200;

        $response = array("code" => $code,'min'=>$count, "success" => true, "ajaxnews"=>$this->renderView('IolaCorporationNewsBundle:Default:newsAjax.html.twig',array("nb"=>3,"news"=>$news)));
        //you can return result as JSON
        return new Response(json_encode($response));

       // return $this->renderView('IolaCorporationNewsBundle:Default:test.html.twig');

    }

    public function uploadAction(Request $request){

        $document = new Album();
        $form = $this->createForm(AlbumType::class,$document);

            $form->add('save', SubmitType::class, array('label' => 'Create Task'));



       $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            dump($document);
            die();
            $em->persist($document);

            //$em->persist($file);

            $em->flush();

            return $this->redirectToRoute("iola_corporation_news_homepage");
        }

        return $this->render('IolaCorporationNewsBundle:form:form.html.twig', array('form' => $form->createView()));

    }
    public function addAction(Request $request){
        $document = new News();

        $album = new Album();

        $document->getAlbum()->add($album);
        $album->getNews()->add($document);
        $form = $this->createForm(NewsType::class,$document);
        $form->add('save', SubmitType::class, array('label' => 'Create Task'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $document->setUser($this->getUser());
            $document->setDateEcriture( new \Datetime());

            if($album->getName() != null){
                $em->persist($album);
            }
            else{
                $document->removeAlbum($album);
            }

            $em->persist($document);

            //$em->persist($file);

            $em->flush();

            return $this->redirectToRoute("iola_corporation_news_show");
        }

        return $this->render('IolaCorporationNewsBundle:form:form.html.twig', array('form' => $form->createView()));


    }
    public function editAction(Request $request, News $news){
        $document = $news;
        dump($document);

        $form = $this->createForm(NewsType::class,$document);
        $form->add('save', SubmitType::class, array('label' => 'Create Task'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $document->setUser($this->getUser());
            $document->setDateEcriture( new \Datetime());

            $em->persist($document);

            //$em->persist($file);

            $em->flush();

            return $this->redirectToRoute("iola_corporation_news_show");
        }

        return $this->render('IolaCorporationNewsBundle:form:form.html.twig', array('form' => $form->createView()));


    }
    public function showAction(){

        $news =  $this->getDoctrine()->getRepository('IolaCorporationNewsBundle:News')->titreNews();
        return $this->render('IolaCorporationNewsBundle:Admin:show.html.twig',array('news'=>$news));
    }
    public function deleteAction(News $news){
        $em = $this->getDoctrine()->getManager();

        $em->remove($news);
        $em->flush();

        return $this->redirectToRoute("iola_corporation_news_show");
    }
}
