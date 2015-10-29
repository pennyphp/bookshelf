<?php

namespace AppTest\Controller;

use PHPUnit_Framework_TestCase;
use App\Controller\BookController;
use App\Entity\Book;
use App\Repository\BookRepository;
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
        $this->controller = new BookController();
    }

    public function testIndex()
    {
        $this->controller = new BookController();

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

        $r = new ReflectionProperty($this->controller, 'template');
        $r->setAccessible(true);
        $r->setValue($this->controller, $template->reveal());

        $r = new ReflectionProperty($this->controller, 'em');
        $r->setAccessible(true);
        $r->setValue($this->controller, $em->reveal());

        $r = new ReflectionProperty($this->controller, 'session');
        $r->setAccessible(true);
        $r->setValue($this->controller, $session->reveal());

        $result = $this->controller->index($request->reveal(), $response);
        $this->assertContains('Books', $result->getContent());
    }
}
