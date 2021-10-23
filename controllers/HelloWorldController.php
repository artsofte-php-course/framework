<?php

class HelloWorldController
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


    protected function render($templateName, $vars = [])
    {
        ob_start();
        extract($vars);
        include sprintf('templates/%s.php', $templateName);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function __call($name, $arguments)
    {
        return new Response('Sorry but this action not found',
            '404', 'Not found');
    }


}