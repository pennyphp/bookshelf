<?php
chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$app = new \GianArb\Penny\App();

$emitter = new \Zend\Diactoros\Response\SapiEmitter();
$emitter->emit($app->run());
