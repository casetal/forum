<?php

class Dbconnect {
    private $host;
    private $user;
    private $pass;
    private $name;

    public $connection;

    public function __construct() {
        try {
            $this->host = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->name = "forum";

            $this->connection = new mysqli(
                $this->host,
                $this->user,
                $this->pass,
                $this->name
            );
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }
    }

    public function Select($query) {
        try {
            $result = [];

            $query_result = $this->connection->query($query);

            while ($row = $query_result->fetch_assoc())
			    array_push($result, $row);
            
            return $result;
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }
    }

    public function Insert($query) {
        try {
            $this->connection->query($query);

            return $this->connection->insert_id;
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }
    }
}