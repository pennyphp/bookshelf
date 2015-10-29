<?php
namespace App\EventListener;

class DispatcherExceptionListener
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function onError($event)
    {
        $e = $event->getException();

        /* @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $event->getResponse();

        $event->setResponse($response->create($this->template->render('error/40x.html.twig', [
            'title' => $e->getMessage(),
            'exception_class' => get_class($e),
            'trace' => $e->getTraceAsString()
        ]), $e->getCode()));
    }
}
