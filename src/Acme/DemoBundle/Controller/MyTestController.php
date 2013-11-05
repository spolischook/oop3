<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class MyTestController extends Controller
{
    public function firstAction()
    {
        $url = $this->generateUrl('_second');
        return new Response('<h1>first</h1> <a href="'.$url.'">second</a>');
    }

    public function secondAction()
    {
        $url = $this->generateUrl('_third');

        return $this->render(
            'AcmeDemoBundle:MyTest:second.html.twig',
            array('url' => $url)
        );
    }

    public function thirdAction()
    {
        $url = $this->generateUrl('_first');

        return $this->render(
            'AcmeDemoBundle:MyTest:third.html.twig',
            array('url' => $url)
        );
    }
} 