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
        View::make('employee/new.html');
    }

    public static function store() {

        $params = $_POST;
        print("rivi 1");

        $attributes = array(
            'name' => $params['name'],
            'special' => $params['special'],
            'introduction' => $params['introduction']
        );
        print("rivi 2");

        $employee = new Employee($attributes);
        print("rivi 3");

        $errors = $employee->errors();

        print("rivi 4");
        if (count($errors) == 0) {
            $employee->save();
            Redirect::to('/tyontekijat/' . $employee->id, array('message' => 'Työntekijä lisätty!'));
        } else {
            View::make('employee/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $employee = Employee::find($id);
        View::make('employee/edit.html', array('attributes' => $employee));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'special' => $params['special'],
            'introduction' => $params['introduction']
        );

        $employee = new Employee($attributes);
        $errors = $employee->errors();

        if (count($errors) > 0) {
            View::make('employee/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $employee->update();
            Redirect::to('/tyontekijat/' . $employee->id, array('message' => "Työntekijään tehdyt muutokset tallennettu!"));
        }
    }

    public static function destroy($id) {

        $employee = new Employee(array('id' => $id));
        $employee->destroy($id);

        Redirect::to('/tyontekijat', array('message' => 'Työntekijä poistettu onnistuneesti!'));
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
