<?php

class OfferedServices extends BaseModel {

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function findByEmployee($id) {
        
    }

    public static function findByService($id) {
        $query = DB::connection()->prepare('SELECT Employee.* FROM Offered_services INNER JOIN Employee ON (Offered_services.employeeID = Employee.id) WHERE  serviceID = :serviceID');
        $query->execute(array('serviceID' => $id));
        $rows = $query->fetchAll();

        $employees = array();

        foreach ($rows as $row) {
            $employees[] = Employee::createEmployee($row);
        }
        return $employees;
    }

}
