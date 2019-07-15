<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rutas de sistema de Compras Tecnocent
|
|
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/creada', function(){
    return view('admin.ordenes.resumen');
});

Route::get('/admin/ordenes', 'Admin\Dashboard\HomeController@index')->name('home');

// Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    require base_path('routes/web/admin/app/orden.php');
});

