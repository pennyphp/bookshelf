<?php
namespace ClassicApp\Controller;

use DI\Annotation\Inject;

class IndexController
{
    /**
     * @Inject("di")
     */
    private $di;

    /**
     * @Inject("template")
     */
    private $template;

    public function index($request, $response)
    {
        return $response->create($this->template->render('index.html.twig', [
            'title' => 'Home Page'
        ]));
    }
}
