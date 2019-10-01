<?php

Route::get('/productos', 'Api\ProductoApiController@index')->name('productos.index');
Route::get('/productos_select', 'Api\ProductoApiController@muestraProducto')->name('productos.select');

Route::get('/productos/{producto_id}/clasificacion-aduanera', 'Api\ProductoApiController@getClasificacionAduanera')->name('productos.clasificacion-aduanera');
Route::get('/productos/{producto_id}/caracteristicas', 'Api\ProductoApiController@getCaracteristicas')->name('productos.caracteristicas');
Route::get('productos/{producto_id}/variantes', 'Api\ProductoApiController@getVariants')->name('productos.variantes');
Route::post('productos/guarda_variantes', 'Api\ProductoApiController@guardaVariant')->name('variant.save');
