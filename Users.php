<?php

// include('Db.php');

class Users {
    private $db;

    public function __construct() {
        $this->db = new Dbconnect();
    }

    public function getUsers() {
        $topics = $this->db->select('SELECT * from `users` ORDER BY `id` DESC');

        return $topics;
    }

    public function getUser($id) {
        $topic = $this->db->select('SELECT * from `users` WHERE `id`=' . $id);

        return $topic;
    }
}