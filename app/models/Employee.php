<?php

class Employee extends BaseModel {

    public $id, $name, $special, $introduction, $management, $username, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_special', 'validate_introduction');
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

    public static function findByUsername($username) {

        $query = DB::connection()->prepare('SELECT * FROM Employee WHERE username = :username LIMIT 1');

        $query->execute(array('username' => $username));
        $row = $query->fetch();

        if ($row) {
            $employee = Employee::createEmployee($row);
        }
        return $employee;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Employee (name, special, introduction) VALUES (:name, :special, :introduction) RETURNING id');

        $query->execute(array('name' => $this->name, 'special' => $this->special, 'introduction' => $this->introduction));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Employee SET name =:name, special=:special, introduction=:introduction, management=:management, username:=username, password:=password WHERE id=:id');

        $query->execute(array('name' => $this->name, 'special' => $this->special, 'introduction' => $this->introducion, 'management' => $this->management, 'username' => $this->username, 'password' => $this->password, 'id' => $this->id));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Employee WHERE id = :id');
        $query->execute(array(
            'id' => $id));
    }

    public static function createEmployee($row) {

        $employee = new Employee(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'special' => $row['special'],
            'introduction' => $row['introduction'],
            'management' => $row['management'],
            'username' => $row['username'],
            'password' => $row['password']
        ));
        return $employee;
    }

    public function validate_name() {

        $metodi = 'validate_string_length';
        $errors = $this->$metodi('Nimi', $this->name, 3);

        return $errors;
    }

    public function validate_introduction() {
        $metodi = 'validate_string_length';
        $errors = $this->$metodi('Esittely', $this->introduction, 5);

        return $errors;
    }

    public function validate_password() {
        $metodi = 'validate_string_length';
        $errors = $this->$metodi('Salasana', $this->password, 5);

        return $errors;
    }

    public function validate_special() {
        $metodi = 'validate_string_length';
        $errors = $this->$metodi('Hinta', $this->special, 5);

        return $errors;
    }

    public function validate_username() {
        $errors = array();

        $metodi = 'validate_string_length';
        $errors[] = $this->$metodi('Käyttäjänimi', $this->username, 5);

        $user_validate = 'findByUsername';
        if ($this->$user_validate($this->$username) != NULL) {
            $errors[] = 'Käyttäjänimi on jo käytössä';
        }

        return $errors;
    }

}
