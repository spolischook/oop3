<?php

namespace Spolischook\Controller;

use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function indexAction()
    {
        return new Response('Hello world!!!');
    }
}