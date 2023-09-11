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
    
    /**
     * Массив с топиками с пагинацией
     *
     * @param  int $page
     * @param  int $results_per_page
     * @return array
     */
    public function getTopics($page = 1, $results_per_page = 10) {
        $query = 'SELECT * from `topics` ORDER BY `id` DESC';

        $topics = $this->db->select($query);

        $page_first_result = ($page-1) * $results_per_page;  
        $number_of_result = count($topics);
        $pages = ceil ($number_of_result / $results_per_page);

        $topics = $this->db->select($query . ' LIMIT ' . $page_first_result . ',' . $results_per_page);

        foreach($topics as $key => &$topic) {
            $topics[$key]['user'] = $this->users->getUser($topics[$key]['user_id'])[0]['name'];
            $topics[$key]['count_messages'] = count($this->messages->getTopicMessages($topics[$key]['id']));
            unset($topics[$key]['user_id']);
        }

        $topics['pages'] = $pages;

        return $topics;
    }
    
    /**
     * Получение топика
     *
     * @param  mixed $id
     * @return array
     */
    public function getTopic($id) {
        $id = $this->db->connection->real_escape_string($id);

        $topic = $this->db->select('SELECT * from `topics` WHERE `id`=' . $id)[0];
        $topic['user'] = $this->users->getUser($topic['user_id'])[0]['name'];
        $topic['user_count_messages'] = count($this->messages->getUserMessages($topic['user_id']));

        return $topic;
    }
    
    /**
     * Создание топика
     *
     * @param  int $user_id
     * @param  string $name
     * @param  string $description
     * @return int
     */
    public function createTopic($user_id, $name, $description) {
        $user_id = $this->db->connection->real_escape_string($user_id);
        $name = $this->db->connection->real_escape_string($name);
        $description = $this->db->connection->real_escape_string($description);

        $topic = $this->db->Insert('INSERT INTO `topics` (`name`, `description`, `user_id`) VALUES ("' . $name . '", "' . $description . '", "' . $user_id . '")');
        return $topic;
    }
}