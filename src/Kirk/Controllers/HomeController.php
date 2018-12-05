<?php

namespace Kirk\Controllers;

class HomeController extends \Kirk\Core\Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig');
    }
}
