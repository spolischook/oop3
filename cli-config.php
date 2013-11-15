<?php

require_once '../vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'bootstrap.php';

$entityManager = DoctrineBootstrap::getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);