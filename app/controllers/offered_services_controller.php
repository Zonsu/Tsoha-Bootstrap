<?php

class OfferedServicesController extends BaseController {

    public static function create($empid, $servid) {
        $attr = array(
            'employeeid' => $empid,
            'serviceid' => $servid
        );
        $offer = new OfferedServices($attr);
        $offer->save();
    }

    public static function destroy($empid, $servid) {
        $attr = array(
            'employeeid' => $empid,
            'serviceid' => $servid
        );
        $offer = new OfferedServices($attr);
        $offer->destroy($empid, $servid);
    }

    public static function getEmployees($id, $employees) {

        $offeredServices = OfferedServices::findByService($id);
        $employeeList = array();

        foreach ($employees as $employee) {

            foreach ($offeredServices as $serv) {

                if ($employee == $serv) {
                    $employeeList[] = $employee;
                }
            }
        }
        return $employeeList;
    }

    public static function getServices($id, $services) {

        $offeredServices = OfferedServices::findByEmployee($id);
        $serviceList = array();

        foreach ($services as $service) {

            foreach ($offeredServices as $emp) {

                if ($service == $emp) {
                    $serviceList[] = $service;
                }
            }
        }
        return $serviceList;
    }

}
