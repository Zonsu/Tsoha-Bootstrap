

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
        $services = OfferedServices::findByEmployee($id);

        View::make('employee/show.html', array('employee' => $employee, 'services' => $services));
    }

    public static function create() {
        $services = Service::all();

        View::make('employee/new.html', array('services' => $services));
    }

    public static function store() {

        $params = $_POST;
        $services = Service::all();

        $attributes = array(
            'name' => $params['name'],
            'special' => $params['special'],
            'introduction' => $params['introduction']
        );

        $employee = new Employee($attributes);

        $errors = $employee->errors();

        if (count($errors) == 0) {
            $employee->save();
            foreach ($services as $serv) {
                if (isset($_POST[$serv->id])) {
                    OfferedServicesController::create($employee->id, $serv->id);
                }
            }
            Redirect::to('/tyontekijat/' . $employee->id, array('message' => 'Työntekijä lisätty!'));
        } else {
            View::make('employee/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $employee = Employee::find($id);
        $services = Service::all();

//        

        $serviceList = OfferedServicesController::getServices($id, $services);
        View::make('employee/edit.html', array('attributes' => $employee, 'services' => $services, 'serviceList' => $serviceList));
    }

    public function update($id) {
        $params = $_POST;
        $services = Service::all();

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'special' => $params['special'],
            'introduction' => $params['introduction']
        );

        $employee = new Employee($attributes);
        $errors = $employee->errors();


        foreach ($services as $serv) {
            if (isset($_POST[$serv->id])) {

                OfferedServicesController::create($id, $serv->id);
            } else {
                OfferedServicesController::destroy($id, $serv->id);
            }
        }

        $serviceList = OfferedServicesController::getServices($id, $services);

        if (count($errors) > 0) {
            View::make('employee/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'services' => $services, 'serviceList' => $serviceList));
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

//    public static function listServices($id, $services) {
//
//        $offeredServices = OfferedServices::findByEmployee($id);
//        $serviceList = array();
//
//        foreach ($services as $service) {
//
//            foreach ($offeredServices as $emp) {
//
//                if ($service == $emp) {
//                    $serviceList[] = $service;
//                }
//            }
//        }
//        return $serviceList;
//    }

}
