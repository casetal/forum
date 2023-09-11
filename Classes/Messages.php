<?php

class Messages {
    private $db;
    private $users;

    public function __construct() {
        $this->db = new Dbconnect();
        $this->users = new Users();
    }
    
    /**
     * Список сообщений топика с пагинацией
     *
     * @param  int $topic_id
     * @param  int $page
     * @param  int $results_per_page
     * @return array
     */
    public function getTopicMessages($topic_id, $page = 0, $results_per_page = 10) {
        $topic_id = $this->db->connection->real_escape_string($topic_id);

        $query = 'SELECT * from `messages` WHERE `topic_id`='.$topic_id;
        $messages = $this->db->select($query);

        if($page != 0) {
            $page_first_result = ($page-1) * $results_per_page;  
            $number_of_result = count($messages);
            $pages = ceil ($number_of_result / $results_per_page);  

            $messages = $this->db->select($query . ' LIMIT ' . $page_first_result . ',' . $results_per_page);

            foreach($messages as $key => &$message) {
                $messages[$key]['user'] = $this->users->getUser($messages[$key]['user_id'])[0]['name'];
                $messages[$key]['user_count_messages'] = count($this->getUserMessages($messages[$key]['user_id']));
                unset($messages[$key]['user_id']);
            }

            $messages['pages'] = $pages;
        }

        return $messages;
    }
    
    /**
     * Получение массива с ответами из пользователя
     *
     * @param  int $user_id
     * @return array
     */
    public function getUserMessages($user_id) {
        $user_id = $this->db->connection->real_escape_string($user_id);

        $messages = $this->db->select('SELECT * from `messages` WHERE `user_id`='.$user_id);
        return $messages;
    }
    
    /**
     * Отправка (создание) сообщения в топик
     *
     * @param  int $topic_id
     * @param  int $user_id
     * @param  string $message
     * @return int
     */
    public function createMessage($topic_id, $user_id, $message) {
        $topic_id = $this->db->connection->real_escape_string($topic_id);
        $user_id = $this->db->connection->real_escape_string($user_id);
        $message = $this->db->connection->real_escape_string($message);

        $message = $this->db->Insert('INSERT INTO `messages` (`message`, `topic_id`, `user_id`) VALUES ("' . $message . '", "' . $topic_id . '", "' . $user_id . '")');
        return $message;
    }
}