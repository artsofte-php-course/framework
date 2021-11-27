<?php

class HelloWorldController extends BaseController
{
    /**
     * Action name
     * @var string
     */
    public $name = 'helloworld';

    /**
     * Hello Action
     * @return Response
     */
    public function helloAction() {

        return new Response($this->render('template', [
            'title' => 'Hello page',
            'text' => 'hello'
        ]));

    }


    /**
     * World action
     * @return Response
     *
     */
    public function worldAction() {
        return new Response($this->render('template', [
            'title' => 'World page',
            'text' => 'world'
        ]));
    }


}