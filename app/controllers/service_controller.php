<?php

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

    public static function edit($id) {
        $service = Service::find($id);
        View::make('service/edit.html', array('attributes' => $service));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'price' => $params['price'],
            'description' => $params['description']
        );

        $service = new Service($attributes);
        $errors = $service->errors();

        if (count($errors) > 0) {
            View::make('service/edit.html', array('errors' => $errors, 'attributes' => $attributes));
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

}
