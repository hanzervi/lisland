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

Route::get('/admin/user/accounts', 'UserAccounts@index');
Route::get('/admin/user/accounts/table', 'UserAccounts@table');
Route::get('/admin/user/accounts/get/{id}', 'UserAccounts@get');
Route::post('/admin/user/accounts/add', 'UserAccounts@add');
Route::post('/admin/user/accounts/update', 'UserAccounts@update');
Route::post('/admin/user/accounts/remove/{id}', 'UserAccounts@remove');