<?php

class Sell
{
    public $name;
    public $agent_id;
    public $sum;
    public $contract_number;
    public $apartment_number;
    public $living_complex;

    public function __construct(Request $request, AgentsRepository $agentsRepository, ContractsRepository $contractsRepository)
    {
        $contract_info = explode(', ', $request->getPostParameter('contract_info'));
        $this->name = $contract_info[1];
        $this->agent_id = $agentsRepository->getIdByAgentsName($this->name)[0];
        $this->contract_number = (int)$contract_info[0];
        $apartment_price = (int)$request->getPostParameter('sum');
        $this->sum = $this->getAwardFromApartmentPrice($this->contract_number, $apartment_price, $contractsRepository);
        $this->apartment_number = $request->getPostParameter('apartment_number');
        $this->living_complex = $contract_info[2];
    }

    protected function getAwardFromApartmentPrice($contract_number, $apartment_price, $contractsRepository)
    {
        $contract = $contractsRepository->getContractByNumber($contract_number)[0];
        $award_type = $contract['award_type'];
        if ($award_type === 'fix') {
            return (int)$contract['award_size'];
        } else {
            return (((int)$contract['award_size']) / 100) * ((int)$apartment_price);
        }
    }

}