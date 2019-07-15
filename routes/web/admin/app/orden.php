<?php


// Ordenes de compra
Route::get('/nueva_orden', 'OrdenCompra\OrdenesCompraController@create')->name('orden.create');
Route::post('/guarda_orden', 'OrdenCompra\OrdenesCompraController@store')->name('orden.save');
Route::get('/muestra_orden/{id}', 'OrdenCompra\OrdenesCompraController@show')->name('orden.show');
Route::get('/elimina_orden/{id}', 'OrdenCompra\OrdenesCompraController@destroy')->name('orden.delete');
Route::get('/resumen/{id}', 'OrdenCompra\OrdenesCompraController@resumen')->name('orden.resumen');
Route::get('/orden/descarga/{archivo}', 'OrdenCompra\OrdenesCompraController@descarga')->name('orden.descarga');

// Proveedor
Route::post('/guarda_proveedor', 'Proveedor\ProveedorController@store')->name('proveedor.save');

//Tipo de compra
Route::get('/tipo_compra', 'Catalogo\TipoCompraController@index')->name('tipo_compra.index');
Route::post('/guarda_tipo_compra', 'Catalogo\TipoCompraController@store')->name('tipo_compra.save');

// Productos
Route::get('/elimina_producto/{id}', 'Producto\ProductoController@destroy')->name('producto.delete');

// Gastos Origen
Route::get('/elimina_gasto_origen/{id}', 'GastosOrigen\GastosOrigenController@destroy')->name('gasto_origen.delete');

// Gastos Destino
Route::get('/elimina_gasto_destino/{id}', 'GastosDestino\GastosDestinoController@destroy')->name('gasto_destino.delete');

// Transito
Route::get('/elimina_transito/{id}', 'Transito\TransitoController@destroy')->name('transito.delete');

//Pedimento
Route::get('/elimina_pedimento/{id}', 'Pedimento\PedimentoController@destroy')->name('pedimento.delete');
