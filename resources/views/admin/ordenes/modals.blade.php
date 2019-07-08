<!-- Modals requeridos en creacion de orden de compra -->

<!--Modal 1-->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">Agregar productos</h4>
            </div>

            <div class="modal-body" style="width: 98%; margin-left: 10px;">
                <div class="row" id="table3">
                    <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Incoterm</th>
                            <th>Lead Time</th>
                            <th>Costo (USD)</th>
                            <th>Cantidad</th>
                            <th>Subtotal (USD)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-group extras">
                                    <select id="productosSelect" class="form-control selectProductos" name="nombre_productoM" id="nombre_producto" style=" display: block; width: 100%">
                                        <option value="">Selecciona</option>
                                        @foreach($productos as $producto)
                                            <option value="{{$producto->sku}}">{{$producto->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="icoterm_productoM" id="icoterm_producto">
                                        <option value="">Selecciona</option>
                                        <option value="FOM">FOM</option>
                                        <option value="EXW">EXW</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="leadtime_producto" name="leadtime_productoM" placeholder="Lead Time" onKeyPress="return soloNumeros(event)">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control monto" id="costo_producto" name="costo_productoM" placeholder="Costo" onkeyup="multi();" onkeypress="return filterFloat(event,this);">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control monto" id="cantidad_producto" name="cantidad_productoM" placeholder="Cantidad" onkeyup="multi();" onKeyPress="return soloNumeros(event)">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subtotal_producto" name="subtotal_productoM" placeholder="Subtotal" disabled onkeypress="return filterFloat(event,this);">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="adicionar">Agregar</button>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
</div><!-- modal -->
<!--Modal 2-->
<div class="modal right1 fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form role="form" method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Origen (USD)</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tipo de gasto</label>
                        <select class="form-control" name="tipo_gasto_origenM" id="tipo_gasto_origen">
                            <option value="a">Selecciona</option>
                            @foreach($gastosOrigen as $gastoOrigen)
                                <option value="{{$gastoOrigen->id}}">{{$gastoOrigen->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Costo $ (USD)</label>
                        <input type="text" class="form-control" id="costo_gastos_origen" name="costo_gastos_origenM" placeholder="Costo" onkeypress="return filterFloat(event,this);">
                    </div>
                    <div class="form-group">
                        <label for="">Notas</label>
                        <textarea class="form-control" rows="3" placeholder="Nota ..." name="nota_gastos_origenM" id="nota_gastos_origen"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="adicionarGastoOrigen">Agregar</button>
                </div>
            </form><!-- /. Formulario -->
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->
<!--Modal 3-->
<div class="modal right1 fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form role="form" method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Destino</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tipo de gasto</label>
                        <select class="form-control" name="tipo_gasto_gastos_destinoM" id="tipo_gasto_gastos_destino">
                            <option value="1">Selecciona</option>
                            @foreach($gastosDestino as $gastoDestino)
                                <option value="{{$gastoDestino->id}}">{{$gastoDestino->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Costo $</label>
                        <input type="text" class="form-control" id="costo_gastos_destino" name="costo_gastos_destinoM" placeholder="Costo" onkeypress="return filterFloat(event,this);">
                    </div>
                    <div class="form-group">
                        <label for="">Moneda</label>
                        <select class="form-control" name="moneda_gastos_destinoM" id="moneda_gastos_destino">
                            <option value="a">Selecciona</option>
                            <option value="MXN">MXN</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Notas</label>
                        <textarea class="form-control" rows="3" placeholder="Nota ..." name="nota_gastos_destinoM" id="nota_gastos_destino"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="adicionarGastoDestino">Agregar</button>
                </div>
            </form><!-- /. Formulario -->
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Nuevo Proveedor-->
<div class="modal right1 fade" id="nuevo-proveedor-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="proveedor-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Proveedor</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nombreProveedor" name="nombreProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre de contacto</label>
                                        <input type="text" class="form-control" placeholder="Nombre de contacto" id="nombreContactoProveedor" name="nombreContactoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tax</label>
                                        <input type="text" class="form-control" placeholder="Tax" id="taxProveedor" name="taxProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" placeholder="Dirección" id="direccionProveedor" name="direccionProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>País</label>
                                        <input type="text" class="form-control" placeholder="País" id="paisProveedor" name="paisProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" class="form-control" placeholder="Telefono" id="tlefonoProveedor" name="tlefonoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="email" class="form-control" placeholder="Correo" id="correoProveedor" name="correoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="guardarProveedor">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Nuevo Tipo de compra-->
<div class="modal right1 fade" id="nuevo-tipo-compra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="tipo-compra-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Tipo de compra</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <input type="text" class="form-control" placeholder="Tipo de compra" id="tipoCompraNombre" name="tipoCompraNombre">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="guardarProveedor">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Pagos-->
<div class="modal right1 fade" id="pagos" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="pagos-form" method="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Registrar Pago</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Monto USD</label>
                                        <input type="text" class="form-control" placeholder="Monto" id="monto_pago" name="monto_pago" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Comprobante</label>
                                        <input type="file" id="comprobante_monto_pago" name="comprobante_monto_pago" data-btnClass="btn-primary" data-dragdrop="false">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo de cambio</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio" id="tipo_cambio_pago" name="tipo_cambio_pago">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>BFCVU</label>
                                        <input type="text" class="form-control" placeholder="BFCVU" id="bfcvu_pago" name="bfcvu_pago">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Pago #1</label>
                                        <input type="text" class="form-control" placeholder="Pago #1" id="pago_1_pago" name="pago_1_pago" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Comprobante pago #1</label>
                                        <input type="file" id="comprobante_pago_1_pago" name="comprobante_pago_1_pago" data-btnClass="btn-primary" data-dragdrop="false">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo de cambio 1</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio 1" id="tipo_cambio_1_pago" name="tipo_cambio_1_pago">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Pago #2</label>
                                        <input type="text" class="form-control" placeholder="Pago #2" id="pago_2_pago" name="pago_2_pago" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Comprobante pago #2</label>
                                        <input type="file" id="comprobante_pago_2_pago" name="comprobante_pago_2_pago" data-btnClass="btn-primary" data-dragdrop="false">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo de cambio 2</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio 2" id="tipo_cambio_2_pago" name="tipo_cambio_2_pago">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Pago #3</label>
                                        <input type="text" class="form-control" placeholder="Pago #3" id="pago_3_pago" name="pago_3_pago" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Comprobante pago #3</label>
                                        <input type="file" id="comprobante_pago_3_pago" name="comprobante_pago_3_pago" data-btnClass="btn-primary" data-dragdrop="false">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo de cambio 3</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio 3" id="tipo_cambio_3_pago" name="tipo_cambio_3_pago">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Total pagado</label>
                                        <input type="text" class="form-control" placeholder="Total pagado" id="total_pagado_pago" name="total_pagado_pago" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Restante</label>
                                        <input type="text" class="form-control" placeholder="Restante" id="restante_pago" name="restante_pago" disabled>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="adicionarPago">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->