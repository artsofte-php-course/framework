<?php
require_once 'controllers/BasicController.php';

class IndexController extends BasicController
{
    public function indexAction(Request $request)
    {
        return new Response($this->render('welcome'));
    }

    public function errorAction(Request $request)
    {
        return new Response($this->render('404'));
    }
}