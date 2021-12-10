<?php

class Contract
{
    public $number;
    public $agent_name;
    public $living_complex;
    public $award_type;
    public $award_size;
    public $sign_date;
    public $expiration_date;

    public function __construct($request)
    {
        $this->number = $request->getPostParameter('number');
        $this->agent_name = $request->getPostParameter('agent_name');
        $this->living_complex = $request->getPostParameter('living_complex');
        $this->award_type = $request->getPostParameter('award_type');
        $this->award_size = $request->getPostParameter('award_size');
        $this->sign_date = $request->getPostParameter('sign_date');
        $this->expiration_date = $request->getPostParameter('expiration_date');
    }
}