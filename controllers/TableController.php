<?php
require_once 'entities/Sell.php';
require_once 'controllers/BasicController.php';

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


            $sell = new Sell();

            $contract_info = explode(', ', $request->getPostParameter('contract_info'));
            $sell->name = $contract_info[1];
            $sell->agent_id = $this->agentsRepository->getIdByAgentsName($sell->name)[0];

            $sell->contract_number = (int)$contract_info[0];

            $apartment_price = (int)$request->getPostParameter('sum');
            $sell->sum = $this->getAwardFromApartmentPrice($sell->contract_number, $apartment_price);

            $sell->apartment_number = $request->getPostParameter('apartment_number');
            $sell->living_complex = $contract_info[2];

            $errors = $this->getErrors($sell);
            if($errors !== null)
                return new Response($this->render('add-sell', ['contractsRepository' => $this->contractsRepository, 'errors' => $errors]));


            $this->sellsRepository->addNewSell($sell);
            return new Response($this->render('comission-total', ['sellsRepository' => $this->sellsRepository, 'agentsRepository' => $this->agentsRepository]));
        }
        return new Response($this->render('add-sell', ['contractsRepository' => $this->contractsRepository]));
    }

    protected function getErrors(Sell $sell){
        $result = $this->sellsRepository->getAllByLivingComplexAndApartmentNumber($sell->living_complex, $sell->apartment_number);
        if (count($result) == 0){
            return null;
        }else{
            return ['Contract on apartment #' . $sell->apartment_number . ' is already exists. Please, enter different apartment number'];
        }
    }

    protected function getAwardFromApartmentPrice($contract_number, $apartment_price)
    {
        $contract = $this->contractsRepository->getContractByNumber($contract_number)[0];
        $award_type = $contract['award_type'];
        if($award_type === 'fix'){
            return (int)$contract['award_size'];
        }else{
            return (((int)$contract['award_size'])/100) * ((int)$apartment_price);
        }
    }
}