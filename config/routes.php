<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

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

$routes->get('/testipalvelut', function() {
    ServiceController::index();
});

$routes->get('/testipalvelut/:id', function($id){
    ServiceController::show($id);
});

