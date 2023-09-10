<?php

class Topics {
    private $db;
    private $users;
    private $messages;

    public function __construct() {
        $this->db = new Dbconnect();
        $this->users = new Users();
        $this->messages = new Messages();
    }

    public function getTopics() {
        $topics = $this->db->select('SELECT * from `topics` ORDER BY `id` DESC');

        foreach($topics as $key => &$topic) {
            $topics[$key]['user'] = $this->users->getUser($topics[$key]['user_id'])[0]['name'];
            $topics[$key]['count_messages'] = count($this->messages->getMessages($topics[$key]['id']));
            unset($topics[$key]['user_id']);
        }

        return $topics;
    }

    public function getTopic($id) {
        $topic = $this->db->select('SELECT * from `topics` WHERE `id`=' . $id);
        
        return $topic;
    }
}