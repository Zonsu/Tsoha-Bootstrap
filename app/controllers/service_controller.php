<?php

class ServiceController extends BaseController{
    public static function index() {
        $services = Service::all();
        
        View::make('service/index.html', array('services' => $services));
    }
}



