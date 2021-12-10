<?php

class TableErrorHandler
{
    public static function getErrors(Sell $sell, SellsRepository $sellsRepository){
        $result = $sellsRepository->getAllByLivingComplexAndApartmentNumber($sell->living_complex, $sell->apartment_number);
        if (count($result) == 0){
            return null;
        }else{
            return ['Contract on apartment #' . $sell->apartment_number . ' is already exists. Please, enter different apartment number'];
        }
    }
}