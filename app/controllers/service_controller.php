<?php

class ServiceController extends BaseController {

    public static function index() {
        $services = Service::all();

        View::make('service/index.html', array('services' => $services));
    }

    public static function show($id) {
        $service = Service::find($id);

        View::make('service/show.html', array('service' => $service));
    }

    public static function create() {
        View::make('service/new.html');
    }

    public static function store() {

        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'price' => $params['price'],
            'description' => $params['description']
        );

        $service = new Service($attributes);
        $errors = $service->errors();

        if (count($errors) == 0) {
            $service->save();
            Redirect::to('/palvelut/' . $service->id, array('message' => 'Uusi palvelu luotu!'));
        } else {
            View::make('service/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
