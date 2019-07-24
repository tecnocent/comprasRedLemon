<!-- Modals requeridos en creacion de orden de compra -->

<!--Modal 1-->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="productos-form" method="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Agregar productos</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 line pagos-inputs">
                            <div class="form-group">
                                <label>Producto</label>
                                <select id="productosSelect" class="form-control selectProductos" name="nombre_productoM" id="nombre_producto" style=" display: block; width: 100%">
                                    <option value="">Selecciona</option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->sku}}">{{$producto->name}}</option>
                                    @endforeach
                                </select>
                                <div class="extras">
                                    <label id="o"></label>
                                    <input type="hidden" class="form-control pull-right " id="producto_id">
                                    <input type="hidden" class="form-control pull-right " id="producto_descripcion">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="">&nbsp;</label>
                            <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2" data-toggle="modal" data-target="#nuevo-producto-modal" id="nuevo_proveedor"><i class="fa fa-pencil-square-o"></i> </button>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Incoterm</label>
                                <select class="form-control" name="icoterm_productoM" id="icoterm_producto">
                                    <option value="">Selecciona</option>
                                    <option value="FOM">FOM</option>
                                    <option value="EXW">EXW</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Lead Time</label>
                                <input type="text" class="form-control" id="leadtime_producto" name="leadtime_productoM" placeholder="Lead Time" onKeyPress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Costo USD</label>
                                <input type="text" class="form-control monto" id="costo_producto" name="costo_productoM" placeholder="Costo" onkeyup="multi();" onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="text" class="form-control monto" id="cantidad_producto" name="cantidad_productoM" placeholder="Cantidad" onkeyup="multi();" onKeyPress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label id="subototalProducto">Subtotal</label>
                                <input type="text" class="form-control" id="subtotal_producto" name="subtotal_productoM" placeholder="Subtotal" disabled>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Agregar</button>
                </div>
            </form>
        </div><!-- modal-dialog -->
    </div>
</div><!-- modal -->


