<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('index', new Route('/', array('controller' => 'Spolischook\Controller\MainController', 'action' => 'indexAction')));
$routes->add('foo', new Route('/foo', array('controller' => 'Spolischook\Controller\MainController', 'action' => 'fooAction')));
$routes->add('greeting', new Route('/hello', array('controller' => 'Spolischook\Controller\MainController', 'action' => 'helloAction')));

$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match($context->getPathInfo());
$content = call_user_func_array(array(new $parameters['controller'], $parameters['action']), array($request));

$response = new Response($content);
$response->send();
