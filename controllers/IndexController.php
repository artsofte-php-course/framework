<?php

class IndexController
{
    /**
     * Action name
     * @var string
     */
    public $name = 'index';

    public function indexAction()
    {
        return new Response(
            'Blank index'
        );
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