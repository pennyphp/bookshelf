<?php
namespace ClassicApp\EventListener;

class PageNotFound
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function onError($event)
    {
        $e = $event->getException();

        $response = $event->getResponse()->withStatus($e->getCode());
        $event->setResponse($response);

        $response->getBody()->write($this->template->render("error/40x", [
            'title' => $e->getMessage(),
            'exception' => $e,
        ]));
    }
}
