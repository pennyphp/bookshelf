<?php

use GianArb\Penny\App;
use Zend\Diactoros\Response\SapiEmitter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$app = new App();

$emitter = new SapiEmitter();
$emitter->emit($app->run());
