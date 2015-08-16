<?php

require 'app/models/Service.php';

class HelloWorldController extends BaseController {

    public static function index() {

        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {

        $service = Service::find(1);
        $services = Service::all();
        $employees = Employee::all();
        $employee = Employee::find(1);

        $service2 = new Service(array(
            'name' => 'aasdd',
            'price' => "2",
            'description' => "asfafaf"
        ));
        $errors = $service2->errors();

        Kint::dump($employee);
        Kint::dump($employees);
        Kint::dump($service);
        Kint::dump($services);
        Kint::dump($errors);

//        View::make('helloworld.html');
    }

    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function service_list() {
        View::make('suunnitelmat/palvelulista.html');
    }

    public static function employee_list() {
        View::make('suunnitelmat/tyontekijat.html');
    }

    public static function employee_show() {
        View::make('suunnitelmat/tyontekija.html');
    }

    public static function employee_edit() {
        View::make('suunnitelmat/muokkaatyontekija.html');
    }

}
