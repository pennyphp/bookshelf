<?php
namespace ClassicApp\Controller;

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
        $response->getBody()->write($this->template->render('index', [
            'title' => 'Home Page',
        ]));
        return $response;
    }
}
