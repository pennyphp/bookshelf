<?php
chdir(dirname(__DIR__));
require "vendor/autoload.php";

$app = new \GianArb\Penny\App();

$app->getContainer()->get("http.flow")->attach("ERROR_DISPATCH", function ($e) {
    if($e->getException() instanceof \Exception) {
        throw $e;
    }
});

$emitter = new \Zend\Diactoros\Response\SapiEmitter();
$emitter->emit($app->run());
