<?php
namespace App\EventListener;

class ExceptionListener
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function onError($event)
    {
        $eventName =  $event->getName();

        $matches = [];
        preg_match('/\w+\.\w+\_error/', $eventName, $matches);

        if (!$matches) {
            return;
        }

        $e = $event->getException();

        /* @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $event->getResponse();

        $event->setResponse($response->create($this->template->render('error/50x.html.twig', [
            'title' => $e->getMessage(),
            'exception_class' => get_class($e),
            'trace' => $e->getTraceAsString()
        ]), 500));
    }
}
