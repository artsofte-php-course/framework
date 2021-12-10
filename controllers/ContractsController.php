<?php
require_once 'entities/Contract.php';
require_once 'controllers/BasicController.php';

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
            $contract = new Contract();

            $contract->number = $request->getPostParameter('number');
            $contract->agent_name = $request->getPostParameter('agent_name');
            $contract->living_complex = $request->getPostParameter('living_complex');
            $contract->award_type = $request->getPostParameter('award_type');
            $contract->award_size = $request->getPostParameter('award_size');
            $contract->sign_date = $request->getPostParameter('sign_date');
            $contract->expiration_date = $request->getPostParameter('expiration_date');

            $errors = $this->getErrors($contract);
            if ($errors !== null)
                return new Response($this->render('add-contract', ['errors' => $errors]));

            $this->contractsRepository->addContract($contract);
            return new Response($this->render('contracts', ['contractsRepository' => $this->contractsRepository]));
        }
        return new Response($this->render('add-contract'));
    }

    protected function getErrors(Contract $contract)
    {
        $result = [];

        $contracts = $this->contractsRepository->getContractByNumber($contract->number);
        $contractsOfAgentForThisComplex = $this->contractsRepository->getContractByAgentNameAndComplexName($contract->agent_name, $contract->living_complex);

        $condition1 = (count($contracts) === 0);

        $condition2 = (count($contractsOfAgentForThisComplex) === 0);

        $condition3 = true;
        if ($contract->award_type == 'fix') {
            $as = (int)$contract->award_size;
            if ($as > 1000000 or $as <= 0)
                $condition3 = false;
        }

        $condition4 = true;
        if ($contract->award_type == 'percent') {
            $as = (int)$contract->award_size;
            if ($as > 10 or $as <= 0)
                $condition4 = false;
        }

        $condition5 = true;
        $d1 = new DateTime($contract->expiration_date);
        $d2 = new DateTime("now");
        if ($d1 <= $d2)
            $condition5 = false;

        if (!$condition1)
            array_push($result, 'Contract with number #' . $contract->number . ' is already exist');

        if (!$condition2)
            array_push($result, 'Agent already has contract for the complex ' . $contract->living_complex);

        if (!$condition3)
            array_push($result, 'Award size of fixed award must be between 0 and 1\'000\'000');

        if (!$condition4)
            array_push($result, 'Award size of percent award must be between 0 and 10');

        if (!$condition5)
            array_push($result, 'Expiration date must be in future');

        if (count($result) == 0)
            return null;
        return $result;
    }
}