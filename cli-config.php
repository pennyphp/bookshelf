<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require 'vendor/autoload.php';

$app = new \Penny\App();

$entityManager = $app->getContainer()->get('doctrine.em');

return ConsoleRunner::createHelperSet($entityManager);