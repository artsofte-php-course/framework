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

    public function addNewSell(Sell $sell)
    {
        $template_query = 'INSERT INTO apartments_sells (agent_id, sum, contract_number, apartment_number, living_complex)
VALUES (%d, %d, %d, %d, \'%s\');';

        $query = sprintf($template_query,
            $sell->agent_id,
            $sell->sum,
            $sell->contract_number,
            $sell->apartment_number,
            $sell->living_complex);
        $statement = $this->connection->query($query);

        if ($sell->agent_id == 0) {

            $this->agentsRepository->addNewAgent($sell->name);
            $sell->agent_id = (int)$this->agentsRepository->getIdByAgentsName($sell->name)[0];

            $query = sprintf($template_query,
                $sell->agent_id,
                $sell->sum,
                $sell->contract_number,
                $sell->apartment_number,
                $sell->living_complex);
            $statement = $this->connection->query($query);
        }
    }
}
