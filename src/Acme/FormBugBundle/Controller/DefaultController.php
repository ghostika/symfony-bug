<?php

namespace Acme\FormBugBundle\Controller;

use Acme\FormBugBundle\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new TestType());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($form->getData());
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('AcmeFormBugBundle:Default:index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
