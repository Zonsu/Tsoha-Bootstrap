<?php

class ClientController extends BaseController {

    public static function client_login() {
        $params = $_POST;

        $client = Client::authenticate($params['username'], $params['password']);

        if (!$client) {

            View::make('login/index.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['client'] = $client->id;
            Redirect::to("/asiakkaat/omattiedot");
        }
    }


    public static function create() {
        View::make('client/new.html');
    }

    public static function show() {
        self::check_client_logged_in();
        View::make('client/show.html');
    }

    public static function store() {

        $params = $_POST;
        $attributes = array(
            'firstName' => $params['firstName'],
            'lastName' => $params['lastName'],
            'username' => $params['username'],
            'password' => $params['password']
        );

        $client = new Client($attributes);
        $client->save();


//        if (count($errors) == 0) {
//            $employee->save();
//            foreach ($services as $serv) {
//                if (isset($_POST[$serv->id])) {
//                    OfferedServicesController::create($employee->id, $serv->id);
//                }
//            }
            Redirect::to('/asiakkaat/omattiedot', array('message' => 'Uusi tunnus luotu!'));
//        } else {
//            View::make('employee/new.html', array('errors' => $errors, 'attributes' => $attributes));
//        }
    }

}
