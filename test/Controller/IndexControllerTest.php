<?php

namespace ClassicAppTest\Controller;

use PHPUnit_Framework_TestCase;
use ClassicApp\Controller\IndexController;
use ReflectionProperty;

class IndexControllerTest extends PHPUnit_Framework_TestCase
{
    private $controller;

    protected function setUp()
    {
        $this->controller = new IndexController();
    }

    public function testIndex()
    {
        $request  = $this->prophesize('Zend\Diactoros\Request');
        $response = $this->prophesize('Zend\Diactoros\Response');
        $stream   = $this->prophesize('Psr\Http\Message\StreamInterface');
        $template = $this->prophesize('League\Plates\Engine');

        $returnRender = file_get_contents(__DIR__ . './../../app/view/index.php');
        $template->render('index', [
            'title' => 'Home Page',
        ])->willReturn($returnRender);

        $response->getBody()->willReturn($stream);
        $stream->__toString()->willReturn($returnRender);
        $stream->write($returnRender)->shouldBeCalled();

        $r = new ReflectionProperty($this->controller, 'template');
        $r->setAccessible(true);
        $r->setValue($this->controller, $template->reveal());

        $result = $this->controller->index($request->reveal(), $response->reveal());
        $this->assertContains('Penny Classic Application', $result->getBody()->__toString());
    }

    protected function tearDown()
    {
    }
}