<!--Modal 2-->
<div class="modal right1 fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="gastos-origen-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Origen (USD)</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tipo de gasto</label>
                                <select class="form-control" name="tipo_gasto_origenM" id="tipo_gasto_origen">
                                    <option value="">Selecciona</option>
                                    @foreach($gastosOrigen as $gastoOrigen)
                                        <option value="{{$gastoOrigen->id}}">{{$gastoOrigen->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Costo $ (USD)</label>
                                <input type="text" class="form-control" id="costo_gastos_origen" name="costo_gastos_origenM" placeholder="Costo" onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Comprobante</label>
                                <input type="file" class="filestyle" name="comprobante_gastos_origen" id="comprobante_gastos_origen">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Notas</label>
                                <textarea class="form-control" rows="3" placeholder="Nota ..." name="nota_gastos_origenM" id="nota_gastos_origen"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="adicionarGastoOrigen">Agregar</button>
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
            <form id="gastos-destino-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Destino</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 line">
                            <div class="form-group">
                                <label for="">Tipo de gasto</label>
                                <select class="form-control" name="tipo_gasto_gastos_destinoM" id="tipo_gasto_gastos_destino">
                                    <option value="">Selecciona</option>
                                    @foreach($gastosDestino as $gastoDestino)
                                        <option value="{{$gastoDestino->id}}">{{$gastoDestino->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6 line">
                            <div class="form-group">
                                <label for="">Costo $</label>
                                <input type="text" class="form-control" id="costo_gastos_destino" name="costo_gastos_destinoM" placeholder="Costo" onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <div class="col-md-6 line">
                            <div class="form-group">
                                <label for="">Moneda</label>
                                <select class="form-control" name="moneda_gastos_destinoM" id="moneda_gastos_destino">
                                    <option value="">Selecciona</option>
                                    <option value="MXN">MXN</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 line">
                            <div class="form-group">
                                <label for="">Comprobante</label>
                                <input type="file" class="filestyle" name="comporbante_gastos_destino" id="comporbante_gastos_destino" >
                            </div>
                        </div>
                        <div class="col-md-12 line">
                            <div class="form-group">
                                <label for="">Notas</label>
                                <textarea class="form-control" rows="3" placeholder="Nota ..." name="nota_gastos_destinoM" id="nota_gastos_destino"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="adicionarGastoDestino">Agregar</button>
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
<div class="modal right1 fade" id="pagos-modal" tabindex="-1" role="dialog" aria-labelledby="pagos">
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
                                        <label>Pago</label>
                                        <input type="text" class="form-control monto" placeholder="Pago" id="pago_pagos" name="pago_pagos" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo de cambio de pago</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio de pago" id="tipo_cambio_pago_orden" name="tipo_cambio_pago_orden" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label id="input-pago">Comprobante</label>
                                        <input type="file" class="filestyle" data-input="false" data-badge="true" data-text="Buscar..." data-btnClass="btn-primary" id="pago_comprobante" name="pago_comprobante">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="adicionarPago">Agregar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Transito-->
<div class="modal right1 fade" id="transito-modal" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="transito-form" method="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Registrar Transito</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Metodo</label>
                                        <select class="form-control" name="metodo_transito" id="metodo_transito">
                                            <option value="">Selecciona</option>
                                            @foreach($metodosTransito as $metodo)
                                                <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Guia</label>
                                        <input type="text" class="form-control" placeholder="Guia" id="guia_transito" name="guia_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Forwarder</label>
                                        <select class="form-control" name="forwarder_transito" id="forwarder_transito">
                                            <option value="">Selecciona</option>
                                            <option value="1">uno</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Fecha de embarque</label>
                                        <input type="text" class="form-control datepicker" id="fecha_embarque_transito" name="fecha_embarque_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Fecha tentativa de llegada</label>
                                        <input type="text" class="form-control datepicker" id="fecha_tentativa_llegada_transito" name="fecha_tentativa_llegada_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Comercial invoce</label>
                                        <input type="text" class="form-control" placeholder="Comercial invoce" id="comercial_invoce_transito" name="comercial_invoce_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Comercial invoce (archivo)</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" id="archivo_comercial_invoce_file" name="archivo_comercial_invoce_file">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Cajas #</label>
                                        <input type="text" class="form-control" placeholder="Cajas #" id="cajas_transito" name="cajas_transito" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>CBM #</label>
                                        <input type="text" class="form-control" placeholder="CBM #" id="cbm_transito" name="cbm_transito" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Peso KG</label>
                                        <input type="text" class="form-control" placeholder="Peso KG" id="peso_transito" name="peso_transito" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="adicionarTansito">Agregar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Pedimento-->
<div class="modal right1 fade" id="pedimento-modal" tabindex="-1" role="dialog" aria-labelledby="pedimento">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="pedimento-form" method="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Registrar Pedimento</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label># Pedimento</label>
                                        <input type="text" class="form-control" placeholder="# Pedimento" id="numero_pedimento" name="numero_pedimento">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Aduana</label>
                                        <select class="form-control" name="aduana_pedimento" id="aduana_pedimento">
                                            <option value="">Selecciona</option>
                                            @foreach($aduanas as $aduana)
                                                <option value="{{ $aduana->id }}">{{ $aduana->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Agente Aduanal</label>
                                        <select class="form-control" name="agente_aduanal_pedimento" id="agente_aduanal_pedimento">
                                            <option value="">Selecciona</option>
                                            @foreach($agentesAduanales as $agente)
                                                <option value="{{ $agente->id }}">{{ $agente->nombre.' '.$agente->apelldos }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Tipo de cambio de pedimento</label>
                                        <input type="text" class="form-control" placeholder="Tipo de cambio de pedimento" id="tipo_cambio_pedimento_pedimento" name="tipo_cambio_pedimento_pedimento" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>DTA</label>
                                        <input type="text" class="form-control" placeholder="DTA" id="dta_pedimento" name="dta_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>CNT</label>
                                        <input type="text" class="form-control" placeholder="CNT" id="cnt_pedimento" name="cnt_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>IGI</label>
                                        <input type="text" class="form-control" placeholder="IGI" id="igi_pedimento" name="igi_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>PRV</label>
                                        <input type="text" class="form-control" placeholder="PRV" id="prv_pedimento" name="prv_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>IVA</label>
                                        <input type="text" class="form-control" placeholder="IVA" id="iva_pedimento" name="iva_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label for="">Pedimento Digital</label>
                                        <input type="file" class="filestyle" data-text="Buscar..." data-btnClass="btn-primary" id="pedimento_digital" name="pedimento_digital">
                                    </div>
                                </div>

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="adicionarTansito">Agregar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->


<!--Modal Seguimiento-->
<div class="modal right1 fade" id="modal-seguimiento" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form  method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Seguimiento</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto preproducción</label>
                                        <input type="file" id="input-preproduccion-crea" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="preproduccion_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Foto seleccionada</label>
                                        <img class="imgZoom" id="foto-preproduccion-seleccionada-crea" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto producción</label>
                                        <input type="file" id="input-produccion-crea" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="produccion_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Foto seleccionada</label>
                                        <img class="imgZoom" id="foto-produccion-seleccionada-crea" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto OEM 1</label>
                                        <input type="file" id="input-oem_uno-crea" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="oem_uno_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Foto seleccionada</label>
                                        <img class="imgZoom" id="foto-oem_uno-seleccionada-crea" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto OEM 2</label>
                                        <input type="file" id="input-oem_dos-crea" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="oem_dos_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Foto seleccionada</label>
                                        <img class="imgZoom" id="foto-oem_dos-seleccionada-crea" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto OEM 3</label>
                                        <input type="file" id="input-oem_tres-crea" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="oem_tres_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Foto seleccionada</label>
                                        <img class="imgZoom" id="foto-oem_tres-seleccionada-crea" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto empaquetado</label>
                                        <input type="file" id="input-empaquetado-crea" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="empaquetado_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Foto seleccionada</label>
                                        <img class="imgZoom" id="foto-empaquetado-seleccionada-crea" width="70" height="70">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guarda</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Caracteristica-->
<div class="modal right1 fade" id="modal-caracteristica" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="caracteristica-form" action="" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nueva Caracteristica</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Producto de orden</label>
                                        <select class="form-control" id="producto_caracteristica_id" name="producto_caracteristica_id">
                                            <option value="" id="option_producto_caracteristica">Selecciona</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Especificaciones de producto</label>
                                        <textarea required class="form-control" placeholder="Ingresa las especificaciones" rows="3" id="caracteristica_especificacion_producto" name="caracteristica_especificacion_producto"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Especificaciones electricas</label>
                                        <textarea required class="form-control" placeholder="Ingresa las especificaciones electricas" rows="3" id="caracteristica_especificaion_electrica" name="caracteristica_especificaion_electrica"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Link amazon</label>
                                        <input type="url" id="caracteristica_link_amazon" name="caracteristica_link_amazon" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Link alibaba</label>
                                        <input type="url" id="caracteristica_link_alibaba" name="caracteristica_link_alibaba" class="form-control">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->