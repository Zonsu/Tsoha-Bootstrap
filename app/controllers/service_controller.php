<?php

require 'app/controllers/offered_services_controller.php';
class ServiceController extends BaseController {

    public static function index() {
        $services = Service::all();

        View::make('service/index.html', array('services' => $services));
    }

    public static function show($id) {
        $service = Service::find($id);
        $offeredServices = OfferedServices::findByService($id);


        View::make('service/show.html', array('service' => $service, 'offeredServices' => $offeredServices));
    }

    public static function create() {
        $employees = Employee::all();
        View::make('service/new.html', array('employees' => $employees));
    }

    public static function store() {

        $params = $_POST;
        $employees = Employee::all();

        $attributes = array(
            'name' => $params['name'],
            'price' => $params['price'],
            'description' => $params['description']
        );

        $service = new Service($attributes);
        $errors = $service->errors();


        if (count($errors) == 0) {
            $service->save();

            foreach ($employees as $emp) {
                if (isset($_POST[$emp->id])) {
                    OfferedServicesController::create($emp->id, $service->id);
                }
            }
            Redirect::to('/palvelut/' . $service->id, array('message' => 'Uusi palvelu luotu!'));
        } else {
            View::make('service/new.html', array('errors' => $errors, 'attributes' => $attributes, 'employees' => $employees));
        }
    }

    public static function edit($id) {
        $service = Service::find($id);
//        $offeredServices = OfferedServices::findByService($id);
        $employees = Employee::all();

//        
  
        $employeeList = OfferedServicesController::getEmployees($id, $employees);


        View::make('service/edit.html', array('attributes' => $service, 'employeeList' => $employeeList, 'employees' => $employees));
    }

    public static function update($id) {
        $params = $_POST;
        $employees = Employee::all();

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'price' => $params['price'],
            'description' => $params['description']
        );

        $service = new Service($attributes);
        $errors = $service->errors();

//        $list = $_POST['checkbox'];

        foreach ($employees as $emp) {


            if (isset($_POST[$emp->id])) {

                OfferedServicesController::create($emp->id, $id);
//                $attr = array(
//                    'employeeid' => $emp->id,
//                    'serviceid' => $id
//                );
//                $offer = new OfferedServices($attr);
//                $offer->save();
            } else {
                OfferedServicesController::destroy($emp->id, $id);
//                $offer = new OfferedServices(array('employeeid' => $emp->id, 'serviceid' => $id));
//                $offer->destroy($emp->id, $id);
            }
        }

//
//        foreach ($list as $employee) {
//            $attr = array(
//                'employeeid' => $employee,
//                'serviceid' => $id
//            );
//
//            $offer = new OfferedServices($attr);
//            $offer->save();
//        }
        $employeeList = OfferedServicesController::getEmployees($id, $employees);

        if (count($errors) > 0) {
            View::make('service/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'employees' => $employees, 'employeeList' => $employeeList));
        } else {
            $service->update();
            Redirect::to('/palvelut/' . $service->id, array('message' => "Palveluun tehdyt muutokset tallennettu!"));
        }
    }

    public static function destroy($id) {

        $service = new Service(array('id' => $id));
        $service->destroy($id);

        Redirect::to('/palvelut', array('message' => 'Palvelu poistettu onnistuneesti!'));
    }

//    public static function getEmployees($id) {
//
//        $offeredServices = OfferedServices::findByService($id);
//        $employees = Employee::all();
//        $employeeList = array();
//
//        foreach ($employees as $employee) {
//
//            foreach ($offeredServices as $serv) {
//
//                if ($employee == $serv) {
//                    $employeeList[] = $employee;
//                }
//            }
//        }
//        return $employeeList;
//    }
}
