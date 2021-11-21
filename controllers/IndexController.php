<?php

class IndexController
{
    public function indexAction(Request $request)
    {
        return new Response($this->render('welcome'));
    }

    public function errorAction(Request $request)
    {
        return new Response('Sorry, but this page doesn\'t exist', '404', 'Not found');
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