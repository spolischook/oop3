<?php

use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Application,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

class DoctrineBootstrap
{
    public static function getEntityManager()
    {
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src/Spolischook/Entity"), $isDevMode);
        $conn = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'test',
            'password' => '123456',
            'dbname'   => 'test_oop',
            'charset' => 'utf8',
            'driverOptions' => array(
                1002=>'SET NAMES utf8'
            )
        );

        return $entityManager = EntityManager::create($conn, $config);
    }
}
