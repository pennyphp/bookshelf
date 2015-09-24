<?php
namespace ClassicAppTest;

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
        $spy = $this->getMockBuilder(DispatcherExceptionListener::class)
            ->disableOriginalConstructor()
            ->getMock();
        $spy->expects($this->once())
            ->method('onError')
            ->with($this->anything());

        $response = $this->getMock(Response::class);
        $request = (new Request())
            ->withUri(new Uri('/pnf'))
            ->withMethod('GET');

        $container = App::buildContainer(Loader::load());
        $container->set(DispatcherExceptionListener::class, $spy);

        $app = new App(null, $container);
        $app->run($request, $response);
    }
}
