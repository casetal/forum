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
            $topics[$key]['count_messages'] = count($this->messages->getTopicMessages($topics[$key]['id']));
            unset($topics[$key]['user_id']);
        }

        return $topics;
    }

    public function getTopic($id) {
        $id = $this->db->connection->real_escape_string($id);

        $topic = $this->db->select('SELECT * from `topics` WHERE `id`=' . $id)[0];
        $topic['user'] = $this->users->getUser($topic['user_id'])[0]['name'];
        $topic['user_count_messages'] = count($this->messages->getUserMessages($topic['user_id']));

        return $topic;
    }

    public function createTopic($user_id, $name, $description) {
        $user_id = $this->db->connection->real_escape_string($user_id);
        $name = $this->db->connection->real_escape_string($name);
        $description = $this->db->connection->real_escape_string($description);

        $topic = $this->db->Insert('INSERT INTO `topics` (`name`, `description`, `user_id`) VALUES ("' . $name . '", "' . $description . '", "' . $user_id . '")');
        return $topic;
    }
}