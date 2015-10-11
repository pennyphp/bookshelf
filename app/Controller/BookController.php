<?php
namespace ClassicApp\Controller;

use ClassicApp\Form\Type\BookType;
use ClassicApp\Repository\BookRepository;
use DI\Annotation\Inject;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class BookController
{
    /**
     * @Inject("template")
     */
    private $template;

    /**
     * @var EntityManager
     * @Inject("doctrine.em")
     */
    private $em;

    /**
     * @var Session
     * @Inject("session")
     */
    private $session;

    public function index($request, $response)
    {
        /* @var $bookRepository BookRepository */
        $bookRepository = $this->em->getRepository('ClassicApp\Entity\Book');
        $books = $bookRepository->getPaginator();

        return $response->create($this->template->render('book/index.html.twig', [
            'title' => 'Books',
            'books' => $books
        ]));
    }

    public function create($request, $response)
    {
        $formFactory = Forms::createFormFactory();

        /* @var $form \Symfony\Component\Form\Form */
        $form = $formFactory->create(new BookType());
        $form->handleRequest();

        if ($form->isValid()) {
            $this->em->persist($form->getData());
            $this->em->flush();
            $this->session->getFlashBag()->add('notice', 'Book inserted');
            $response = new RedirectResponse('/book');
            return $response;
        }

        return $response->create($this->template->render('book/create.html.twig', [
            'title' => 'New Book',
            'form' => $form->createView()
        ]));
    }
}
