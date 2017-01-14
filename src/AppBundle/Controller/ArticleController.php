<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
* @Route("/article")
*/
class ArticleController extends Controller
{
  /**
   * @Route("/", name="article_homepage")
   */
  public function homePageAction()
  {
    $em = $this->getDoctrine()->getManager();
    $articles = $em->getRepository('AppBundle:Article')->findAll();
      return $this->render('article/index.html.twig',[
        "articles"=> $articles
      ]);
  }
  /**
  * @Route(
  *   "/{id}",
  *    requirements={"id" = "\d+"},
  *    defaults={"id" = 1},
  *    name="article_show"
  *    )
  */
  public function showAction(Article $article)
  {
    $manage_enable = ($article->getAuthor() == $this->getUser()->getUsername()) ? true : false;
    return $this->render('article/show.html.twig',[
      'article'=> $article,
      'img' => $this->getImg(),
      'article_img' => $article->getHeaderImage(),
      'manage_enable' => $manage_enable
    ]);
  }


  /**
   * @Route("/admin/add", name="article_add")
   */
   public function addAction(Request $request)
  {
    $article = new Article();
    $form = $this->createForm(ArticleType::class, $article);
    $form->handleRequest($request); // validation
    // BDD
    if($form->isSubmitted()){
      $this->get("image.uploader")->upload($article);
      // recupere tables
      $em = $this->getDoctrine()->getManager();
      $article->setAuthor($this->getUser());
      // requete pour insertion
      $em->persist($article);
      // execute
      $em->flush();

      $this->addFlash("success",'The article was successfully saved in database !');
      return $this->redirectToRoute('article_show', ['id'=> $article->getId()]);
    }
    return $this->render('article/add.html.twig',[
      'articleForm'=> $form->createView(),
      "img" => $this->getImg()
    ]);
  }
  /**
  * @Route(
  * "/admin/update/{id}",
  * name="article_update",
  * requirements={"id" = "\d+"}
  * )
  */
  public function updateAction(Article $article, Request $request)
  {
    $access_enable = ($article->getAuthor() == $this->getUser()->getUsername()) ? true : false;
    if(!$access_enable){
        return $this->redirectToRoute('article_homepage');
    }
    $articleImagePath = $article->getHeaderImage();
    if(null != $articleImagePath){
      $article->setHeaderImage(
        new File($this->getParameter("file_path").$articleImagePath)
      );
    }

    $form = $this->createForm(ArticleType::class, $article);
    $form->handleRequest($request); // validation
    if($form->isSubmitted()){
      $this->get("image.uploader")->upload($article);
      if(!$article->getHeaderImage()){
              $article->setHeaderImage($articleImagePath);
            }
      $em = $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success",'The article was successfully updated in database !');
    return $this->redirectToRoute('article_show', ['id'=> $article->getId()]);
    }
    return $this->render('article/add.html.twig',[
      'articleForm'=> $form->createView(),
      'article'=> $article,
      "img" => $this->getImg(),
      'oldArticleImage' => $articleImagePath
    ]);
  }

  /**
  * @Route(
  * "/admin/delete/{id}",
  * name="article_delete",
  * requirements={"id" = "\d+"}
  * )
  */
  public function deleteAction(Article $article, Request $request)
  {
    $access_enable = ($article->getAuthor() == $this->getUser()->getUsername()) ? true : false;
    if(!$access_enable){
        return $this->redirectToRoute('article_homepage');
    }
    $em = $this->getDoctrine()->getManager();

    $article = $em->getRepository('AppBundle:Article')->find($article->getId());

    if (!$article) {
        throw $this->createNotFoundException(
            'No product found for id '.$article->getId()
        );
    }

    $em->remove($article);
    $em->flush();

    return $this->redirectToRoute('article_homepage');
  }

  public function getImg(){
    $listImg = scandir("./bundles/clean-blog/img");
    unset($listImg[0]);
    unset($listImg[1]);
    $nbImg = rand(  2 , count($listImg));
    return $listImg[$nbImg];
  }
}
