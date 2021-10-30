<?php

class IndexController
{
    /**
     * Action name
     * @var string
     */
    public $name = 'index';

    /**
     * @var ArticleRepository
     */
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    public function indexAction(Request $request)
    {
        $articles = $this->articleRepository->getAll();
        return new Response(
            $this->render('articles', [
                'articles' => $articles
            ])
        );
    }

    public function showAction(Request $request)
    {
        $id = $request->getQueryParameter("id");

        $article = is_int($id) ? $this->articleRepository->getById($id) : null;

        if ($article === null) {
            return new Response('Page not found', '404', 'Not found');
        }

        return new Response(
            $this->render('article', [
                'article' => $article
            ])
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