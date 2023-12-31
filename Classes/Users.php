<?php

class Users {
    private $db;

    private $messages;

    public function __construct() {
        $this->db = new Dbconnect();
    }
    
    /**
     * Список пользователей
     *
     * @return array
     */
    public function getUsers() {
        $users = $this->db->select('SELECT * from `users` ORDER BY `id` DESC');

        return $users;
    }
    
    /**
     * Получение данных пользователя
     *
     * @param  int $user_id
     * @return array
     */
    public function getUser($user_id) {
        $user_id = $this->db->connection->real_escape_string($user_id);
        
        $user = $this->db->select('SELECT * from `users` WHERE `id`=' . $user_id);

        return $user;
    }
    
    /**
     * Создание пользователя с проверкой на его существование
     *
     * @param  string $name
     * @return int
     */
    public function createUser($name) {
        $name = $this->db->connection->real_escape_string($name);

        $searchUser = $this->db->select('SELECT * from `users` WHERE LOWER(`name`)="' . strtolower($name) . '"');

        if(count($searchUser) == 0) {
            $user_id = $this->db->Insert('INSERT INTO `users` (`name`) VALUES ("' . $name . '")');
            return $user_id;
        } else {
            return $searchUser[0]['id'];
        }
    }
}