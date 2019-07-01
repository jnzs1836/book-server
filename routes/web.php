<?php
use App\Http\Controllers\BookController;

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
$router->post('/api/book/create','BookController@post');
$router->get('/api/book/{id}','BookController@get');
$router->post('/api/book/update/{id}','BookController@update');
$router->get('/api/book/search', 'BookController@search');


$router->post('/api/login', 'UserController@login');
$router->post('/api/user','UserController@post');
$router->get('/api/user','UserController@index');
$router->get('/api/user/{id}','UserController@get');

$router->post('/api/login','UserController@login');


$router->get('/api/reward/show', 'RewardController@index');
$router->post('/api/reward/create', 'RewardController@create');
$router->post('/api/reward/apply', 'RewardController@apply');
$router->post('/api/reward/confirm', 'RewardController@confirm');


$router->group(['middleware' => 'auth'], function () use ($router) {
    
$router->post('/api/order/create', 'OrderController@create');
$router->post('/api/order/confirm', 'OrderController@confirm');
$router->post('/api/order/finish', 'OrderController@finish');

    $router->get('/api/user/info', 'UserController@info');
    $router->get('/api/user/books', 'UserController@books');
    $router->get('/api/user/rewards', 'UserController@rewards');
    $router->get('/api/user/orders/selling', 'UserController@getSellingOrders');
    $router->get('/api/user/orders/buying', 'UserController@getBuyingOrders');
    $router->post('/api/message/send', 'MessageController@send');
    $router->get('/api/message/receive', 'MessageController@receive');
    $router->post('/api/book/update','BookController@update');
    $router->get('/api/message/book', 'MessageController@bookOwnerMessages');
    
});
$router->post('api/book/photo', 'BookController@uploadPhoto');
$router->get('api/book/list', 'BookController@bookList');


$router->get('/api/admin','AdminController@index');
$router->post('/api/admin','AdminController@post');
$router->get('/api/admin/{id}','AdminController@get');



$router->get('/api/hello','BookController@post');
