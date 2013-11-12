<?php

namespace Spolischook\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig_Loader_Filesystem;
use Twig_Environment;

class MainController
{
    protected $twig;

    public function indexAction()
    {
        return new Response($this->twig->render('base.html.twig', array('title' => 'New Template')));
    }

    public function fooAction()
    {
        return new Response('Foo Action!');
    }

    public function helloAction($name)
    {
        return new Response("Hello " . $name);
    }

    public function setTwig($twig)
    {
        $this->twig = $twig;
    }
}