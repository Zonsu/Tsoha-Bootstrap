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
