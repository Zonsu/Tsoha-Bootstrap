<?php

//navigaatio

$routes->get('/', function() {
    SiteController::index();
});

$routes->get('/henkilokunta', function() {
    SiteController::employee();
});

$routes->get('/kirjaudu', function() {
    SiteController::login();
});

$routes->get('/rekisteroidy', function() {
    SiteController::register();
});

$routes->get('/varaa', function() {
    SiteController::reservation();
});

$routes->get('/palvelut', function() {
    ServiceController::index();
});


//service

$routes->post('/palvelut/store', function() {
    ServiceController::store();
});

$routes->get('/palvelut/new', function() {
    ServiceController::create();
});

$routes->get('/palvelut/:id', function($id) {
    ServiceController::show($id);
});

$routes->get('/palvelut/:id/edit', function($id) {
    ServiceController::edit($id);
});
$routes->post('/palvelut/:id/edit', function($id) {
    ServiceController::update($id);
});

$routes->post('/palvelut/:id/destroy', function($id) {
    print("asdads");
    ServiceController::destroy($id);
});


//login & logout

$routes->post('/employeelogin', function() {
    EmployeeController::employee_login();
});

$routes->get('/employee/login', function() {
    EmployeeController::employee_login_page();
});

$routes->post('/logout', function(){
    SiteController::logout();
});








// VANHAT VERSIOT TÄSTÄ ALESPÄIN

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


