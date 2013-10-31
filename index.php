<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Spolischook\Controller\MainController;

$routes = new RouteCollection();
$routes->add('index', new Route('/foo', array('controller' => 'Spolischook\Controller\MainController', 'action' => 'indexAction')));

$context = new RequestContext(Request::createFromGlobals());
$matcher = new UrlMatcher($routes, $context);
$request = new Request();
$request->createFromGlobals();
echo $request->getRequestUri();
//$matcher->matchRequest(Request::createFromGlobals());

//$generator = new UrlGenerator($routes, $context);

//var_dump($matcher->getContext());
