<?php
// Ordenes de compra
Route::get('/reporte_pagos/{id}', 'ReporteController@getReportePagos');
Route::get('/resumen_pagos', 'ReporteController@getResumenPagos');
