<?php

class AgentsRepository
{
    protected $connection = null;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAgentNameById($id)
    {
        $statement = $this->connection->query("SELECT * FROM agents WHERE id = " . $id);
        $statement->execute();
        return $statement->fetch()["full_name"];
    }

    public function getAllAgents(){
        $statement = $this->connection->query("SELECT * FROM agents");
        $statement->execute();
        return $statement->fetch();
    }

    public function getAllAgentsIds(){
        $statement = $this->connection->query("SELECT DISTINCT id FROM agents");
        $statement->execute();
        return $statement->fetchAll();
    }
}