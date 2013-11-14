<?php

namespace Spolischook\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;

class MainController
{
    protected $twig;

    /** @var EntityManager $em */
    protected $em;

    public function indexAction()
    {
        $films = $this->em->getRepository('Film')->findBy(array(), null, 6);
        return new Response($this->twig->render('index.html.twig', array(
            'title' => 'Yet another video hosting',
            'films' => $films,
        )));
    }

    public function fooAction()
    {
        return new Response('Foo Action!');
    }

    public function helloAction($name)
    {
        return new Response("Hello " . $name);
    }

    public function loadFixturesAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $loader = new Loader();
            $loader->loadFromDirectory(__DIR__ . '/../DataFixtures');

            $purger = new ORMPurger();
            $executor = new ORMExecutor($this->em, $purger);
            $executor->execute($loader->getFixtures());

            return new Response();
        }

        return new Response($this->twig->render('Static/fixtures.html.twig', array('title' => 'New Template')));
    }

    public function loadFixturesPageAction()
    {

    }

    public function setTwig($twig)
    {
        $this->twig = $twig;
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
}