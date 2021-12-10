<?php
require_once 'entities/Contract.php';
require_once 'controllers/BasicController.php';
require_once 'controllers/errors_handling/ContractsErrorHandler.php';

class ContractsController extends BasicController
{

    protected $contractsRepository;
    protected $agentsRepository;

    public function __construct(ContractsRepository $contractsRepository, AgentsRepository $agentsRepository)
    {
        $this->contractsRepository = $contractsRepository;
        $this->agentsRepository = $agentsRepository;
    }


    public function showContractsAction(Request $request)
    {
        return new Response($this->render('contracts', ['contractsRepository' => $this->contractsRepository]));
    }

    public function showContractsFormAction(Request $request)
    {
        if ($request->isPost()) {
            $contract = new Contract($request);

            $errors = ContractsErrorHandler::getErrors($contract, $this->contractsRepository);
            if ($errors !== null)
                return new Response($this->render('add-contract', ['errors' => $errors]));

            $this->contractsRepository->addContract($contract);
            return new Response($this->render('contracts', ['contractsRepository' => $this->contractsRepository]));
        }
        return new Response($this->render('add-contract'));
    }
}