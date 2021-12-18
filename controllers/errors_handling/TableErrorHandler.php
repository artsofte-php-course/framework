<?php

class TableErrorHandler
{

    public static function getErrors(Sell $sell, SellsRepository $sellsRepository)
    {
        $result = [];

        foreach ((array)$sell as $key => $value) {
            if ($value == '') {
                array_push($result, ucfirst(str_replace('_', ' ', $key)) . ' can not be empty');
            } else {
                $funcName = 'check_' . $key;
                $result = (new TableErrorHandler)->$funcName($sell, $sellsRepository, $result);
            }
        }

        if (count($result) == 0)
            return null;
        return $result;
    }

    private function check_contract_number(Sell $sell, SellsRepository $sellsRepository, $result)
    {
        $sells = $sellsRepository->getByContractNumber($sell->contract_number);
        if (count($sells) === 0)
            array_push($result, 'Agent with contract number ' . $sell->contract_number . ' doesn\'t exists');
        return $result;
    }

    private function check_name(Sell $sell, SellsRepository $sellsRepository, $result)
    {
        return $result;
    }

    private function check_agent_id(Sell $sell, SellsRepository $sellsRepository, $result)
    {
        return $result;
    }


    private function check_apartment_number(Sell $sell, SellsRepository $sellsRepository, $result)
    {
        if (count($sellsRepository->getAllByLivingComplexAndApartmentNumber($sell->living_complex, $sell->apartment_number)) !== 0)
            array_push($result, 'Contract on apartment #' . $sell->apartment_number . ' is already exists. Please, enter different apartment number');
        return $result;
    }

    private function check_living_complex(Sell $sell, SellsRepository $sellsRepository, $result)
    {
        $sells = $sellsRepository->getByContractNumber($sell->contract_number);
        $livingComplex = $sells['living_complex'];
        if (count($sells) === 0 || $livingComplex != $sell->living_complex)
            array_push($result, "Agent's contract doesn't include living complex '$livingComplex'");
        return $result;
    }

    private function check_sum(Sell $sell, SellsRepository $sellsRepository, $result)
    {
        return $result;
    }

    private function check_apartment_price(Sell $sell, SellsRepository $sellsRepository, $result)
    {
        $sum = $sell->apartment_price;
        if ($sum < 500000)
            array_push($result, "Sell's sum can't be less than 500'000");
        return $result;
    }
}