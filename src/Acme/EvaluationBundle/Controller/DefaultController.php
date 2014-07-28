<?php

namespace Acme\EvaluationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeEvaluationBundle:Default:index.html.twig', array('name' => $name));
    }
}
