<?php

// include('Db.php');

class Users {
    private $db;

    private $messages;

    public function __construct() {
        $this->db = new Dbconnect();
    }

    public function getUsers() {
        $topics = $this->db->select('SELECT * from `users` ORDER BY `id` DESC');

        return $topics;
    }

    public function getUser($user_id) {
        $topic = $this->db->select('SELECT * from `users` WHERE `id`=' . $user_id);

        return $topic;
    }
}