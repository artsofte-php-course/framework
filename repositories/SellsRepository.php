<?php

class SellsRepository
{
    protected $connection = null;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
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
}