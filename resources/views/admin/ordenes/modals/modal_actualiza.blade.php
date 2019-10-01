<!-- Modals requeridos en creacion de orden de compra -->

<!--Modal 1-->
<div class="modal right fade" id="modal-actualiza-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="productos-form" action="{{ route('producto.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Actualiza productos</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Producto</label>
                                <select id="productosSelectActualiza" class="form-control" name="nombre_productoM" style=" display: block; width: 100%">
                                    <option value="">Selecciona</option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->sku}}">{{$producto->name}}</option>
                                    @endforeach
                                </select>
                                <div class="extras_actualiza">
                                    <input type="hidden" class="form-control pull-right" id="producto_id_actualiza" name="producto_id">
                                    <input type="hidden" class="form-control pull-right" id="producto_orden_id" name="producto_orden_id">
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="form-group col-sm-1">
                            <label for="">&nbsp;</label>
                            <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2" data-toggle="modal" data-target="#nuevo-producto-actualiza-modal" id="nuevo_proveedor"><i class="fa fa-pencil-square-o"></i> </button>
                        </div>
                        -->
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Incoterm</label>
                                <select class="form-control" name="icoterm_productoM" id="icoterm_producto_acualiza">
                                    <option value="">Selecciona</option>
                                    <option value="FOM">FOM</option>
                                    <option value="EXW">EXW</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 line variant-inputs" >
                            <label>Variante</label>
                            <select class="form-control" name="select_variant_id_acualiza" id="select_variant_id_acualiza">
                                <option value="">Selecciona</option>
                            </select>
                            <div class="extras_actualiza">
                                <input type="hidden" class="form-control pull-right" id="product_variant_id_acualiza" name="product_variant_id_acualiza">
                            </div>
                        </div>
                        <div class="form-group col-sm-1 variant-inputs" >
                            <label for="">&nbsp;</label>
                            <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2"
                                    data-toggle="modal" data-target="#nueva-variante-guarda-modal" id="nueva-variante"><i
                                        class="fa fa-pencil-square-o"></i></button>
                        </div>
                        <div class="col-md-6 line variant-inputs" >
                        </div>

                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Lead Time</label>
                                <input type="text" class="form-control" id="leadtime_producto_actualiza" name="leadtime_productoM" placeholder="Lead Time" onKeyPress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Costo USD</label>
                                <input type="text" class="form-control monto_actualiza" id="costo_producto_actualiza" name="costo_productoM" placeholder="Costo" onkeyup="multi_actauliza();" onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="text" class="form-control monto_actualiza" id="cantidad_producto_actualiza" name="cantidad_productoM" placeholder="Cantidad" onkeyup="multi_actauliza();" onKeyPress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Subtotal</label>
                                <input type="text" class="form-control" id="subtotal_producto_actualiza" name="subtotal_productoM" placeholder="Subtotal" disabled onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Actualizar</button>
                </div>
            </form>
        </div><!-- modal-dialog -->
    </div>
</div><!-- modal -->


<!--Modal 2-->
<div class="modal right1 fade" id="modal-actualiza-gasto-origen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="gastos-origen-form" action="{{ route('gasto_origen.save', ['id' => $orden->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Origen (USD)</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tipo de gasto</label>
                                <select class="form-control" name="tipo_gasto_origenM" id="tipo_gasto_origen_actualiza">
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
                                <input type="text" class="form-control" id="costo_gastos_origen_actualiza" name="costo_gastos_origenM" placeholder="Costo" onkeypress="return filterFloat(event,this);">
                                <input type="hidden" class="form-control" id="gasto_origen_id" name="gasto_origen_id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Comprobante</label>
                                <input type="file" class="filestyle" name="comprobante_gastos_origen" id="comprobante_gastos_origen_actualiza">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Notas</label>
                                <textarea class="form-control" rows="3" placeholder="Nota ..." name="nota_gastos_origenM" id="nota_gastos_origen_actualiza"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="adicionarGastoOrigen">Actualiza</button>
                </div>
            </form><!-- /. Formulario -->
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->


<!--Modal 3-->
<div class="modal right1 fade" id="modal-actualiza-gasto-destino" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="gastos-destino-form" action="{{ route('gasto_destino.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Actualiza Gasto de Destino</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 line">
                            <div class="form-group">
                                <label for="">Tipo de gasto</label>
                                <select class="form-control" name="tipo_gasto_gastos_destinoM" id="tipo_gasto_gastos_destino_actualiza">
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
                                <input type="text" class="form-control" id="costo_gastos_destino_actualiza" name="costo_gastos_destinoM" placeholder="Costo" onkeypress="return filterFloat(event,this);">
                                <input type="hidden" class="form-control" id="gasto_destino_id" name="gasto_destino_id">
                            </div>
                        </div>
                        <div class="col-md-6 line">
                            <div class="form-group">
                                <label for="">Moneda</label>
                                <select class="form-control" name="moneda_gastos_destinoM" id="moneda_gastos_destino_actualiza">
                                    <option value="">Selecciona</option>
                                    <option value="MXN">MXN</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 line">
                            <div class="form-group">
                                <label for="">Comprobante</label>
                                <input type="file" class="filestyle" name="comporbante_gastos_destino" id="comporbante_gastos_destino_actualiza" >
                            </div>
                        </div>
                        <div class="col-md-12 line">
                            <div class="form-group">
                                <label for="">Notas</label>
                                <textarea class="form-control" rows="3" placeholder="Nota ..." name="nota_gastos_destinoM" id="nota_gastos_destino_actualiza"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="adicionarGastoDestino">Actualizar</button>
                </div>
            </form><!-- /. Formulario -->
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->


<!--Modal Pagos-->
<div class="modal right1 fade" id="modal-actualiza-pagos" tabindex="-1" role="dialog" aria-labelledby="pagos">
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
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Monto USD</label>
                                        <input type="text" class="form-control" placeholder="Monto" id="monto_pagos" name="monto_pagos" onkeypress="return filterFloat(event,this);">
                                        <input type="hidden" class="form-control" id="total_pagado" name="total_pagado">

                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Tipo de cambio</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio" id="tipo_cambio_monto_pagos" name="tipo_cambio_monto_pagos" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>BFCV</label>
                                        <input type="text" class="form-control" placeholder="BFCV" id="bfcvu_pagos" name="bfcvu_pagos">
                                    </div>
                                </div>
                                <div class="col-md-12 line pagos-inputs" style="height: 13px;">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-1 line">
                                    <div class="form-group">
                                        <h4 class="modal-title" id="">Pagos</h4><br>
                                    </div>
                                </div>
                                <div class="col-md-9 line">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary pull-left" id="otropago" data-toggle="tooltip" data-placement="right" title="Agregar pago">
                                            <i class="fa fa-plus">&nbsp;</i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12 line pagos" style="height: 0px;">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Pago</label>
                                        <input type="text" class="form-control monto" placeholder="Pago" id="pago_pagos" name="pago_pagos" onkeypress="return filterFloat(event,this);" onkeyup="sumar();">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs pago1">
                                    <div class="form-group">
                                        <label>Tipo de cambio de pago</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio de pago" id="tipo_cambio_pago_pagos" name="tipo_cambio_pago_pagos" onkeypress="return filterFloat(event,this);">
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
<div class="modal right1 fade" id="modal-actualiza-transito" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="transito-form" action="{{ route('transito.save', ['id' => $orden->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Actualizar Transito</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Metodo</label>
                                        <select class="form-control" name="metodo_transito" id="metodo_transito_actualiza">
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
                                        <input type="text" class="form-control" placeholder="Guia" id="guia_transito_actualiza" name="guia_transito">
                                        <input type="hidden" class="form-control" placeholder="Guia" id="transito_id" name="transito_id">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Forwarder</label>
                                        <select class="form-control" name="forwarder_transito" id="forwarder_transito_actualiza">
                                            <option value="">Selecciona</option>
                                            <option value="1">uno</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Fecha de embarque</label>
                                        <input type="text" class="form-control datepicker" id="fecha_embarque_transito_actualiza" name="fecha_embarque_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Fecha tentativa de llegada</label>
                                        <input type="text" class="form-control datepicker" id="fecha_tentativa_llegada_transito_atualiza" name="fecha_tentativa_llegada_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Comercial invoce</label>
                                        <input type="text" class="form-control" placeholder="Comercial invoce" id="comercial_invoce_transito_actualiza" name="comercial_invoce_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Comercial invoce (archivo)</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" id="archivo_comercial_invoce_file_actualiza" name="archivo_comercial_invoce_file">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Cajas #</label>
                                        <input type="text" class="form-control" placeholder="Cajas #" id="cajas_transito_actualiza" name="cajas_transito" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>CBM #</label>
                                        <input type="text" class="form-control" placeholder="CBM #" id="cbm_transito_actualiza" name="cbm_transito" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Peso KG</label>
                                        <input type="text" class="form-control" placeholder="Peso KG" id="peso_transito_actualiza" name="peso_transito" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="adicionarTansito">Actualizar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Pedimento-->
<div class="modal right1 fade" id="modal-actualiza-pedimento" tabindex="-1" role="dialog" aria-labelledby="pedimento">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="pedimento-form" action="{{ route('pedimento.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Actualiza Pedimento</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label># Pedimento</label>
                                        <input type="text" class="form-control" placeholder="# Pedimento" id="numero_pedimento_actualiza" name="numero_pedimento">
                                        <input type="hidden" class="form-control" placeholder="# Pedimento" id="pedimento_id" name="pedimento_id">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Aduana</label>
                                        <select class="form-control" name="aduana_pedimento" id="aduana_pedimento_actualiza">
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
                                        <select class="form-control" name="agente_aduanal_pedimento" id="agente_aduanal_pedimento_actualiza">
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
                                        <input type="text" class="form-control" placeholder="Tipo de cambio de pedimento" id="tipo_cambio_pedimento_pedimento_actualiza" name="tipo_cambio_pedimento_pedimento" onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>DTA</label>
                                        <input type="text" class="form-control" placeholder="DTA" id="dta_pedimento_actualiza" name="dta_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>CNT</label>
                                        <input type="text" class="form-control" placeholder="CNT" id="cnt_pedimento_actualiza" name="cnt_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>IGI</label>
                                        <input type="text" class="form-control" placeholder="IGI" id="igi_pedimento_actualiza" name="igi_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>PRV</label>
                                        <input type="text" class="form-control" placeholder="PRV" id="prv_pedimento_actualiza" name="prv_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>IVA</label>
                                        <input type="text" class="form-control" placeholder="IVA" id="iva_pedimento_actualiza" name="iva_pedimento" onKeyPress="return soloNumeros(event)">
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
                    <button type="submit" class="btn btn-success">Actualiza</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Pagos-->
<div class="modal right1 fade" id="modal-actualiza-pago" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="pago-form" action="{{ route('pago.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Actualizar Pago</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Pago</label>
                                        <input type="text" class="form-control monto" placeholder="Pago" id="pago_pagos_actualiza" name="pago_pagos" onkeypress="return filterFloat(event,this);" required>
                                        <input type="hidden" class="form-control monto" placeholder="Pago" id="pago_pagos_id_actualiza" name="pago_id" required>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo de cambio de pago</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio de pago" id="tipo_cambio_pago_orden_actualiza" name="tipo_cambio_pago_orden" onkeypress="return filterFloat(event,this);" required>
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
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->


<!-- Producto Nuevo -->
<div class="modal right1 fade" id="nuevo-producto-actualiza-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="nuevo-producto-actualiza-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo producto</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input type="text" class="form-control" placeholder="SKU" id="sku_producto_nuevo" name="sku_producto_nuevo">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre de producto</label>
                                        <input type="text" class="form-control" placeholder="Nombre de producto" id="nombre_producto_nuevo" name="nombre_producto_nuevo">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Costo</label>
                                        <input type="text" class="form-control" placeholder="Costo" id="costo_producto_nuevo" name="costo_producto_nuevo">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Precio venta al por menor</label>
                                        <input type="text" class="form-control" placeholder="Precio venta al por menor" id="precio_menudeo_producto_nuevo" name="precio_menudeo_producto_nuevo">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Codigo SAT</label>
                                        <input type="text" class="form-control" placeholder="Codigo SAT" id="sat_producto_nuevo" name="sat_producto_nuevo">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" id="tipo_producto_nuevo" name="tipo_producto_nuevo">
                                            <option value="">Selecciona</option>
                                            <option value="1">No Definido</option>
                                            <option value="2">Normal</option>
                                            <option value="3">Nuevo</option>
                                            <option value="4">Descontinuado</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" rows="3" id="descripcion_producto_nuevo" name="descripcion_producto_nuevo"></textarea>
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

<!--Modal Seguimiento-->
<div class="modal right1 fade" id="modal-actualiza-seguimiento" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('seguimiento.update') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Producto de orden</label>
                                        <select class="form-control" id="producto_seguimiento_id" name="producto_seguimiento_id" required disabled>
                                            <option value="">Selecciona</option>
                                            @foreach($productosOrden as $producto)
                                                <option value="{{ $producto->producto->id }}" {{ ( $producto->producto_id == $producto->producto->id) ? 'selected' : '' }}>{{ $producto->producto->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto preproducción</label>
                                        <input type="file" id="input-preproduccion" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="preproduccion_seguimiento">
                                        <input type="hidden" id="seguimiento_id" class="form-cotrol" name="seguimiento_id">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nueva</label>
                                        <img class="imgZoom" id="foto-preproduccion-seleccionada" width="70" height="70">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Registrada</label>
                                        <img class="imgZoom" id="foto-preproduccion" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto producción</label>
                                        <input type="file" id="input-produccion" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="produccion_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nueva</label>
                                        <img class="imgZoom" id="foto-produccion-seleccionada" width="70" height="70">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Registrada</label>
                                        <img class="imgZoom" id="foto-produccion" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto OEM 1</label>
                                        <input type="file" id="input-oem_uno" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="oem_uno_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nueva</label>
                                        <img class="imgZoom" id="foto-oem_uno-seleccionada" width="70" height="70">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Registrada</label>
                                        <img class="imgZoom" id="foto-oem_uno" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto OEM 2</label>
                                        <input type="file" id="input-oem_dos" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="oem_dos_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nueva</label>
                                        <img class="imgZoom" id="foto-oem_dos-seleccionada" width="70" height="70">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Registrada</label>
                                        <img class="imgZoom" id="foto-oem_dos" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto OEM 3</label>
                                        <input type="file" id="input-oem_tres" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="oem_tres_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nueva</label>
                                        <img class="imgZoom" id="foto-oem_tres-seleccionada" width="70" height="70">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Registrada</label>
                                        <img class="imgZoom" id="foto-oem_tres" width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-8">
                                        <label>Foto empaquetado</label>
                                        <input type="file" id="input-empaquetado" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="empaquetado_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nueva</label>
                                        <img class="imgZoom" id="foto-empaquetado-seleccionada" width="70" height="70">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Registrada</label>
                                        <img class="imgZoom" id="foto-empaquetado" width="70" height="70">
                                    </div>
                                </div>

                                <div class="col-md-6 line">
                                    <div class="form-group">

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
<div class="modal right1 fade" id="modal-actualiza-caracteristica" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('caracteristica.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Actuializa Caracteristica</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Producto de orden</label>
                                        <select readonly="" id="producto_caracterisitca_id" class="form-control" name="producto_id" required>
                                            <option value="">Selecciona</option>
                                            @foreach($productosOrden as $producto)
                                                <option value="{{ $producto->producto->id }}">{{ $producto->producto->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="caracteristica_id" id="caracteristica_id">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Especificaciones de producto</label>
                                        <textarea id="especificacion_producto" required class="form-control" placeholder="Ingresa las especificaciones" rows="3" name="especificacion_producto"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Especificaciones electricas</label>
                                        <textarea id="especificacion_electrica" required class="form-control" placeholder="Ingresa las especificaciones electricas" rows="3" name="especificaion_electrica"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Link amazon</label>
                                        <input id="link_amazon" type="url" name="link_amazon" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Link alibaba</label>
                                        <input id="link_alibaba" type="url" name="link_alibaba" class="form-control">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualiza</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->


<!--Modal Clasificacion-->
<div class="modal right1 fade" id="modal-actualiza-clasificacion" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('clasificacion.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nueva Clasificación</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Producto de orden</label>
                                        <select class="form-control" id="producto_id_actualiza_clasificacion"  name="producto_id" disabled>
                                            <option value="">Selecciona</option>
                                            @foreach($productosOrden as $producto)
                                                <option value="{{ $producto->producto->id }}">{{ $producto->producto->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="clasificacion_id" name="clasificacion_id">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Clasificación Arancelaria</label>
                                        <input type="text" class="form-control" id="actualiza_clasificacion_arancelaria" name="clasificacion_arancelaria" onKeyPress="return soloNumeros(event)" required>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>NOM 1</label>
                                        <input type="text" class="form-control" id="actualiza_nom_1" name="nom_1">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>NOM 2</label>
                                        <input type="text" class="form-control" id="actualiza_nom_2" name="nom_2">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>NOM 3</label>
                                        <input type="text" class="form-control" id="actualiza_nom_3" name="nom_3">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>NOM 4</label>
                                        <input type="text" class="form-control" id="actualiza_nom_4" name="nom_4">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Diseño-->
<div class="modal right1 fade" id="modal-actualiza-diseno" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('diseno.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Actualiza Diseño</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Producto de orden</label>
                                        <select class="form-control" id="produto_diseno_id"  name="producto_id" disabled>
                                            <option value="">Selecciona</option>
                                            @foreach($productosOrden as $producto)
                                                <option value="{{ $producto->producto->id }}">{{ $producto->producto->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="diaeno_id" name="diseno_id">
                                    </div>
                                </div>
                                <div class="col-md-4 line">
                                    <div class="form-group">
                                        <label>¿Requiere OEM?</label><br>
                                        <label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="oem" id="oem_diseno_actualiza"/> <span></span></label>
                                    </div>
                                </div>
                                <div class="col-md-4 line">
                                    <div class="form-group">
                                        <label>¿Empaque?</label><br>
                                        <label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="empaque" id="empaque_diseno_actualiza"/> <span></span></label>
                                    </div>
                                </div>
                                <div class="col-md-4 line">
                                    <div class="form-group">
                                        <label>¿Instructivo?</label><br>
                                        <label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="instructivo" id="instructivo_diseno_actualiza"/> <span></span></label>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Fecha aviso diseño</label>
                                        <input type="text" class="form-control datepicker" name="fecha_aviso_diseno" id="fecha_diseno_diseno_actualiza">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Producto listo diseño</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="producto_diseno">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Empaque diseño listo</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="empaque_diseno">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Instructivo diseño listo</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="instructivo_diseno">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>OEM autorizado por trafico</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="oem_autorizado_trafico">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Fecha autorizacion trafico</label>
                                        <input type="text" class="form-control datepicker" name="fecha_autorizacion_trafico" id="fecha_trafico_diseno_actualiza">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Archivos Diec Cut</label>
                                        <input type="file" class="filestyle2" data-dragdrop="true" data-text="Buscar..." data-btnClass="btn-primary" name="archivos_fabricante[]" multiple>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Archivos Diseño</label>
                                        <input type="file" class="filestyle2" data-dragdrop="true" data-text="Buscar..." data-btnClass="btn-primary" name="archivos_diseno[]" multiple>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Status OEM diseño</label>
                                        <select class="form-control" name="status_oem_diseno" id="status_oem_diseno">
                                            <option value="">Selecciona</option>
                                            <option value="En preparación">En preparación</option>
                                            <option value="Esperando archivos">Esperando archivos</option>
                                            <option value="Finalizado">Finalizado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->