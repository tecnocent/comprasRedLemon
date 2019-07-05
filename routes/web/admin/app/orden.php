<?php


// Ordenes de compra
Route::get('/nueva_orden', 'OrdenCompra\OrdenesCompraController@create')->name('orden.create');
Route::post('/guarda_orden', 'OrdenCompra\OrdenesCompraController@store')->name('orden.save');
Route::get('/elimina_orden/{id}', 'OrdenCompra\OrdenesCompraController@destroy')->name('orden.delete');

// Proveedor
Route::post('/guarda_proveedor', 'Proveedor\ProveedorController@store')->name('proveedor.save');