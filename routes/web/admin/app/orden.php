<?php


// Ordenes de compra
Route::get('/nueva_orden', 'OrdenCompra\OrdenesCompraController@create')->name('orden.create');
Route::post('/guarda_orden', 'OrdenCompra\OrdenesCompraController@store')->name('orden.save');
Route::get('/muestra_orden/{id}', 'OrdenCompra\OrdenesCompraController@show')->name('orden.show');
Route::post('/actualiza_orden/{id}', 'OrdenCompra\OrdenesCompraController@update')->name('orden.update');
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
Route::post('/guarda_producto/{id}', 'Producto\ProductoController@guardaProducto')->name('producto.save');
Route::post('/actualiza_producto/', 'Producto\ProductoController@update')->name('producto.update');
Route::get('/consulta_producto/{id}', 'Producto\ProductoController@consultaProducto')->name('producto.consulta');

// Gastos Origen
Route::get('/elimina_gasto_origen/{id}', 'GastosOrigen\GastosOrigenController@destroy')->name('gasto_origen.delete');
Route::post('/guarda_gasto_origen/{id}', 'GastosOrigen\GastosOrigenController@guardaGastosOrigen')->name('gasto_origen.save');
Route::post('/actualiza_gasto_origen/', 'GastosOrigen\GastosOrigenController@update')->name('gasto_origen.update');
Route::get('/gasto_origen_consulta/{id}', 'GastosOrigen\GastosOrigenController@consultaGastoOrigen')->name('gasto_origen.consulta');

// Gastos Destino
Route::get('/elimina_gasto_destino/{id}', 'GastosDestino\GastosDestinoController@destroy')->name('gasto_destino.delete');
Route::post('/guarda_gasto_destino/{id}', 'GastosDestino\GastosDestinoController@guardaGastoDestino')->name('gasto_destino.save');
Route::post('/actualiza_gasto_destino/', 'GastosDestino\GastosDestinoController@update')->name('gasto_destino.update');
Route::get('/gasto_destino_consulta/{id}', 'GastosDestino\GastosDestinoController@consultaGastoDestino')->name('gasto_destino.consulta');

// Transito
Route::get('/elimina_transito/{id}', 'Transito\TransitoController@destroy')->name('transito.delete');
Route::post('/guarda_transito/{id}', 'Transito\TransitoController@guardaTransito')->name('transito.save');
Route::post('/actualiza_transito/', 'Transito\TransitoController@update')->name('transito.update');
Route::get('/transito_consulta/{id}', 'Transito\TransitoController@consultaTransito')->name('transito.consulta');

//Pedimento
Route::get('/elimina_pedimento/{id}', 'Pedimento\PedimentoController@destroy')->name('pedimento.delete');
Route::post('/guarda_pedimento/{id}', 'Pedimento\PedimentoController@guardaPedimento')->name('pedimento.save');
Route::post('/actualiza_pedimento/', 'Pedimento\PedimentoController@update')->name('pedimento.update');
Route::get('/pedimento_consulta/{id}', 'Pedimento\PedimentoController@consultaPedimento')->name('pedimento.consulta');
