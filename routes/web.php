<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WebsiteController@index');

Auth::routes();

/* ADMIN ---------------------------------------------------------------------- */

Route::get('/admin', function() {
    return redirect('login');
});

Route::get('/admin/customer/', 'CustomerController@index');
Route::get('/admin/customer/table', 'CustomerController@table');

Route::get('/admin/food-and-drink/', 'FoodDrinkController@index');
Route::get('/admin/food-and-drink/table', 'FoodDrinkController@table');
Route::get('/admin/food-and-drink/get/{id}', 'FoodDrinkController@get');
Route::get('/admin/food-and-drink/bin', 'FoodDrinkController@bin');
Route::get('/admin/food-and-drink/bin/table', 'FoodDrinkController@binTable');
Route::post('/admin/food-and-drink/bin/restore/{id}', 'FoodDrinkController@restore');
Route::post('/admin/food-and-drink/bin/removeP/{id}', 'FoodDrinkController@removeP');
Route::post('/admin/food-and-drink/add', 'FoodDrinkController@add');
Route::post('/admin/food-and-drink/update', 'FoodDrinkController@update');
Route::post('/admin/food-and-drink/remove/{id}', 'FoodDrinkController@remove');

Route::get('/admin/users/', 'UserController@index');
Route::get('/admin/users/table', 'UserController@table');
Route::get('/admin/users/get/{id}', 'UserController@get');
Route::get('/admin/users/bin', 'UserController@bin');
Route::get('/admin/users/bin/table', 'UserController@binTable');
Route::post('/admin/users/bin/restore/{id}', 'UserController@restore');
Route::post('/admin/users/add', 'UserController@add');
Route::post('/admin/users/update', 'UserController@update');
Route::post('/admin/users/remove/{id}', 'UserController@remove');
Route::post('/admin/users/profile', 'UserController@profile');