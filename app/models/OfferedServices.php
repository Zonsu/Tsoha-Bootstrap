<?php

class OfferedServices extends BaseModel {

    public $id, $employeeid, $serviceid;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Offered_services (employeeid, serviceid) VALUES (:employeeid, :serviceid)');

        $employees = OfferedServices::findByService($this->serviceid);

        if (empty($employees)) {

            $query->execute(array('employeeid' => $this->employeeid, 'serviceid' => $this->serviceid));
        } else {
            $duplicates = array();

            foreach ($employees as $employee) {
                if ($employee->id == $this->employeeid) {
                    $duplicates = $employee;
                    break;
                }
            }
            if (empty($duplicates)) {
                $query->execute(array('employeeid' => $this->employeeid, 'serviceid' => $this->serviceid));
            }
        }

//
//        $row = $query->fetch();
//        $this->id = $row['id'];
    }

    public function destroy($employeeid, $serviceid) {
        $query = DB::connection()->prepare('DELETE FROM Offered_Services WHERE employeeid = :employeeid AND serviceid = :serviceid');
        $query->execute(array(
            'employeeid' => $employeeid,
            'serviceid' => $serviceid));
    }

    public static function findByEmployee($id) {
        $query = DB::connection()->prepare('SELECT Service.* FROM Offered_services INNER JOIN Service ON (Offered_services.serviceID = Service.id) WHERE  employeeID = :employeeID');
        $query->execute(array('employeeID' => $id));
        $rows = $query->fetchAll();

        $services = array();

        foreach ($rows as $row) {
            $services[] = Service::createService($row);
        }
        return $services;
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
