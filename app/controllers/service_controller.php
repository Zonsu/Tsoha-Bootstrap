<?php

class ServiceController extends BaseController{
    public static function index() {
        $services = Service::all();
        
        View::make('service/index.html', array('services' => $services));
    }
    
    public static function show($id) {
        $service = Service::find($id);
        
        View::make('service/show.html', array('service' => $service));
    }
}



