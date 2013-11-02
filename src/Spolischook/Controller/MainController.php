<?php

namespace Spolischook\Controller;

use Symfony\Component\HttpFoundation\Request;

class MainController
{
    public function indexAction()
    {
        return 'Hello world!!!';
    }

    public function fooAction()
    {
        return 'Foo Action!';
    }

    public function helloAction(Request $request)
    {
        $name = $request->get('name') ?: 'Anonymous';

        return "Hello " . $name;
    }
}