<?php
require_once 'entities/Sell.php';

class TableController
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
    public function showTableAction(Request $request)
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

    public function addSellAction(Request $request){
        if($request->isPost()){

            $sell = new Sell();

            $sell->name = $request->getPostParameter('name');
            $sell->agent_id = $this->agentsRepository->getIdByAgentsName($sell->name)[0];
            $sell->sum = (int)$request->getPostParameter('sum');
            $sell->contract_number = $request->getPostParameter('contract_number');
            $sell->apartment_number = $request->getPostParameter('apartment_number');
            $sell->living_complex = $request->getPostParameter('living_complex');

            $this->sellsRepository->addNewSell($sell);
            return new Response($this->render('comission-total', ['sellsRepository' => $this->sellsRepository, 'agentsRepository' => $this->agentsRepository]));
        }
        return new Response($this->render('add-sell'));
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