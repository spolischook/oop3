<?php

require_once '../vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'config/bootstrap.php';

$entityManager = DoctrineBootstrap::getEntityManager();

return $helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($entityManager->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
));