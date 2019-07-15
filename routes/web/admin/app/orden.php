<?php


// Ordenes de compra
Route::get('/nueva_orden', 'OrdenCompra\OrdenesCompraController@create')->name('orden.create');
Route::post('/guarda_orden', 'OrdenCompra\OrdenesCompraController@store')->name('orden.save');
Route::get('/muestra_orden/{id}', 'OrdenCompra\OrdenesCompraController@show')->name('orden.show');
Route::get('/elimina_orden/{id}', 'OrdenCompra\OrdenesCompraController@destroy')->name('orden.delete');


// Proveedor
Route::post('/guarda_proveedor', 'Proveedor\ProveedorController@store')->name('proveedor.save');

//Tipo de compra
Route::get('/tipo_compra', 'Catalogo\TipoCompraController@index')->name('tipo_compra.index');
Route::post('/guarda_tipo_compra', 'Catalogo\TipoCompraController@store')->name('tipo_compra.save');