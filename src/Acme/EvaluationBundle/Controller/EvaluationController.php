<?php

namespace Acme\EvaluationBundle\Controller;

use Acme\EvaluationBundle\Entity\User;
use Acme\EvaluationBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvaluationController extends Controller
{

    public function indexAction()
    {
        return $this->render('AcmeEvaluationBundle:Evaluation:index.html.twig');
    }

    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository('AcmeEvaluationBundle:Role')->findOneByName('basic_user');
        $user->addRole($role);
        $created_date = new \DateTime("now");
        $user->setCreated($created_date);
        $user->setStatus(0);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $user->setPassword($user->encrypt($user->getPassword()));
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render(
            'AcmeEvaluationBundle:Evaluation:form.html.twig',
            array('form' => $form->createView(),)
        );
    }

}