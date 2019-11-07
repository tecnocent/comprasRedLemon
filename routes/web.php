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

//CSV
Route::get('/admin/ordenes/csv','Admin\Csv\CsvController@index')->name('orden.csv');
Route::post('CSVFormCompras', 'Admin\Csv\CsvController@compras');

Route::post('/CSVForm', 'Admin\Csv\CsvController@csviom');
Route::get('csv/download', 'Admin\Csv\CsvController@download');
Route::get('plantillas/{id}', 'Admin\Csv\CsvController@plantillas');
Route::post('CSVFormamazon', 'Admin\Csv\CsvController@amazon');
Route::post('CSVForMl', 'Admin\Csv\CsvController@ml');
Route::post('CSVForPriv', 'Admin\Csv\CsvController@priv');
Route::post('CSVforCompras','Admin\Csv\CsvController@mcompras');
Route::post('CSVForXLSX','Admin\Csv\CsvController@updatefromxml');
Route::post('/ImportaCsv','Admin\Csv\CsvController@importaform');


//Reportes
Route::get('/admin/reportes/productos-pedidos', 'Reportes\ReporteController@reporteProductosPedidos')->name('reportes.productos_pedidos');
Route::get('/admin/reportes/costos', 'Reportes\ReporteController@reporteCostos')->name('reportes.costos');
Route::get('/admin/reportes/detalle-orden/{ordenCompra}', 'Reportes\ReporteController@reporteDetalleOrden')->name('reportes.detalle-orden');
Route::get('/admin/reportes/costos/detalle/productos/{sku}', 'Reportes\ReporteController@reporteCostoDetalle')->name('reportes.costo-detalle');

//Reportes de pagos
Route::get('/admin/reportes/pagos/ordenes', 'Reportes\ReporteController@reportePagosOrdenes')->name('reportes.pago-ordenes');
Route::get('/admin/resumen/pagos', 'Reportes\ReporteController@resumenPagosOrdenes')->name('resumen.pagos');

// reportes proveedores
Route::get('/admin/reportes/proveedores', 'Reportes\ReporteController@reporteProveedores')->name('reportes.proveedores');

// reportes
Route::group(['namespace' => 'Reportes', 'prefix' => 'reportes'], function () {
   require base_path('routes/web/admin/app/reportes.php');
});


// Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    require base_path('routes/web/admin/app/orden.php');
});

