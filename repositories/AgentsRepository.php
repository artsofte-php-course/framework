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

    public function getIdByAgentsName($name){
        $statement = $this->connection->query("SELECT id FROM agents WHERE full_name = '" . $name . "' LIMIT 1;");
        if(!$statement) {
            return [-1, -1];
        }
        $statement->execute();
        return $statement->fetch();
    }

    public function addNewAgent($name){
        $statement = $this->connection->query('INSERT INTO agents (full_name) VALUE (\'' . $name . '\');');
//        echo 'added new mfr';
//        $statement->execute();
    }
}