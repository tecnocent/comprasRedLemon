<?php


// Ordenes de compra
Route::get('/nueva_orden', 'OrdenesCompraController@create')->name('orden.create');
Route::post('/guarda_orden', 'OrdenesCompraController@store')->name('orden.save');
Route::get('/elimina_orden/{id}', 'OrdenesCompraController@destroy')->name('orden.delete');