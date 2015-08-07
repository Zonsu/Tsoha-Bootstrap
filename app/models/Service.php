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
    }

    public static function all() {
     
        $query = DB::connection()->prepare('SELECT * FROM Service');
        $query->execute();

        $rows = $query->fetchAll();
        $services = array();

        foreach ($rows as $row) {
            $services[] = new Service(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'description' => $row['description']
            ));
        }
        return $services;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Service WHERE  id = :id LIMIT 1');

        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $service = new Service(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'description' => $row['description']
            ));
        }
        return $service;
    }
    
    

//    public static function createService($row) {
//
//        $service = new Service(array(
//            'id' => $row['id'],
//            'name' => $row['name'],
//            'price' => $row['price'],
//            'description' => $row['description']
//        ));
//        return $service;
//    }

}
