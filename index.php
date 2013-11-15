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
    Symfony\Component\Routing\Route,
    Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Bridge\Twig\Extension\RoutingExtension;
use Assetic\Factory\AssetFactory,
    Assetic\Factory\Worker\CacheBustingWorker,
    Assetic\Filter\Yui\CssCompressorFilter,
    Assetic\Filter\Yui\JsCompressorFilter,
    Assetic\Filter\CssRewriteFilter,
    Assetic\Extension\Twig\AsseticExtension,
    Assetic\AssetManager,
    Assetic\FilterManager,
    Assetic\AssetWriter,
    Assetic\Asset\AssetCollection,
    Assetic\Asset\FileAsset,
    Assetic\Asset\GlobAsset;
use Symfony\Component\Yaml\Yaml;

require_once 'config/bootstrap.php';

$em = DoctrineBootstrap::getEntityManager();

$routes = new RouteCollection();
$routes->add('index', new Route('/', array('_controller' => 'Spolischook\Controller\MainController::indexAction')));
$routes->add('foo', new Route('/foo', array('_controller' => 'Spolischook\Controller\MainController::fooAction')));
$routes->add('greeting', new Route('/hello/{name}', array('_controller' => 'Spolischook\Controller\MainController::helloAction')));
$routes->add('load_fixtures', new Route('/load-fixtures', array('_controller' => 'Spolischook\Controller\MainController::loadFixturesAction')));
$routes->add('film_show', new Route('/film/{id}', array('_controller' => 'Spolischook\Controller\MainController::getFilmAction')));

$loader = new Twig_Loader_Filesystem(__DIR__ . '/view');
$twig = new Twig_Environment($loader, array(
//    'cache' => __DIR__ . '/view/cache',
));


$twig->addExtension(new AsseticExtension(new AssetFactory(__DIR__ . '/public')));

//$assetManager = new AssetManager();
//$style = new AssetCollection(array(
//    new FileAsset(__DIR__ . '/vendor/twbs/bootstrap/dist/css/bootstrap.css'),
//    new FileAsset(__DIR__ . '/vendor/twbs/bootstrap/examples/carousel/carousel.css'),
//), array(
//    new CssCompressorFilter(__DIR__ . '/public/yuicompressor-2.4.8.jar'),
//    new CssRewriteFilter(),
//));
//$style->setTargetPath('style.css');
//
//$js = new AssetCollection(array(
//    new FileAsset(__DIR__ . '/vendor/components/jquery/jquery.js'),
//    new FileAsset(__DIR__ . '/vendor/twbs/bootstrap/dist/js/bootstrap.min.js'),
//    new FileAsset(__DIR__ . '/vendor/twbs/bootstrap/docs-assets/js/holder.js'),
//    new FileAsset(__DIR__ . '/public/load-fixtures.js'),
//), array(
//    new JsCompressorFilter(__DIR__ . '/public/yuicompressor-2.4.8.jar'),
//));
//$js->setTargetPath('scripts.js');
//
//$assetManager->set('main_css', $style);
//$assetManager->set('bootstrap_js', $js);
//
//
//$assetWriter = new AssetWriter(__DIR__ . '/public');
//$assetWriter->writeManagerAssets($assetManager);
//exit;

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);
$generator = new UrlGenerator($routes, $context);

$twig->addExtension(new RoutingExtension($generator));

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher));

$dispatcher->addListener(KernelEvents::CONTROLLER, function (Event $event) use ($twig, $em) {
    $controllerArray = $event->getController();
    $controller = $controllerArray[0];
    $controller->setTwig($twig);
    $controller->setEntityManager($em);
});

$resolver = new ControllerResolver();

$kernel = new HttpKernel($dispatcher, $resolver);

$kernel->handle($request)->send();
