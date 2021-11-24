<?php

class ContractsRepository
{
    protected $connection = null;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $statement = $this->connection->query("SELECT * FROM contracts");
        return $statement->fetchAll();
    }

    public function getContractByNumber($number)
    {
        $statement = $this->connection->query("SELECT * FROM contracts WHERE number = " . $number . ";");
        return $statement->fetchAll();
    }

    public function getContractByAgentNameAndComplexName($agent_name, $complex_name){
        $statement = $this->connection->query("SELECT * FROM contracts WHERE agent_name = '" . $agent_name . "' AND living_complex = '" . $complex_name . "' ;");
        return $statement->fetchAll();
    }

    public function addContract(Contract $contract)
    {
        $query = "insert into contracts (number, agent_name, living_complex, award_type, award_size, expiration_date, sign_date)
values (%d, '%s', '%s', '%s', %d, '%s', '%s');";
        $query = sprintf($query, $contract->number,
            $contract->agent_name,
            $contract->living_complex,
            $contract->award_type,
            $contract->award_size,
            $contract->expiration_date,
            $contract->sign_date);
        $statement = $this->connection->query($query);
    }
}