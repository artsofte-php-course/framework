<?php
require_once 'entities/Sell.php';
require_once 'controllers/BasicController.php';
require_once 'controllers/errors_handling/TableErrorHandler.php';

class TableController extends BasicController
{
    /**
     * Action name
     * @var string
     */
    public $name = 'index';

    /**
     * @var ArticleRepository
     */
    protected $contractsRepository;
    protected $sellsRepository;
    protected $agentsRepository;

    public function __construct(ContractsRepository $contractsRepository, SellsRepository $sellsRepository, AgentsRepository $agentsRepository)
    {
        $this->contractsRepository = $contractsRepository;
        $this->sellsRepository = $sellsRepository;
        $this->agentsRepository = $agentsRepository;
    }


    public function showTableAction(Request $request)
    {
        return new Response($this->render('comission-total', ['sellsRepository' => $this->sellsRepository, 'agentsRepository' => $this->agentsRepository]));
    }

    public function addSellAction(Request $request)
    {
        if ($request->isPost()) {

            $sell = new Sell($request, $this->agentsRepository, $this->contractsRepository);

            $errors = TableErrorHandler::getErrors($sell, $this->sellsRepository);
            if ($errors !== null)
                return new Response($this->render('add-sell', ['contractsRepository' => $this->contractsRepository, 'errors' => $errors]));


            $this->sellsRepository->addNewSell($sell);
            return new Response($this->render('comission-total', ['sellsRepository' => $this->sellsRepository, 'agentsRepository' => $this->agentsRepository]));
        }
        return new Response($this->render('add-sell', ['contractsRepository' => $this->contractsRepository]));
    }



}