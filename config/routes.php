<?php


$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
});

$routes->get('/palvelu', function() {
    HelloWorldController::service_list();
});
$routes->get('/tyontekija/', function() {
    HelloWorldController::employee_list();
});
$routes->get('/tyontekija/1', function() {
    HelloWorldController::employee_show();
});
$routes->get('/tyontekija/1/edit', function() {
    HelloWorldController::employee_edit();
});

$routes->get('/', function() {
    ServiceController::index();
});

$routes->post('/testipalvelut', function() {
    ServiceController::store(); 
});

$routes->get('/testipalvelut/new', function() {
    ServiceController::create();
});

$routes->get('/testipalvelut/:id', function($id){
    ServiceController::show($id);
});


