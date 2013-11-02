<?php

namespace Spolischook\Controller;

use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function indexAction()
    {
        return new Response('Hello world!!!');
    }

    public function fooAction()
    {
        return new Response('Foo Action!');
    }

    public function helloAction($name)
    {
        return new Response("Hello " . $name);
    }
}