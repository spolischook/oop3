<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\EventDispatcher\EventDispatcher,
    Symfony\Component\EventDispatcher\Event,
    Symfony\Component\HttpKernel\EventListener\RouterListener,
    Symfony\Component\HttpKernel\Controller\ControllerResolver,
    Symfony\Component\HttpKernel\HttpKernel,
    Symfony\Component\HttpKernel\KernelEvents,
    Symfony\Component\Routing\Matcher\UrlMatcher,
    Symfony\Component\Routing\RequestContext,
    Symfony\Component\Routing\RouteCollection,
    Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('index', new Route('/', array('_controller' => 'Spolischook\Controller\MainController::indexAction')));
$routes->add('foo', new Route('/foo', array('_controller' => 'Spolischook\Controller\MainController::fooAction')));
$routes->add('greeting', new Route('/hello/{name}', array('_controller' => 'Spolischook\Controller\MainController::helloAction')));

$loader = new Twig_Loader_Filesystem(__DIR__ . '/view');
$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__ . '/view/cache',
));
$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher));

$dispatcher->addListener(KernelEvents::CONTROLLER, function (Event $event) use ($twig) {
    $controllerArray = $event->getController();
    $controller = $controllerArray[0];
    $controller->setTwig($twig);
});

$resolver = new ControllerResolver();

$kernel = new HttpKernel($dispatcher, $resolver);

$kernel->handle($request)->send();
