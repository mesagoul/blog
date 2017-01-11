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
   public function addAction()
  {
    $article = new Article();
    $form = $this->createForm(ArticleType::class, $article);
    return $this->render('article/add.html.twig',[
      'articleForm'=> $form->createView(),
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
