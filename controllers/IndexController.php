<?php

class IndexController
{
    use BaseController;
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

        $article = is_numeric($id) ? $this->articleRepository->getById($id) : null;

        if ($article === null) {
            return new Response('Page not found', '404', 'Not found');
        }

        return new Response(
            $this->render('article', [
                'article' => $article
            ])
        );
    }

    /**
     * Show form far article create.
     * @param Request $request
     * @return Response
     */
    public function createFormAction(Request $request)
    {
        return new Response (
                $this->render('article/form', [])
        );

    }

    /**
     * Add new article
     * @param Request $request
     * @return Response|void
     */
    public function createAction(Request $request)
    {
        if ($request->isPost() && !empty($request->getRequestParameter('article'))) {

            $article = $request->getRequestParameter('article');

            $this->articleRepository->add($article['name'], $article['body']);

            return new Response(
                '/', '301', 'Moved'
            );

        }

    }




}