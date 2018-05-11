<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->resource('book', 'BookController');
$router->get('/book','BookController@index');

$router->get('/api/application','ApplicationController@index');
$router->get('/api/application/available','ApplicationController@available');
$router->post('/api/application','ApplicationController@post');
$router->post('/api/application/create','ApplicationController@create');


$router->get('/api/book','BookController@index');
$router->get('/api/book/available','BookController@available');
$router->post('/api/book','BookController@post');

$router->post('/api/card','CardController@post');
$router->get('/api/card','CardController@index');
$router->get('/api/card/{id}','CardController@get');

$router->get('/api/record','RecordController@index');
$router->post('/api/record','RecordController@post');
$router->post('/api/record/create','RecordController@create');
$router->get('/api/record/{id}','RecordController@get');
$router->post('/api/record/deal','RecordController@dealApplication');
$router->post('/api/record/return','RecordController@returnBook');

$router->get('/api/admin','AdminController@index');
$router->post('/api/admin','AdminController@post');
$router->get('/api/admin/{id}','AdminController@get');



$router->get('/api/hello','BookController@post');
