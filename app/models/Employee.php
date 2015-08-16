<?php

class Employee extends BaseModel {

    public $id, $name, $startingDate, $special, $introducion, $management, $username, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Employee WHERE username=:username AND password=:password LIMIT 1', array('username' => $username, 'password' => $password));
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $employee = Employee::createEmployee($row);
            return $employee;
        } else {
            return null;
        }
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Employee');
        $query->execute();

        $rows = $query->fetchAll();
        $employees = array();

        foreach ($rows as $row) {
            $employees[] = Employee::createEmployee($row);
        }
        return $employees;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Employee WHERE  id = :id LIMIT 1');

        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $employee = Employee::createEmployee($row);
        }
        return $employee;
    }

    public static function createEmployee($row) {

        $employee = new Employee(array(
            'id' => $row['id'],
            'name' => $row['name'],
//            'startingDate' => $row['startingDate'],
            'special' => $row['special'],
            'introduction' => $row['introduction'],
            'management' => $row['management'],
            'username' => $row['username'],
            'password' => $row['password']
        ));
        return $employee;
    }

}
