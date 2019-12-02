<!-- Modals requeridos en creacion de orden de compra -->

<!--Modal Agregar productos-->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="productos-form" action="{{ route('producto.save', ['id' => $orden->id]) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Agregar Productos</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 line pagos-inputs">
                            <div class="form-group">
                                <label>Producto</label>
                                <select id="productosSelectCrea" class="form-control selectProductos"
                                        name="nombre_productoM" id="nombre_producto"
                                        style=" display: block; width: 100%">
                                    <option value="">Selecciona</option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->sku}}">{{$producto->name}}</option>
                                    @endforeach
                                </select>
                                <div class="extras_crea"></div>
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="">&nbsp;</label>
                            <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2"
                                    data-toggle="modal" data-target="#nuevo-producto-guarda-modal" id="nuevo_proveedor">
                                <i class="fa fa-pencil-square-o"></i></button>
                        </div>
                        <div class="col-md-5 line pagos-inputs">
                            <div class="form-group">
                                <label>Incoterm</label>
                                <select class="form-control" name="icoterm_productoM" id="icoterm_producto">
                                    <option value="">Selecciona</option>
                                    {{--<option value="FOM">FOM</option>--}}
                                    {{--<option value="EXW">EXW</option>--}}
                                    @foreach($incoterms as $incoterm)
                                        <option value="{{ $incoterm->nombre }}">{{ $incoterm->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="">&nbsp;</label>
                            <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2"
                                    data-toggle="modal" data-target="#nuevo-incoterm-guarda-modal" id="nuevo-incot"><i
                                        class="fa fa-pencil-square-o"></i></button>
                        </div>

                        <div class="col-md-5 line variant-inputs" >
                            <label>Variante</label>
                            <select class="form-control" name="product_variant_id" id="product_variant_id">
                                <option value="">Selecciona</option>
                            </select>
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
                                <input type="text" class="form-control" id="leadtime_producto" name="leadtime_productoM"
                                       placeholder="Lead Time" onKeyPress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Costo USD</label>
                                <input type="text" class="form-control monto" id="costo_producto" name="costo_productoM"
                                       placeholder="Costo" onkeyup="multi();"
                                       onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="text" class="form-control monto" id="cantidad_producto"
                                       name="cantidad_productoM" placeholder="Cantidad" onkeyup="multi();"
                                       onKeyPress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-md-6 line pagos-inputs">
                            <div class="form-group">
                                <label>Subtotal</label>
                                <input type="text" class="form-control" id="subtotal_producto_guarda"
                                       name="subtotal_productoM" placeholder="Subtotal" disabled
                                       onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </form>
        </div><!-- modal-dialog -->
    </div>
</div><!-- modal -->

<!--Modal Nuevo Gasto de Origen-->
<div class="modal right1 fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="gastos-origen-form" action="{{ route('gasto_origen.save', ['id' => $orden->id]) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Origen (USD)</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
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
                        <div class="form-group col-sm-1">
                            <label for="">&nbsp;</label>
                            <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2"
                                    data-toggle="modal" data-target="#nuevo-tipo-gasto-origen-guarda-modal" id=""><i
                                        class="fa fa-pencil-square-o"></i></button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Costo $ (USD)</label>
                                <input type="text" class="form-control" id="costo_gastos_origen"
                                       name="costo_gastos_origenM" placeholder="Costo"
                                       onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Comprobante</label>
                                <input type="file" class="filestyle" name="comprobante_gastos_origen"
                                       id="comprobante_gastos_origen">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Notas</label>
                                <textarea class="form-control" rows="3" placeholder="Nota ..."
                                          name="nota_gastos_origenM" id="nota_gastos_origen"></textarea>
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

<!--Modal Nuevo Gasto de Destino-->
<div class="modal right1 fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="gastos-destino-form" action="{{ route('gasto_destino.save', ['id' => $orden->id]) }}"
                  method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Destino</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 line">
                            <div class="form-group">
                                <label for="">Tipo de gasto</label>
                                <select class="form-control" name="tipo_gasto_gastos_destinoM"
                                        id="tipo_gasto_gastos_destino">
                                    <option value="">Selecciona</option>
                                    @foreach($gastosDestino as $gastoDestino)
                                        <option value="{{$gastoDestino->id}}">{{$gastoDestino->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="">&nbsp;</label>
                            <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2"
                                    data-toggle="modal" data-target="#nuevo-tipo-gasto-destino-guarda-modal" id=""><i
                                        class="fa fa-pencil-square-o"></i></button>
                        </div>
                        <div class="col-md-6 line">
                            <div class="form-group">
                                <label for="">Costo $</label>
                                <input type="text" class="form-control" id="costo_gastos_destino"
                                       name="costo_gastos_destinoM" placeholder="Costo"
                                       onkeypress="return filterFloat(event,this);">
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
                                <input type="file" class="filestyle" name="comporbante_gastos_destino"
                                       id="comporbante_gastos_destino">
                            </div>
                        </div>
                        <div class="col-md-12 line">
                            <div class="form-group">
                                <label for="">Notas</label>
                                <textarea class="form-control" rows="3" placeholder="Nota ..."
                                          name="nota_gastos_destinoM" id="nota_gastos_destino"></textarea>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                                        <input type="text" class="form-control" placeholder="Nombre"
                                               id="nombreProveedor" name="nombreProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre de contacto</label>
                                        <input type="text" class="form-control" placeholder="Nombre de contacto"
                                               id="nombreContactoProveedor" name="nombreContactoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tax</label>
                                        <input type="text" class="form-control" placeholder="Tax" id="taxProveedor"
                                               name="taxProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" placeholder="Dirección"
                                               id="direccionProveedor" name="direccionProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>País</label>
                                        <input type="text" class="form-control" placeholder="País" id="paisProveedor"
                                               name="paisProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" class="form-control" placeholder="Telefono"
                                               id="tlefonoProveedor" name="tlefonoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="email" class="form-control" placeholder="Correo"
                                               id="correoProveedor" name="correoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Cuanta bancaria</label>
                                        <input type="text" class="form-control" placeholder="Cuanta bancaria" id="bank_account" name="bank_account">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Dirección Banco</label>
                                        <input type="text" class="form-control" placeholder="Dirección Banco" id="bank_address" name="bank_address">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Código Swift</label>
                                        <input type="text" class="form-control" placeholder="Swift" id="swift" name="swift">
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                                        <input type="text" class="form-control" placeholder="Tipo de compra"
                                               id="tipoCompraNombre" name="tipoCompraNombre">
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

<!--Modal Transito-->
<div class="modal right1 fade" id="transito-modal" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="transito-form" action="{{ route('transito.save', ['id' => $orden->id]) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Registrar Transito</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-5 line pagos-inputs">
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
                                <div class="form-group col-sm-1">
                                    <label for="">&nbsp;</label>
                                    <button type="button"
                                            class="form-control btn btn-block btn-default pull-right col-sm-2"
                                            data-toggle="modal" data-target="#nuevo-metodo-guarda-modal" id=""><i
                                                class="fa fa-pencil-square-o"></i></button>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Guia</label>
                                        <input type="text" class="form-control" placeholder="Guia" id="guia_transito"
                                               name="guia_transito">
                                    </div>
                                </div>
                                <div class="col-md-5 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Forwarder</label>
                                        <select class="form-control" name="forwarder_transito" id="forwarder_transito">
                                            <option value="">Selecciona</option>
                                            {{--<option value="1">uno</option>--}}
                                            @foreach($forwardersTransito as $forwarder)
                                                <option value="{{ $forwarder->id }}">{{ $forwarder->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="">&nbsp;</label>
                                    <button type="button"
                                            class="form-control btn btn-block btn-default pull-right col-sm-2"
                                            data-toggle="modal" data-target="#nuevo-forwarder-guarda-modal" id=""><i
                                                class="fa fa-pencil-square-o"></i></button>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Fecha de embarque</label>
                                        <input type="text" class="form-control datepicker" id="fecha_embarque_transito"
                                               name="fecha_embarque_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Fecha tentativa de llegada</label>
                                        <input type="text" class="form-control datepicker"
                                               id="fecha_tentativa_llegada_transito"
                                               name="fecha_tentativa_llegada_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Comercial invoce</label>
                                        <input type="text" class="form-control" placeholder="Comercial invoce"
                                               id="comercial_invoce_transito" name="comercial_invoce_transito">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Comercial invoce (archivo)</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false"
                                               data-text="Buscar..." data-btnClass="btn-primary"
                                               id="archivo_comercial_invoce_file" name="archivo_comercial_invoce_file">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Cajas #</label>
                                        <input type="text" class="form-control" placeholder="Cajas #"
                                               id="cajas_transito" name="cajas_transito"
                                               onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>CBM #</label>
                                        <input type="text" class="form-control" placeholder="CBM #" id="cbm_transito"
                                               name="cbm_transito" onKeyPress="filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Peso KG</label>
                                        <input type="text" class="form-control" placeholder="Peso KG" id="peso_transito"
                                               name="peso_transito" onkeypress="return filterFloat(event,this);">
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
            <form id="pedimento-form" action="{{ route('pedimento.save', ['id'=> $orden->id]) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                                        <input type="text" class="form-control" placeholder="# Pedimento"
                                               id="numero_pedimento" name="numero_pedimento">
                                    </div>
                                </div>
                                <div class="col-md-5 line pagos-inputs">
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
                                <div class="form-group col-sm-1">
                                    <label for="">&nbsp;</label>
                                    <button type="button"
                                            class="form-control btn btn-block btn-default pull-right col-sm-2"
                                            data-toggle="modal" data-target="#nuevo-aduana-guarda-modal" id=""><i
                                                class="fa fa-pencil-square-o"></i></button>
                                </div>
                                <div class="col-md-5 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Agente Aduanal</label>
                                        <select class="form-control" name="agente_aduanal_pedimento"
                                                id="agente_aduanal_pedimento">
                                            <option value="">Selecciona</option>
                                            @foreach( $agentesAduanales as $agenteAduanal)
                                                <option value="{{ $agenteAduanal->id }}">{{ $agenteAduanal->nombre }} {{ $agenteAduanal->apelldos }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="">&nbsp;</label>
                                    <button type="button"
                                            class="form-control btn btn-block btn-default pull-right col-sm-2"
                                            data-toggle="modal" data-target="#nuevo-agente-aduanal-guarda-modal" id="">
                                        <i class="fa fa-pencil-square-o"></i></button>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>Tipo de cambio de pedimento</label>
                                        <input type="text" class="form-control"
                                               placeholder="Tipo de cambio de pedimento"
                                               id="tipo_cambio_pedimento_pedimento"
                                               name="tipo_cambio_pedimento_pedimento"
                                               onkeypress="return filterFloat(event,this);">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>DTA</label>
                                        <input type="text" class="form-control" placeholder="DTA" id="dta_pedimento"
                                               name="dta_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>CNT</label>
                                        <input type="text" class="form-control" placeholder="CNT" id="cnt_pedimento"
                                               name="cnt_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>IGI</label>
                                        <input type="text" class="form-control" placeholder="IGI" id="igi_pedimento"
                                               name="igi_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>PRV</label>
                                        <input type="text" class="form-control" placeholder="PRV" id="prv_pedimento"
                                               name="prv_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line pagos-inputs">
                                    <div class="form-group">
                                        <label>IVA</label>
                                        <input type="text" class="form-control" placeholder="IVA" id="iva_pedimento"
                                               name="iva_pedimento" onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label for="">Pedimento Digital</label>
                                        <input type="file" class="filestyle" data-text="Buscar..."
                                               data-btnClass="btn-primary" id="pedimento_digital_guarda"
                                               name="pedimento_digital_guarda">
                                    </div>
                                </div>

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Pagos-->
<div class="modal right1 fade" id="nuevo-pago-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('pago.save', ['id'=> $orden->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Pago</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Cantidad</label>
                                        <input type="text" class="form-control monto" placeholder="Cantidad"
                                               id="pago_pagos" name="pago_pagos"
                                               onkeypress="return filterFloat(event,this);" required>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label for="">Moneda</label>
                                        <select class="form-control" name="currency" id="currency">
                                            <option value="">Selecciona</option>
                                            @foreach($currencies as $currency)
                                                <option value="{{$currency->id}}">{{$currency->code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            {{--    <div class="form-group col-sm-1">
                                    <label for="">&nbsp;</label>
                                    <button type="button"
                                            class="form-control btn btn-block btn-default pull-right col-sm-2"
                                            data-toggle="modal" data-target="#nuevo-currency-guarda-modal"
                                            id="nuevo_proveedor"><i class="fa fa-pencil-square-o"></i></button>
                                </div>--}}
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Fecha de pago</label>
                                        <input type="text" class="form-control datepicker" name="fecha_pago">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo de cambio de pago</label>
                                        <input type="text" class="form-control" placeholder="Tipo cambio de pago"
                                               id="tipo_cambio_pago_orden" name="tipo_cambio_pago_orden"
                                               onkeypress="return filterFloat(event,this);" required>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Referencia</label>
                                        <input type="text" class="form-control monto" placeholder="Referencia"
                                               id="referencia_pago" name="referencia_pago">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label id="input-pago">Comprobante</label>
                                        <input type="file" class="filestyle" data-input="false" data-badge="true"
                                               data-text="Buscar..." data-btnClass="btn-primary" id="pago_comprobante"
                                               name="pago_comprobante">
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

<!--Modal Seguimiento-->
<div class="modal right1 fade" id="seguimiento-producto-modal" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('seguimiento.save', ['id'=> $orden->id]) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                                        <select class="form-control" name="producto_seguimiento_id" required>
                                            <option value="">Selecciona</option>
                                            @foreach($productosOrden as $producto)
                                                <option value="{{ $producto->producto->id }}">{{ $producto->producto->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-10">
                                        <label>Foto preproducción</label>
                                        <input type="file" class="filestyle"
                                               id="input-preproduccion-seleccionada-guarda" data-badge="true"
                                               data-input="false" data-text="Buscar..." data-btnClass="btn-primary"
                                               name="preproduccion_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Seleccionada</label>
                                        <img class="imgZoom" id="foto-preproduccion-seleccionada-guarda" width="70"
                                             height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-10">
                                        <label>Foto producción</label>
                                        <input type="file" class="filestyle" id="input-produccion-seleccionada-guarda"
                                               data-badge="true" data-input="false" data-text="Buscar..."
                                               data-btnClass="btn-primary" name="produccion_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Seleccionada</label>
                                        <img class="imgZoom" id="foto-produccion-seleccionada-guarda" width="70"
                                             height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-10">
                                        <label>Foto OEM 1</label>
                                        <input type="file" class="filestyle"
                                               id="input-oem_uno_seguimiento-seleccionada-guarda" data-badge="true"
                                               data-input="false" data-text="Buscar..." data-btnClass="btn-primary"
                                               name="oem_uno_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Seleccionada</label>
                                        <img class="imgZoom" id="foto-oem_uno_seguimiento-seleccionada-guarda"
                                             width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-10">
                                        <label>Foto OEM 2</label>
                                        <input type="file" class="filestyle"
                                               id="input-oem_dos_seguimiento-seleccionada-guarda" data-badge="true"
                                               data-input="false" data-text="Buscar..." data-btnClass="btn-primary"
                                               name="oem_dos_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Seleccionada</label>
                                        <img class="imgZoom" id="foto-oem_dos_seguimiento-seleccionada-guarda"
                                             width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-10">
                                        <label>Foto OEM 3</label>
                                        <input type="file" class="filestyle"
                                               id="input-oem_tres_seguimiento-seleccionada-guarda" data-badge="true"
                                               data-input="false" data-text="Buscar..." data-btnClass="btn-primary"
                                               name="oem_tres_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Seleccionada</label>
                                        <img class="imgZoom" id="foto-oem_tres_seguimiento-seleccionada-guarda"
                                             width="70" height="70">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group col-md-10">
                                        <label>Foto empaquetado</label>
                                        <input type="file" class="filestyle" data-badge="true"
                                               id="input-empaquetado_seguimiento-seleccionada-guarda" data-input="false"
                                               data-text="Buscar..." data-btnClass="btn-primary"
                                               name="empaquetado_seguimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Seleccionada</label>
                                        <img class="imgZoom" id="foto-empaquetado_seguimiento-seleccionada-guarda"
                                             width="70" height="70">
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
<div class="modal right1 fade" id="caracteristica-producto-modal" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('caracteristica.save', ['id'=> $orden->id]) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                                        <select class="form-control" name="producto_id" id="producto_id_caracteristicas" required>
                                            <option value="">Selecciona</option>
                                            @foreach($productosOrden as $producto)
                                                <option value="{{ $producto->producto->id }}">{{ $producto->producto->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Especificaciones de producto</label>
                                        <textarea required class="form-control"
                                                  placeholder="Ingresa las especificaciones" rows="3"
                                                  name="especificacion_producto" id="especificacion_producto"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Especificaciones electricas</label>
                                        <textarea required class="form-control"
                                                  placeholder="Ingresa las especificaciones electricas" rows="3"
                                                  name="especificaion_electrica" id="especificacion_electrica"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Link amazon</label>
                                        <input type="url" name="link_amazon" id="link_amazon" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Link alibaba</label>
                                        <input type="url" name="link_alibaba" id="link_alibaba" class="form-control">
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

<!-- Producto Nuevo -->
<div class="modal right1 fade" id="nuevo-producto-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="nuevo-producto-guarda-form" action="{{ route('producto_base.save') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                                        <input type="text" class="form-control" placeholder="SKU"
                                               id="sku_producto_nuevo" name="sku_producto_nuevo">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre de producto</label>
                                        <input type="text" class="form-control" placeholder="Nombre de producto"
                                               id="nombre_producto_nuevo" name="nombre_producto_nuevo">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Costo</label>
                                        <input type="text" class="form-control" placeholder="Costo"
                                               id="costo_producto_nuevo" name="costo_producto_nuevo">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Precio venta al por menor</label>
                                        <input type="text" class="form-control" placeholder="Precio venta al por menor"
                                               id="precio_menudeo_producto_nuevo" name="precio_menudeo_producto_nuevo">
                                    </div>
                                </div>
                                <!-- /.col
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Codigo SAT</label>
                                        <input type="text" class="form-control" placeholder="Codigo SAT"
                                               id="sat_producto_nuevo" name="sat_producto_nuevo">
                                    </div>
                                </div>-->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" id="tipo_producto_nuevo"
                                                name="tipo_producto_nuevo">
                                            <option value="">Selecciona</option>
                                            <option value="1">NUEVO</option>
                                            <option value="2">LINEA</option>
                                            <option value="3">MAYOREO</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" rows="3" id="descripcion_producto_nuevo"
                                                  name="descripcion_producto_nuevo"></textarea>
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

<!--Modal Clasificacion-->
<div class="modal right1 fade" id="guarda-clasificacion-modal" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('clasificacion.save' , ['id' => $orden->id]) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                                        <select class="form-control" id="producto_id" name="producto_id">
                                            <option value="">Selecciona</option>
                                            @foreach($productosOrden as $producto)
                                                <option value="{{ $producto->producto->id }}">{{ $producto->producto->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Clasificación Arancelaria</label>
                                        <input type="text" class="form-control" name="clasificacion_arancelaria" id="clasificacion_arancelaria"
                                               onKeyPress="return soloNumeros(event)" required>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>NOM 1</label>
                                        <input type="text" class="form-control" name="nom_1" id="nom_1">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>NOM 2</label>
                                        <input type="text" class="form-control" name="nom_2" id="nom_2">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>NOM 3</label>
                                        <input type="text" class="form-control" name="nom_3" id="nom_3">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>NOM 4</label>
                                        <input type="text" class="form-control" name="nom_4" id="nom_4">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!--Modal Diseño-->
<div class="modal right1 fade" id="nuevo-diseno-producto" tabindex="-1" role="dialog" aria-labelledby="pagos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('diseno.save' , ['id' => $orden->id]) }}" method="POST"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Diseño</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Producto de orden</label>
                                        <select class="form-control" name="producto_id">
                                            <option value="">Selecciona</option>
                                            @foreach($productosOrden as $producto)
                                                <option value="{{ $producto->producto->id }}"> {{ $producto->producto->name }}
                                                    @if ($producto->variant)
                                                        - {{ $producto->variant}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 line">
                                    <div class="form-group">
                                        <label>¿Requiere OEM?</label><br>
                                        <label class="checkbox-inline checbox-switch switch-primary"> <input
                                                    type="checkbox" name="oem"/> <span></span></label>
                                    </div>
                                </div>
                                <div class="col-md-4 line">
                                    <div class="form-group">
                                        <label>¿Empaque?</label><br>
                                        <label class="checkbox-inline checbox-switch switch-primary"> <input
                                                    type="checkbox" name="empaque"/> <span></span></label>
                                    </div>
                                </div>
                                <div class="col-md-4 line">
                                    <div class="form-group">
                                        <label>¿Instructivo?</label><br>
                                        <label class="checkbox-inline checbox-switch switch-primary"> <input
                                                    type="checkbox" name="instructivo"/> <span></span></label>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Fecha aviso diseño</label>
                                        <input type="text" class="form-control datepicker" name="fecha_aviso_diseno">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Producto listo diseño</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false"
                                               data-text="Buscar..." data-btnClass="btn-primary" name="producto_diseno">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Empaque diseño listo</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false"
                                               data-text="Buscar..." data-btnClass="btn-primary" name="empaque_diseno">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Instructivo diseño listo</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false"
                                               data-text="Buscar..." data-btnClass="btn-primary"
                                               name="instructivo_diseno">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>OEM autorizado por trafico</label>
                                        <input type="file" class="filestyle" data-badge="true" data-input="false"
                                               data-text="Buscar..." data-btnClass="btn-primary"
                                               name="oem_autorizado_trafico">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Fecha autorizacion trafico</label>
                                        <input type="text" class="form-control datepicker"
                                               name="fecha_autorizacion_trafico">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Archivos Diec Cut</label>
                                        <input type="file" class="filestyle2" data-dragdrop="true" data-text="Buscar..."
                                               data-btnClass="btn-primary" name="archivos_fabricante[]" multiple>
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Archivos Diseño</label>
                                        <input type="file" class="filestyle2" data-dragdrop="true" data-text="Buscar..."
                                               data-btnClass="btn-primary" name="archivos_diseno[]" multiple>
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
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal Nuevo gasto origen -->
<div class="modal right1 fade" id="nuevo-tipo-gasto-origen-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('tipo-gasto-origen.save') }}" id="nuevo-tipo-gasto-origen-guarda-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo tipo gasto de origen</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre"
                                               id="nombre_gasto_origen" name="nombre_gasto_origen">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal Nuevo gasto destino -->
<div class="modal right1 fade" id="nuevo-tipo-gasto-destino-guarda-modal" tabindex="-1" role="dialog"
     aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('tipo-gasto-destino.save') }}" id="nuevo-tipo-gasto-destino-guarda-form"
                  method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo tipo gasto de destino</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre"
                                               id="nombre_gasto_destino" name="nombre_gasto_destino">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal Nuevo Método Transito -->
<div class="modal right1 fade" id="nuevo-metodo-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('metodo_transito.save') }}" id="nuevo-metodo-guarda-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo método tránsito</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nombre_metodo"
                                               name="nombre_metodo">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal Nuevo Forwarder Tránsito -->
<div class="modal right1 fade" id="nuevo-forwarder-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('forwarder_transito.save') }}" id="nuevo-forwarder-guarda-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo forwarder tránsito</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre"
                                               id="nombre_forwarder" name="nombre_forwarder">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal Nueva Aduana -->
<div class="modal right1 fade" id="nuevo-aduana-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('aduana_pedimento.save') }}" id="nuevo-aduana-guarda-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nueva aduana</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre" id="nombre_aduana"
                                               name="nombre_aduana">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Ubicación</label>
                                        <input type="text" class="form-control" placeholder="Ubicación"
                                               id="ubicacion_aduana" name="ubicacion_aduana">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal Nuevo agente aduanal -->
<div class="modal right1 fade" id="nuevo-agente-aduanal-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('agente_aduanal_pedimento.save') }}" id="nuevo-aduana-guarda-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo agente aduanal</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre"
                                               id="nombre_agente_aduanal" name="nombre_agente_aduanal">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" class="form-control" placeholder="Apellido"
                                               id="apellidos_agente_aduanal" name="apellidos_agente_aduanal">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Aduana</label>
                                        <select class="form-control" name="aduana_id" id="aduana_id">
                                            <option value="">Selecciona</option>
                                            @foreach($aduanas as $aduana)
                                                <option value="{{ $aduana->id }}">{{ $aduana->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal currency modal -->
<div class="modal right1 fade" id="nuevo-currency-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('moneda.save') }}" id="nuevo-currency-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nueva moneda</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Dólar americano"
                                               id="currency_name" name="currency_name">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Abreviación moneda</label>
                                        <input type="text" class="form-control" placeholder="USD" id="currency_code"
                                               name="currency_code">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal nuevo incoterm -->
<div class="modal right1 fade" id="nuevo-incoterm-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('incoterm.save') }}" id="nuevo-incoterm-guarda-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo incoterm</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre"
                                               id="nombre_incoterm" name="nombre_incoterm">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<!-- Modal nueva variante -->
<div class="modal right1 fade" id="nueva-variante-guarda-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form action="{{ route('variant.save') }}" id="nueva-variante-guarda-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nueva variante</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre"
                                               id="nombre_variant" name="nombre_variant">
                                        <input type="text" class="form-control" placeholder="product_id"
                                               id="new_variant_product_id" name="new_variant_product_id">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->