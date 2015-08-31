<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['employee'])) {
            $employee_id = $_SESSION['employee'];

            $employee = Employee::find($employee_id);

            return $employee;
        }
        return null;
    }

    public static function check_employee_logged_in() {
        if (!isset($_SESSION['employee'])) {
            Redirect::to('/kirjaudu', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

    public static function check_client_logged_in() {
        if (!isset($_SESSION['client'])) {
            Redirect::to('/kirjaudu', array('message' => 'Kirjaudu ensin asiakastunnuksella sisään!'));
        }
    }

}
