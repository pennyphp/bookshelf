<?php

namespace ClassicAppTest\Controller;

use PHPUnit_Framework_TestCase;
use ClassicApp\Controller\BookController;
use ClassicApp\Entity\Book;
use ClassicApp\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ReflectionProperty;
use ReflectionMethod;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig_Environment;

class BookControllerTest extends PHPUnit_Framework_TestCase
{
    private $controller;

    protected function setUp()
    {

    }

    public function testIndex()
    {
        $controller = new BookController();

        $request  = $this->prophesize(Request::class);
        $response = new Response();
        $em       = $this->prophesize(EntityManager::class);
        $template = $this->prophesize(Twig_Environment::class);
        $session  = $this->prophesize(Session::class);

        $books    = $this->prophesize(Paginator::class);
        $bookRepository = $this->prophesize(BookRepository::class);
        $bookRepository->getPaginator()->willReturn($books);
        $em->getRepository(Book::class)->willReturn($bookRepository);

        $returnRender = file_get_contents('./app/Resources/view/book/index.html.twig');
        $template->render('book/index.html.twig', [
            'title' => 'Books',
            'books' => $books
        ])->willReturn($returnRender);

        $r = new ReflectionProperty($controller, 'template');
        $r->setAccessible(true);
        $r->setValue($controller, $template->reveal());

        $r = new ReflectionProperty($controller, 'em');
        $r->setAccessible(true);
        $r->setValue($controller, $em->reveal());

        $r = new ReflectionProperty($controller, 'session');
        $r->setAccessible(true);
        $r->setValue($controller, $session->reveal());

        $result = $controller->index($request->reveal(), $response);
        $this->assertContains('Books', $result->getContent());
    }
}
