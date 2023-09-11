<?php

class Users {
    private $db;

    private $messages;

    public function __construct() {
        $this->db = new Dbconnect();
    }

    public function getUsers() {
        $users = $this->db->select('SELECT * from `users` ORDER BY `id` DESC');

        return $users;
    }

    public function getUser($user_id) {
        $user = $this->db->select('SELECT * from `users` WHERE `id`=' . $user_id);

        return $user;
    }

    public function createUser($name) {
        $searchUser = $this->db->select('SELECT * from `users` WHERE LOWER(`name`)="' . strtolower($name) . '"');

        if(count($searchUser) == 0) {
            $user = $this->db->Insert('INSERT INTO `users` (`name`) VALUES ("' . $name . '")');

            return $user;
        } else {
            return ['error' => 'Такой пользователь уже есть'];
        }
    }
}