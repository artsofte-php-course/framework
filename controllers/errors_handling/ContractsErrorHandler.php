<?php

class ContractsErrorHandler
{
    public static function getErrors(Contract $contract, ContractsRepository $contractsRepository)
    {
        $result = [];

        foreach ((array)$contract as $key => $value) {
            if ($value == '') {
                array_push($result, ucfirst(str_replace('_', ' ', $key)) . ' can not be empty');
            } else {
                $funcName = 'check_' . $key;
                $result = (new ContractsErrorHandler)->$funcName($contract, $contractsRepository, $result);
            }
        }

        if (count($result) == 0)
            return null;
        return $result;
    }

    private function check_number($contract, ContractsRepository $contractsRepository, $result)
    {
        $contracts = $contractsRepository->getContractByNumber($contract->number);
        if (count($contracts) !== 0)
            array_push($result, 'Contract with number #' . $contract->number . ' is already exist');
        return $result;
    }

    private function check_agent_name($contract, ContractsRepository $contractsRepository, $result)
    {
        $contractsOfAgentForThisComplex = $contractsRepository->getContractByAgentNameAndComplexName($contract->agent_name, $contract->living_complex);
        if (count($contractsOfAgentForThisComplex) !== 0)
            array_push($result, 'Agent already has contract for the complex ' . $contract->living_complex);
        return $result;
    }

    private function check_living_complex($contract, ContractsRepository $contractsRepository, $result)
    {
        return $result;
    }

    private function check_award_type(Contract $contract, ContractsRepository $contractsRepository, $result)
    {
        if ($contract->award_type !== 'fix' && $contract->award_type !== 'percent')
            array_push($result, 'Award type must be \'fix\' or \'percent\'');

        return $result;
    }

    private function check_award_size(Contract $contract, ContractsRepository $contractsRepository, $result)
    {
        $message = '';
        $is_award_correct = true;
        if ($contract->award_type == 'fix') {
            $as = (int)$contract->award_size;
            if ($as > 1000000 or $as <= 0) {
                $is_award_correct = false;
                $message = 'Award size of fixed award must be between 0 and 1\'000\'000';
            }
        }

        if ($contract->award_type == 'percent') {
            $as = (int)$contract->award_size;
            if ($as > 10 or $as <= 0) {
                $is_award_correct = false;
                $message = 'Award size of percent award must be between 0 and 10';
            }
        }

        if (!$is_award_correct)
            array_push($result, $message);
        return $result;
    }

    private function check_sign_date(Contract $contract, ContractsRepository $contractsRepository, $result)
    {
        $isDateCorrect = true;
        $expirationDate = new DateTime($contract->expiration_date);
        $currentDate = new DateTime("now");

        if ($expirationDate <= $currentDate)
            array_push($result, 'Expiration date must be in future');
        return $result;
    }

    private function check_expiration_date(Contract $contract, ContractsRepository $contractsRepository, $result)
    {
        return $result;
    }
}