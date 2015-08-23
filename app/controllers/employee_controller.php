<?php

class EmployeeController extends BaseController {

    public static function login() {
        View::make('login/index.html');
    }

    public static function index() {
        $employees = Employee::all();

        View::make('employee/index.html', array('employees' => $employees));
    }

    public static function show($id) {
        $employee = Employee::find($id);

        View::make('employee/show.html', array('employee' => $employee));
    }

    public static function create() {
        View::make('emloyee/new.html');
    }

    public static function employee_login() {
        $params = $_POST;

        $employee = Employee::authenticate($params['username'], $params['password']);

        if (!$employee) {

            View::make('login/index.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['employee'] = $employee->id;
            Redirect::to("/employee/login");
        }
    }

    public static function employee_login_page() {
        View::make('employee/login.html');
    }

}
