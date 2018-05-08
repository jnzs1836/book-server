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

$router->get('/application','ApplicationController@index');
$router->get('/application/available','ApplicationController@available');
$router->post('/application','ApplicationController@post');

$router->get('/book','BookController@index');
$router->get('/book/available','BookController@available');
$router->post('/book','BookController@post');

$router->post('/card','CardController@post');
$router->get('/card','CardController@index');
$router->get('/card/{id}','CardController@get');

$router->get('/record','RecordController@index');
$router->post('/record','RecordController@post');
$router->get('/record/{id}','RecordController@get');
$router->post('/record/deal','RecordController@dealApplication');
$router->post('/record/return','RecordController@returnBook');

$router->get('/admin','AdminController@index');
$router->post('/admin','AdminController@post');
$router->get('/admin/{id}','AdminController@get');



$router->get('/hello','BookController@post');
