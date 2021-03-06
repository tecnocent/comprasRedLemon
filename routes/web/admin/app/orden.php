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
Route::get('/consulta_proveedor/{id}', 'Proveedor\ProveedorController@consulta')->name('proveedor.consulta');
Route::post('/actualiza_proveedor', 'Proveedor\ProveedorController@update')->name('proveedor.update');
Route::get('/elimina_proveedor/{id}', 'Proveedor\ProveedorController@destroy')->name('producto.delete');

//Tipo de compra
Route::get('/tipo_compra', 'Catalogo\TipoCompraController@index')->name('tipo_compra.index');
Route::post('/guarda_tipo_compra', 'Catalogo\TipoCompraController@store')->name('tipo_compra.save');

//Productos de orden
Route::get('/elimina_producto/{id}', 'Producto\ProductoController@destroy')->name('producto.delete');
Route::post('/guarda_producto/{id}', 'Producto\ProductoController@guardaProducto')->name('producto.save');
Route::post('/actualiza_producto/', 'Producto\ProductoController@update')->name('producto.update');
Route::get('/consulta_producto/{id}', 'Producto\ProductoController@consultaProducto')->name('producto.consulta');

//Gastos Origen
Route::get('/elimina_gasto_origen/{id}', 'GastosOrigen\GastosOrigenController@destroy')->name('gasto_origen.delete');
Route::post('/guarda_gasto_origen/{id}', 'GastosOrigen\GastosOrigenController@guardaGastosOrigen')->name('gasto_origen.save');
Route::post('/guarda_tipo_gasto_origen', 'GastosOrigen\GastosOrigenController@guardaTipoGastoOrigen')->name('tipo-gasto-origen.save');
Route::post('/actualiza_gasto_origen/', 'GastosOrigen\GastosOrigenController@update')->name('gasto_origen.update');
Route::get('/gasto_origen_consulta/{id}', 'GastosOrigen\GastosOrigenController@consultaGastoOrigen')->name('gasto_origen.consulta');

//Gastos Destino
Route::get('/elimina_gasto_destino/{id}', 'GastosDestino\GastosDestinoController@destroy')->name('gasto_destino.delete');
Route::post('/guarda_gasto_destino/{id}', 'GastosDestino\GastosDestinoController@guardaGastoDestino')->name('gasto_destino.save');
Route::post('/guarda_tipo_gasto_destino', 'GastosDestino\GastosDestinoController@guardaTipoGastoDestino')->name('tipo-gasto-destino.save');
Route::post('/actualiza_gasto_destino/', 'GastosDestino\GastosDestinoController@update')->name('gasto_destino.update');
Route::get('/gasto_destino_consulta/{id}', 'GastosDestino\GastosDestinoController@consultaGastoDestino')->name('gasto_destino.consulta');

//Transito
Route::get('/elimina_transito/{id}', 'Transito\TransitoController@destroy')->name('transito.delete');
Route::post('/guarda_transito/{id}', 'Transito\TransitoController@guardaTransito')->name('transito.save');
Route::post('/guarda_transito', 'Transito\TransitoController@guardaMetodoTransito')->name('metodo_transito.save');
Route::post('/guarda_forwarder', 'Transito\TransitoController@guardaForwarderTransito')->name('forwarder_transito.save');
Route::post('/actualiza_transito/', 'Transito\TransitoController@update')->name('transito.update');
Route::get('/transito_consulta/{id}', 'Transito\TransitoController@consultaTransito')->name('transito.consulta');

//Pedimento
Route::get('/elimina_pedimento/{id}', 'Pedimento\PedimentoController@destroy')->name('pedimento.delete');
Route::post('/guarda_pedimento/{id}', 'Pedimento\PedimentoController@guardaPedimento')->name('pedimento.save');
Route::post('/guarda_aduana', 'Pedimento\PedimentoController@guardaAduana')->name('aduana_pedimento.save');
Route::post('/guarda_agente_aduanal', 'Pedimento\PedimentoController@guardaAgenteAduanal')->name('agente_aduanal_pedimento.save');
Route::post('/actualiza_pedimento/', 'Pedimento\PedimentoController@update')->name('pedimento.update');
Route::get('/pedimento_consulta/{id}', 'Pedimento\PedimentoController@consultaPedimento')->name('pedimento.consulta');

//Pago
Route::get('/elimina_pago/{id}', 'Pago\PagoOrdenController@destroy')->name('pago.delete');
Route::post('/guarda_pago/{id}', 'Pago\PagoOrdenController@guardaPago')->name('pago.save');
Route::post('/actualiza_pago/', 'Pago\PagoOrdenController@update')->name('pago.update');
Route::get('/pago_consulta/{id}', 'Pago\PagoOrdenController@consultaPago')->name('pago.consulta');

//Seguimiento producto
Route::get('/elimina_seguimiento/{id}', 'SeguimientoProducto\SeguimientoProductoController@destroy')->name('seguimiento.delete');
Route::post('/guarda_sguimiento/{id}', 'SeguimientoProducto\SeguimientoProductoController@guardaSeguimiento')->name('seguimiento.save');
Route::post('/actualiza_seguimiento/', 'SeguimientoProducto\SeguimientoProductoController@update')->name('seguimiento.update');
Route::get('/consulta_seguimiento/{id}', 'SeguimientoProducto\SeguimientoProductoController@consultaSeguimiento')->name('seguimiento.consulta');

//Caracteristicas producto
Route::get('/elimina_caracteristica/{id}', 'CaracteristicaProducto\CaracteristicaProductoController@destroy')->name('caracteristica.delete');
Route::post('/guarda_caracteristica/{id}', 'CaracteristicaProducto\CaracteristicaProductoController@guardaCaracteristica')->name('caracteristica.save');
Route::post('/actualiza_caracteristica/', 'CaracteristicaProducto\CaracteristicaProductoController@update')->name('caracteristica.update');
Route::get('/consulta_caracteristica/{id}', 'CaracteristicaProducto\CaracteristicaProductoController@consultaCaracteristica')->name('caracteristica.consulta');

//Clasificacion aduanera
Route::get('/elimina_clasificacion/{id}', 'ClasificacionAduanera\ClasificacionAduaneraController@destroy')->name('clasificacion.delete');
Route::post('/guarda_clasificacion/{id}', 'ClasificacionAduanera\ClasificacionAduaneraController@guardaClasificacion')->name('clasificacion.save');
Route::post('/actualiza_clasificacion/', 'ClasificacionAduanera\ClasificacionAduaneraController@update')->name('clasificacion.update');
Route::get('/consulta_clasificacion/{id}', 'ClasificacionAduanera\ClasificacionAduaneraController@consultaClasificacion')->name('clasificacion.consulta');

//Diseno producto
Route::get('/elimina_diseno/{id}', 'Diseno\DisenoController@destroy')->name('diseno.delete');
Route::post('/guarda_diseno/{id}', 'Diseno\DisenoController@guardaDiseno')->name('diseno.save');
Route::post('/actualiza_diseno/', 'Diseno\DisenoController@update')->name('diseno.update');
Route::get('/consulta_diseno/{id}', 'Diseno\DisenoController@consultaDiseno')->name('diseno.consulta');

// Productos
Route::post('/guarda_producto_base', 'ProductoBase\ProductoBaseController@store')->name('producto_base.save');

// Monedas
Route::post('/guarda_moneda', 'Moneda\MonedaController@guardaMoneda')->name('moneda.save');

// Incoterm
Route::post('/guarda-incoterm/', 'Incoterm\IncotermController@guardaIncoterm')->name('incoterm.save');

