<?php

use Penny\App;
use Zend\Diactoros\Response\SapiEmitter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$app = new App();

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response = new \Symfony\Component\HttpFoundation\Response();
$app->run($request, $response)->send();