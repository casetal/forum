<?php

class Messages {
    private $db;
    private $users;

    public function __construct() {
        $this->db = new Dbconnect();
        $this->users = new Users();
    }

    public function getTopicMessages($topic_id) {
        $messages = $this->db->select('SELECT * from `messages` WHERE `topic_id`='.$topic_id);

        foreach($messages as $key => &$message) {
            $messages[$key]['user'] = $this->users->getUser($messages[$key]['user_id'])[0]['name'];
            $messages[$key]['user_count_messages'] = count($this->getUserMessages($messages[$key]['user_id']));
            unset($messages[$key]['user_id']);
        }

        return $messages;
    }

    public function getUserMessages($user_ud) {
        $messages = $this->db->select('SELECT * from `messages` WHERE `user_id`='.$user_ud);
        return $messages;
    }

    public function createMessage($topic_id, $user_id, $message) {
        $message = $this->db->Insert('INSERT INTO `messages` (`message`, `topic_id`, `user_id`) VALUES ("' . $message . '", "' . $topic_id . '", "' . $user_id . '")');
        return $message;
    }
}