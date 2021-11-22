<?php

class SellsRepository
{
    protected $connection = null;
    protected $agentsRepository;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->agentsRepository = new AgentsRepository($connection);
    }

    public function getAll()
    {
        $statement = $this->connection->query("SELECT * FROM apartments_sells");
        return $statement->fetchAll();
    }

    public function getAllByAgentId($id)
    {
        $statement = $this->connection->query("SELECT * FROM apartments_sells WHERE agent_id = " . $id);
        return $statement->fetchAll();
    }

    public function addNewSell($id, $sum, $contract_number, $apartment_number, $living_complex, $name)
    {
        $query = 'INSERT INTO apartments_sells (agent_id, sum, contract_number, apartment_number, living_complex)
VALUES (%d, %d, %d, %d, \'%s\');';
        $formated_query = sprintf($query, $id, $sum, $contract_number, $apartment_number, $living_complex);
        $statement = $this->connection->query($formated_query);
        if(!$statement) {
            $this->agentsRepository->addNewAgent($name);
            $id2 = $this->agentsRepository->getIdByAgentsName($name)[0];
            $formated_query2 = sprintf($query, $id2, $sum, $contract_number, $apartment_number, $living_complex);
            $statement2 = $this->connection->query($formated_query2);
            $statement2->execute();
            echo "ST1";
        }else{
            $statement->execute();
            echo "ST2";
        }
    }
}