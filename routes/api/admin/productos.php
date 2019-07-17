<?php

Route::get('/productos', 'Api\ProductoApiController@index')->name('productos.index');
Route::get('/productos_select', 'Api\ProductoApiController@muestraProducto')->name('productos.select');