<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Client
 *
 * @author johanna
 */
class Client extends BaseModel {

    public $id, $firstName, $lastName, $username, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Client WHERE username=:username AND password=:password LIMIT 1', array('username' => $username, 'password' => $password));
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $client = Client::createClient($row);
            return $client;
        } else {
            return null;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Client (firstName, lastName, username, password) VALUES (:firstName, :lastName, :username, :password) RETURNING id');

        $query->execute(array('firstName' => $this->firstName, 'lastName' => $this->lastName, 'username' => $this->username, 'password' => $this->password));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Client WHERE  id = :id LIMIT 1');

        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $client = Client::createClient($row);
        }
        return $client;
    }

    public static function findByUsername($username) {

        $query = DB::connection()->prepare('SELECT * FROM Client WHERE username = :username LIMIT 1');

        $query->execute(array('username' => $username));
        $row = $query->fetch();

        if ($row) {
            $client = Client::createClient($row);
        }
        return $client;
    }

    public static function createClient($row) {

        $client = new Client(array(            
            'id' => $row['id'],
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'username' => $row['username'],
            'password' => $row['password']
        ));
        return $client;
    }

}
