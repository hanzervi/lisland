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

Route::get('/admin/booking/onsite', 'BookOnsiteController@index');
Route::get('/admin/booking/onsite/table', 'BookOnsiteController@table');
Route::get('/admin/booking/onsite/get/{id}', 'BookOnsiteController@get');
Route::get('/admin/booking/onsite/status/{id}/{status}', 'BookOnsiteController@updateStatus');
Route::post('/admin/booking/onsite/check-room-capacity', 'BookOnsiteController@checkRoomCapacity');
Route::post('/admin/booking/onsite/check-room', 'BookOnsiteController@checkRoom');
Route::post('/admin/booking/onsite/add', 'BookOnsiteController@add');
Route::post('/admin/booking/onsite/remarks-update', 'BookOnsiteController@remarksUpdate');

Route::get('/admin/room/', 'RoomController@index');
Route::get('/admin/room/table', 'RoomController@table');
Route::get('/admin/room/get/{id}', 'RoomController@get');
Route::get('/admin/room/bin', 'RoomController@bin');
Route::get('/admin/room/bin/table', 'RoomController@binTable');
Route::get('/admin/room/image360/{id}', 'RoomController@image360');
Route::post('/admin/room/bin/restore/{id}', 'RoomController@restore');
Route::post('/admin/room/bin/removeP/{id}', 'RoomController@removeP');
Route::post('/admin/room/add', 'RoomController@add');
Route::post('/admin/room/update', 'RoomController@update');
Route::post('/admin/room/remove/{id}', 'RoomController@remove');

Route::get('/admin/pool/', 'PoolController@index');
Route::get('/admin/pool/table', 'PoolController@table');
Route::get('/admin/pool/get/{id}', 'PoolController@get');
Route::get('/admin/pool/bin', 'PoolController@bin');
Route::get('/admin/pool/bin/table', 'PoolController@binTable');
Route::get('/admin/pool/image360/{id}', 'PoolController@image360');
Route::post('/admin/pool/bin/restore/{id}', 'PoolController@restore');
Route::post('/admin/pool/bin/removeP/{id}', 'PoolController@removeP');
Route::post('/admin/pool/add', 'PoolController@add');
Route::post('/admin/pool/update', 'PoolController@update');
Route::post('/admin/pool/remove/{id}', 'PoolController@remove');

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