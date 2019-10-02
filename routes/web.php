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

Route::get('/admin/ordenes', 'Admin\Dashboard\HomeController@index')->name('home');

//Reportes
Route::get('/admin/reportes/productos-pedidos', 'Reportes\ReporteController@reporteProductosPedidos')->name('reportes.productos_pedidos');
Route::get('/admin/reportes/costos', 'Reportes\ReporteController@reporteCostos')->name('reportes.costos');
Route::get('/admin/reportes/detalle-orden/{ordenCompra}', 'Reportes\ReporteController@reporteDetalleOrden')->name('reportes.detalle-orden');

Route::get('/admin/reportes/costos/detalle/productos/{sku}', 'Reportes\ReporteController@reporteCostoDetalle')->name('reportes.costo-detalle');

//Reportes de pagos
Route::get('/admin/reportes/pagos/ordenes', 'Reportes\ReporteController@reportePagosOrdenes')->name('reportes.pago-ordenes');

// reportes
Route::group(['namespace' => 'Reportes', 'prefix' => 'reportes'], function () {
   require base_path('routes/web/admin/app/reportes.php');
});


// Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    require base_path('routes/web/admin/app/orden.php');
});

