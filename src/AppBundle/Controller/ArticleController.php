<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

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
      return $this->render('article/index.html.twig');
  }
  /**
  * @Route(
  *   "/{id}",
  *    requirements={"id" = "\d+"},
  *    defaults={"id" = 1},
  *    name="article_show"
  *    )
  */
  public function showAction()
  {
    return $this->render('article/show.html.twig');
  }


  /**
   * @Route("/add", name="article_add")
   */
   public function addAction(Request $request)
  {
    $article = new Article();
    $form = $this->createForm(ArticleType::class, $article);
    $form->handleRequest($request); // validation
    // BDD
    if($form->isValid()){
      // recupere tables
      $em = $this->getDoctrine()->getManager();
      // requete pour insertion
      $em->persist($article);
      // execute
      $em->flush();

      $this->addFlash("success",'The article was successfully saved in database !');
      return $this->redirectToRoute('article_homepage');
    }
    return $this->render('article/add.html.twig',[
      'articleForm'=> $form->createView(),
      "img" => $this->getImg()
    ]);
  }
  /**
  * @Route(
  * "/update/{id}",
  * name="article_update",
  * requirements={"id" = "\d+"}
  * )
  */
  public function updateAction(Article $article, Request $request)
  {
    $form = $this->createForm(ArticleType::class, $article);
    $form->handleRequest($request); // validation
    if($form->isValid()){
      // recupere tables
      $em = $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success",'The article was successfully updated in database !');
      return $this->redirectToRoute('article_homepage');
    }
    return $this->render('article/add.html.twig',[
      'articleForm'=> $form->createView(),
      'article'=> $article,
      "img" => $this->getImg()
    ]);
  }

  public function getImg(){
    $listImg = scandir("./bundles/clean-blog/img");
    unset($listImg[0]);
    unset($listImg[1]);
    $nbImg = rand(  2 , count($listImg));
    return $listImg[$nbImg];
  }
}
