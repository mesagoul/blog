<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        // app/Resources/views/default/index.html.twig
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
    /**
    * @Route("/{id}", name="show_article")
    */
    public function showAction(Request $request){
      return $this->render('default/show.html.twig',[
        'article_id'=>$request->get("id"),
        'base_dir'=>'heelllllo'
      ]);

    }
}
