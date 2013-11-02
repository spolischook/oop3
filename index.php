<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\EventDispatcher\EventDispatcher,
    Symfony\Component\HttpKernel\EventListener\RouterListener,
    Symfony\Component\HttpKernel\Controller\ControllerResolver,
    Symfony\Component\HttpKernel\HttpKernel,
    Symfony\Component\Routing\Matcher\UrlMatcher,
    Symfony\Component\Routing\RequestContext,
    Symfony\Component\Routing\RouteCollection,
    Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('index', new Route('/', array('_controller' => 'Spolischook\Controller\MainController::indexAction')));
$routes->add('foo', new Route('/foo', array('_controller' => 'Spolischook\Controller\MainController::fooAction')));
$routes->add('greeting', new Route('/hello/{name}', array('_controller' => 'Spolischook\Controller\MainController::helloAction')));

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher));

$resolver = new ControllerResolver();

$kernel = new HttpKernel($dispatcher, $resolver);

$kernel->handle($request)->send();
