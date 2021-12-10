<?php

class ContractsErrorHandler
{
    public static function getErrors(Contract $contract, ContractsRepository $contractsRepository)
    {
        $result = [];

        $contracts = $contractsRepository->getContractByNumber($contract->number);
        $contractsOfAgentForThisComplex = $contractsRepository->getContractByAgentNameAndComplexName($contract->agent_name, $contract->living_complex);

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