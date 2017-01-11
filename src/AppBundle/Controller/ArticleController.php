<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
  /**
   * @Route("/", name="homepage")
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
  *    name="show_article"
  *    )
  */
  public function showAction()
  {
    return $this->render('article/show.html.twig');
  }
}
