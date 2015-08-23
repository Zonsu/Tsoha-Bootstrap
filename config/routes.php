<?php

//navigaatio

$routes->get('/', function() {
    SiteController::index();
});

$routes->get('/tyontekijat', function() {
    EmployeeController::index();
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
    ServiceController::destroy($id);
});

//employee

$routes->post('/tyontekijat/store', function() {
    EmployeeController::store();
});

$routes->get('/tyontekijat/new', function() {
    EmployeeController::create();
});

$routes->get('/tyontekijat/:id', function($id) {
    EmployeeController::show($id);
});

$routes->get('/tyontekijat/:id/edit', function($id) {
    EmployeeController::edit($id);
});
$routes->post('/tyontekijat/:id/edit', function($id) {
    EmployeeController::update($id);
});

$routes->post('/tyontekijat/:id/destroy', function($id) {
    EmployeeController::destroy($id);
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


