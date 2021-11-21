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
    protected $sellsRepository;
    protected $agentsRepository;

    public function __construct(ArticleRepository $articleRepository, SellsRepository $sellsRepository, AgentsRepository $agentsRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->sellsRepository = $sellsRepository;
        $this->agentsRepository = $agentsRepository;
    }


    //Will return table of | agent_name | num_of_sellf | sum |
    public function indexAction(Request $request)
    {
//        $articles = $this->articleRepository->getAll();
//        return new Response(
//            $this->render('articles', [
//                'articles' => $articles
//            ])
//        );
//        $sells = $this->sellsRepository->getAll();
        return new Response($this->render('comission-total', ['sellsRepository' => $this->sellsRepository, 'agentsRepository' => $this->agentsRepository]));
    }

    public function showAction(Request $request)
    {
        $id = (int)$request->getQueryParameter("id");

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