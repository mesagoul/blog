<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExerciceController extends Controller
{
    /**
    *@Route("/test",name="test")
    */
    public function userAction(){
      return new Response(
        // renderView va chercher un template
        $this->renderView('exercice/exercice.html.twig'),
        Response::HTTP_OK,
        ['X-My-Header'=> "Youhou mon header"]);
    }
}
// si la structure html est valide, on verra la debug toolbar
