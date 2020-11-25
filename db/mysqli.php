<?php

class MySqla {

    protected $host = "localhost:3306";
    protected $user = "akiselev";
    protected $password = "ktototam4";
    public $db = "akiselev";
    public $connection = null;

    public function __construct(){
        $this->makeConnection();
    }
    public function __destruct(){
        if($this->connection != null){
            $this->connection->close();
            $this->connection = null;
        }
    }
    protected function makeConnection(){
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db);
        if($this->connection->connect_error){
            echo " Fail" . $this->connection->connect_error;
        }
    }
    public function ExecuteQuery($query){
        $result = $this->connection->query($query);
        //if (!$result)   echo "Error: ".$this->connection->error." = ".$query;
        return $result;
    }
    public function GetError(){
        return $this->connection->error;
    }
    public function cleanParameters($parameters){
        return $this->connection->real_escape_string($parameters);
    }
}

?>