<?php

/**
 * Luokka kannassa oleville palveluille. Palvelulla on nimi, hinta, kuvaus sekä
 *  sitä tarjoavat työntekijät jotka löytyvät offered_services taulusta.
 *
 * @author johanna
 */
class Service extends BaseModel {

    public $id, $name, $price, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_price', 'validate_description');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Service');
        $query->execute();

        $rows = $query->fetchAll();
        $services = array();

        foreach ($rows as $row) {
            $services[] = Service::createService($row);
        }
        return $services;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Service WHERE  id = :id LIMIT 1');

        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $service = Service::createService($row);
        }
        return $service;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Service (name, price, description) VALUES (:name, :price, :description) RETURNING id');

        $query->execute(array('name' => $this->name, 'price' => $this->price, 'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public static function createService($row) {

        $service = new Service(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'description' => $row['description']
        ));
        return $service;
    }

    public function validate_name() {;
        $metodi = 'validate_string_length';
        $errors = $this->$metodi('Nimi', $this->name, 3);

        return $errors;
    }

    public function validate_description() {
        $metodi = 'validate_string_length';
        $errors = $this->$metodi('Kuvaus', $this->description, 5);

        return $errors;
    }

    public function validate_price() {
        $metodi = 'validate_int';
        $errors = $this->$metodi('Hinta', $this->price);

        return $errors;
    }

}
