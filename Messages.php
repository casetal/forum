<?php

class Messages {
    private $db;

    public function __construct() {
        $this->db = new Dbconnect();
        $this->users = new Users();
    }

    public function getMessages($topic_id) {
        $messages = $this->db->select('SELECT * from `messages` WHERE `topic_id`='.$topic_id);
        return $messages;
    }
}