<?php
namespace ClassicAppTest;

use Prophecy\Argument;
use PHPUnit_Framework_TestCase;
use ClassicApp\EventListener\DispatcherExceptionListener;
use GianArb\Penny\App;
use GianArb\Penny\Config\Loader;
use Zend\Diactoros\Request;
use Zend\Diactoros\Response;
use Zend\Diactoros\Uri;

class AppTest extends PHPUnit_Framework_TestCase
{
    public function testDispatcherErrorCallsListenerIndex()
    {
        $dispatcherExceptionListener = $this->prophesize(DispatcherExceptionListener::class);

        $response = $this->prophesize(Response::class);
        $request = (new Request())
            ->withUri(new Uri('/pnf'))
            ->withMethod('GET');

        $container = App::buildContainer(Loader::load());
        $container->set(DispatcherExceptionListener::class, $dispatcherExceptionListener->reveal());

        $app = new App(null, $container);
        $app->run($request, $response->reveal());

        $dispatcherExceptionListener->onError(Argument::any())->shouldHaveBeenCalled();
    }
}
