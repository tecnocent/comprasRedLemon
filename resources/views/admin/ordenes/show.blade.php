@extends('layouts.app')

@section('content')
    <style>
        .select2-selection {
            height: 32px !important;
        }
        .diseno{
            font-size: 10px;
        }
        .formPrincipal {
            height: 68px;
        }
        .compra-create , .content-create-orden {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        .select-tipo {
            font-size: 10px !important;
            width: 75px !important;
            height: 21px !important;
        }
        .fecha-requerida {
            height: 21px;
            width: 126px;
            font-size: 10px;
        }
        .error {
            color: red;
            font-weight: 100;
        }
        .pagos-inputs {
            height: 78px;
        }
        .visible {
            visibility: visible;
        }
        .invisible {
            visibility: hidden;
        }
        .diseno-bajo {
            margin-top: 30px;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content" style="margin-top:0px"><br>
        <!-- Content Header (Page header) -->
        <section class="content content-create-orden">
            <h1 style="margin-top:-20px"> Orden de Compra<small> Edición</small> </h1>
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable compra-create">
                    <div class="">
                        <!-- Formulario -->
                        <form id="form-orden" role="form" method="POST" action="{{route('orden.update', ['id' => $orden->id])}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box box-primary" style="line-height: 2em;">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <div class="box-header with-border">
                                    <h3 class="box-title">Ingresa los datos para la edición</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for=""># OC</label>
                                        <input type="text" class="form-control" id="id_orden" name="id_orden" placeholder="Ingresa el ID de OC" value="{{ $orden->identificador }}">
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Estatus</label>
                                        <select class="form-control" name="estatus" id="estatus">
                                            <option value="">Selecciona</option>
                                            <option value="borrador" {{ ( $orden->status == "borrador") ? 'selected' : '' }}>Borrador</option>
                                            <option value="po creada" {{ ( $orden->status == "po creada") ? 'selected' : '' }}>Po Creada</option>
                                            <option value="pi pedido" {{ ( $orden->status == "pi pedido") ? 'selected' : '' }}>Pi Pedido</option>
                                            <option value="por autorizar" {{ ( $orden->status == "por autoriza") ? 'selected' : '' }}>Por Autorizar</option>
                                            <option value="produccion" {{ ( $orden->status == "produccion") ? 'selected' : '' }}>Produccion</option>
                                            <option value="enviado" {{ ( $orden->status == "enviado") ? 'selected' : '' }}>Enviado</option>
                                            <option value="aduana" {{ ( $orden->status == "aduana") ? 'selected' : '' }}>Aduana</option>
                                            <option value="recepcion" {{ ( $orden->status == "recepcion") ? 'selected' : '' }}>Recepcion</option>
                                            <option value="cancelado" {{ ( $orden->status == "cancelado") ? 'selected' : '' }}>Cancelado</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Encargado interno</label>
                                        <select class="form-control" name="encargado" id="encargado">
                                            <option value="">Selecciona</option>
                                            @foreach ($usuarios as $usuaio)
                                                <option value="{{ $usuaio->name }}" {{ ( $usuaio->name == $orden->encargdo_interno) ? 'selected' : '' }}>{{ $usuaio->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-5 formPrincipal">
                                        <label for="">Proveedor</label>
                                        <select id="proveedor" class="form-control" name="proveedor">
                                            <option value="">Selecciona</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}" {{ ( $proveedor->id == $orden->proveedor_id) ? 'selected' : '' }}>{{ $proveedor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-1 formPrincipal">
                                        <label for="">&nbsp;</label>
                                        <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2" data-toggle="modal" data-target="#nuevo-proveedor-modal" id="nuevo_proveedor"><i class="fa fa-pencil-square-o"></i> </button>
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Fecha inicio</label>
                                        <input type="text" class="form-control pull-right datepicker" id="fecha_inicio" name="fecha_inicio" value="{{ $orden->fecha_inicio }}">
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Almacen de llegada</label>
                                        <select class="form-control" name="almacen_llegada" id="almacen_llegada">
                                            <option value="">Selecciona</option>
                                            @foreach ($almacenes as $almacen)
                                                <option value="{{ $almacen->id }}" {{ ( $almacen->id == $orden->almacen_id) ? 'selected' : '' }}>{{ $almacen->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-5 formPrincipal">
                                        <label for="">Tipo de compra</label>
                                        <select class="form-control" id="tipoCompraSelect" name="tipo_compra">
                                            @foreach ($tiposCompra as $tipoCompra)
                                                <option value="{{ $tipoCompra->id }}" {{ ( $tipoCompra->id == $orden->tipo_compra) ? 'selected' : '' }}>{{ $tipoCompra->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-1 formPrincipal">
                                        <label for="">&nbsp;</label>
                                        <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2" data-toggle="modal" data-target="#nuevo-tipo-compra" id="nuevo_tipo_compra"><i class="fa fa-pencil-square-o"></i> </button>
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Requerimiento</label>
                                        <select class="form-control" name="requerimiento" id="requerimiento">
                                            <option value="">Selecciona</option>
                                            <option value="normal" {{ ( "normal" == $orden->requerimiento) ? 'selected' : '' }}> Normal</option>
                                            <option value="urgente" {{ ( "irgente" == $orden->requerimiento) ? 'selected' : '' }}>Urgente</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">Descripción</label>
                                        <textarea class="form-control" rows="3" placeholder="Ingresa la descripción" name="descripcion_oc" id="descripcion_oc">{{ $orden->descripcion ?? null }}</textarea>
                                    </div>
                                    <br>
                                    <div id="exTab3" class="form-group col-sm-12">
                                        <ul  class="nav nav-tabs">
                                            <li class="active">
                                                <a  href="#1b" data-toggle="tab">Productos</a>
                                            </li>
                                            <li>
                                                <a href="#4b" data-toggle="tab">Diseño</a>
                                            </li>
                                            <li>
                                                <a href="#3b" data-toggle="tab">Gastos Destino</a>
                                            </li>
                                            <li>
                                                <a href="#2b" data-toggle="tab">Gastos Origen</a>
                                            </li>
                                            <li>
                                                <a href="#6b" data-toggle="tab">Transito</a>
                                            </li>
                                            <li>
                                                <a href="#7b" data-toggle="tab">Pedimento</a>
                                            </li>
                                            <li>
                                                <a href="#5b" data-toggle="tab">Pagos</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content clearfix">
                                            <div class="tab-pane active" id="1b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal2" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Agregar producto</button>
                                                <div class="row" id="table2">
                                                    <div class="panel panel-default monto-default" id="aaa">
                                                        <div class="panel-body">
                                                            <table id="" class="table table-striped table-bordered productos" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>SKU</th>
                                                                    <th>Producto</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Costo</th>
                                                                    <th>Total</th>
                                                                    <th>Incoterm</th>
                                                                    <th>Lead Time</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($productosOrden as $productoOrden)
                                                                    <tr>
                                                                        <td>{{ $productoOrden->producto->sku }}</td>
                                                                        <td>{{ $productoOrden->producto->name }}</td>
                                                                        <td>{{ $productoOrden->cantidad }}</td>
                                                                        <td>{{ $productoOrden->costo }}</td>
                                                                        <td>{{ $productoOrden->total }}</td>
                                                                        <td>{{ $productoOrden->incoterm }}</td>
                                                                        <td>{{ $productoOrden->leadtime }}</td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger-productos" data-id="{{ $productoOrden->id }}"><i class="fa fa-remove"></i></button>
                                                                            <button type="button" class="btn btn-warning btn-xs productoActualiza" data-toggle="modal" data-target="#modal-actualiza-producto" data-id="{{ $productoOrden->id }}"><i class="fa fa-pencil"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="2b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal3" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Nuevo gasto de origen</button>
                                                <div class="row" id="table2">
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="gastosOrigen" class="table table-striped table-bordered gastosOrigen" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Tipo de gasto</th>
                                                                    <th>Costo (USD)</th>
                                                                    <th>Notas</th>
                                                                    <th>Archivos</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                @foreach($gastosOrigenOrden as $gastoOrigenOrden)
                                                                    <tr>
                                                                        <td>{{ $gastoOrigenOrden->tipoGasto->name }}</td>
                                                                        <td>{{ $gastoOrigenOrden->costo }}</td>
                                                                        <td>{{ $gastoOrigenOrden->notas ?? 'Sin registro' }}</td>
                                                                        <td><a href="{{ url('/admin/orden/descarga') }}/{{$gastoOrigenOrden->comprobante}}" class="btn btn-link">Descargar</a></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger-gastos-origen" data-id="{{ $gastoOrigenOrden->id }}"><i class="fa fa-remove"></i></button>
                                                                            <button type="button" class="btn btn-warning btn-xs actualizaGastoOrigen" data-toggle="modal" data-target="#modal-actualiza-gasto-origen" data-id="{{ $gastoOrigenOrden->id }}"><i class="fa fa-pencil"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="3b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal4" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Nuevo gasto de destino</button>
                                                <div class="row" id="table3">
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="gastosDestino" class="table table-striped table-bordered gastosDestino" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Tipo de gasto</th>
                                                                    <th>Costo</th>
                                                                    <th>Moneda</th>
                                                                    <th>Notas</th>
                                                                    <th>Comprobante</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                @if(count($gastosDestino) > 0)
                                                                    @foreach($gastosDestinoOrden as $gastoDestinoOrden)
                                                                        <tr>
                                                                            <td>{{ $gastoDestinoOrden->tipoGasto->name }}</td>
                                                                            <td>{{ $gastoDestinoOrden->costo }}</td>
                                                                            <td>{{ $gastoDestinoOrden->moneda }}</td>
                                                                            <td>{{ $gastoDestinoOrden->notas ?? 'Sin registro' }}</td>
                                                                            <td><a href="{{ url('/admin/orden/descarga') }}/{{$gastoDestinoOrden->comprobante}}" class="btn btn-link">Descargar</a></td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-gastos-destino" data-id="{{ $gastoDestinoOrden->id }}"><i class="fa fa-remove"></i></button>
                                                                                <button type="button" class="btn btn-warning btn-xs actualizaGastoDestino" data-toggle="modal" data-target="#modal-actualiza-gasto-destino" data-id="{{ $gastoDestinoOrden->id }}"><i class="fa fa-pencil"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="4b">
                                                <div class="row" id="table4">
                                                    <div class="panel panel-default diseno-bajo" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="diseno" class="table table-striped table-bordered diseno" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>SKU</th>
                                                                    <th>Producto</th>
                                                                    <th>Descripción</th>
                                                                    <th>¿Logo en producto?</th>
                                                                    <th>¿OEM BOX?</th>
                                                                    <th>¿Instructivo?</th>
                                                                    <th>Archivos Die-Cut Fabricante</th>
                                                                    <th>Archivos autorizados Diseño</th>
                                                                    <th>Tipo</th>
                                                                    <th>Fecha requerida</th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="5b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pagos" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Agregar monto y pagos</button>
                                                <div class="row montoPago" id="montoPago">
                                                    <div class="panel panel-default monto-ssss" id="table-monto-default">
                                                        <div class="panel-heading">
                                                            <div class="row">
                                                                <div class="col-md-6 line">
                                                                    <div class="form-group">
                                                                        <h4>Monto USD</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 line">
                                                                    <div class="form-group">
                                                                        <h4>Comprobante</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table id="pagos" class="table table-striped table-bordered pagos" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Pago $</th>
                                                                    <th>Comprobante pago</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="6b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#transito"><i class="fa fa-plus"></i> Agregar transito</button>
                                                <div class="row" id="table4"><br>
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="transito" class="table table-striped table-bordered transito" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Metodo</th>
                                                                    <th>Guia</th>
                                                                    <th>Comercial Invoce</th>
                                                                    <th>Archivo Comercial Invoce</th>
                                                                    <th>Fecha embarque</th>
                                                                    <th>Fecha tentativa llegada</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                @foreach($transitosOrden as $transitoOrden)
                                                                    <tr>
                                                                        <td>{{ $transitoOrden->metodoTransito->nombre }}</td>
                                                                        <td>{{ $transitoOrden->guia }}</td>
                                                                        <td>{{ $transitoOrden->comercual_invoce }}</td>
                                                                        <td><a href="{{ url('/admin/orden/descarga') }}/{{$transitoOrden->comercial_invoce_file}}" class="btn btn-link">Descargar</a></td>
                                                                        <td>{{ $transitoOrden->fecha_embarque }}</td>
                                                                        <td>{{ $transitoOrden->fecha_tentativa }}</td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger-transito" data-id="{{ $transitoOrden->id }}"><i class="fa fa-remove"></i></button>
                                                                            <button type="button" class="btn btn-warning btn-xs actualizaTransito" data-toggle="modal" data-target="#modal-actualiza-transito" data-id="{{ $transitoOrden->id }}"><i class="fa fa-pencil"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane" id="7b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pedimento"><i class="fa fa-plus"></i> Agregar pedimento</button>
                                                <div class="row" id="pedimento"><br>
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="pedimento" class="table table-striped table-bordered pedimento" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Pedimento</th>
                                                                    <th>Pedimento Digital</th>
                                                                    <th>Aduana</th>
                                                                    <th>Agente Aduanal</th>
                                                                    <th>Tipo de Cambio Pedimento</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                @foreach($pedimentosOrden as $pedimentoOrden)
                                                                    <tr>
                                                                        <td>{{ $pedimentoOrden->pedimento }}</td>
                                                                        @if($pedimentoOrden->pedimento_digital)
                                                                            <td><a href="{{ url('/admin/orden/descarga') }}/{{ $pedimentoOrden->pedimento_digital }}" class="btn btn-link">Descargar</a></td>
                                                                        @else
                                                                            <td>No hay archivo</td>
                                                                        @endif
                                                                        <td>{{ $pedimentoOrden->aduana->nombre }}</td>
                                                                        <td>{{ $pedimentoOrden->agenteAduanal->nombre }}</td>
                                                                        <td>{{ $pedimentoOrden->tipo_cambio_pedimento }}</td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger-pedimento" data-id="{{ $pedimentoOrden->id }}"><i class="fa fa-remove"></i></button>
                                                                            <button type="button" class="btn btn-warning btn-xs actualizaPedimento" data-toggle="modal" data-target="#modal-actualiza-pedimento" data-id="{{ $pedimentoOrden->id }}"><i class="fa fa-pencil"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <br>
                                    <button type="submit" class="btn btn-success pull-right">Actualizar</button>
                                </div>
                            </div>
                        </form>
                        <!-- /. Formulario -->
                    </div>
                </section>
            </div>
        </section>
    </div>
    <!-- Modals -->
    @include('admin.ordenes.modals.modal_guarda')
    @include('admin.ordenes.modals.modal_eliminacion')
    @include('admin.ordenes.modals.modal_actualiza')
    <!-- Scripts -->
@section('javascript')
    <script>
        // Validacion form orden
        $(document).ready(function() {
            var countPedimento = 0;
            $('#form-orden').validate({
                event: "blur",rules: {
                    'id_orden' : "required",
                    'encargado' : "required",
                    'proveedor' : "required",
                    'fecha_inicio' : "required",
                    'almacen_llegada' : "required",
                    'tipoCompraSelect' : "required"
                },
                messages: {
                    'id_orden' : "El #OC es requerido",
                    'encargado' : "El Encargado es requerido",
                    'proveedor' : "El proveedor es requerido",
                    'fecha_inicio' : "La Fecha de inicio es requerida",
                    'almacen_llegada' : "El Almacen de llegada es requerido",
                    'tipoCompraSelect' : "Tipo de compra requerido"
                },
                debug: true,errorElement: "label",
                submitHandler: function(form){
                    // do other things for a valid form
                    form.submit();
                }
            });
        });

        // Guardado de nuevo proveedor
        $(document).ready(function(){
            $("#proveedor-form").validate({
                event: "blur",rules: {
                    'nombreProveedor': "required",
                    'correoProveedor': "required email",
                    'tlefonoProveedor': "required",
                    'nombreContactoProveedor': "required"
                },
                messages: {
                    'nombreProveedor': "El nombre es requerido",
                    'correoProveedor': "Indica una direcci&oacute;n de e-mail v&aacute;lida",
                    'tlefonoProveedor': "El telefono es reuerido",
                    'nombreContactoProveedor': "El nombre de contacto es requerido"
                },
                debug: true,errorElement: "label",
                submitHandler: function(form){
                    $.ajax({
                        type: "POST",
                        url: '{{route("proveedor.save")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            nombreProveedor: $('#nombreProveedor').val(),
                            nombreContactoProveedor: $('#nombreContactoProveedor').val(),
                            taxProveedor: $('#taxProveedor').val(),
                            direccionProveedor: $('#direccionProveedor').val(),
                            paisProveedor: $('#paisProveedor').val(),
                            tlefonoProveedor: $('#tlefonoProveedor').val(),
                            correoProveedor: $('#correoProveedor').val(),
                        },
                        success: function(msg){
                            document.getElementById("nombreProveedor").value="";
                            document.getElementById("nombreContactoProveedor").value="";
                            document.getElementById("taxProveedor").value="";
                            document.getElementById("direccionProveedor").value="";
                            document.getElementById("paisProveedor").value="";
                            document.getElementById("tlefonoProveedor").value="";
                            document.getElementById("correoProveedor").value="";
                            $("#nuevo-proveedor-modal").modal('hide');
                            $('#proveedor option').remove();
                            $.ajax({
                                url: "{{route('proveedores.index')}}",
                                dataType: "json",
                                success: function(data){
                                    $("#proveedor").append('<option value="">Selecciona</option>');
                                    $.each(data,function(key, registro) {
                                        $("#proveedor").append('<option value='+registro.id+'>'+registro.name+'</option>');
                                    });
                                },
                                error: function(data) {
                                    alert('error');
                                }
                            });
                        }
                    });
                }
            });
        });

        // Guardado de tipo de compra
        $(document).ready(function(){
            $("#tipo-compra-form").validate({
                event: "blur",rules: {
                    'tipoCompraNombre': "required",
                },
                messages: {
                    'tipoCompraNombre': "El tipo de compra es requerido",
                },
                debug: true,errorElement: "label",
                submitHandler: function(form){
                    $.ajax({
                        type: "POST",
                        url: '{{route("tipo_compra.save")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            tipoCompraNombre: $('#tipoCompraNombre').val(),
                        },
                        success: function(msg){
                            document.getElementById("tipoCompraNombre").value="";
                            $("#nuevo-tipo-compra").modal('hide');
                            $('#tipoCompraSelect option').remove();
                            $.ajax({
                                url: "{{route('tipo_compra.index')}}",
                                dataType: "json",
                                type:"GET",
                                success: function(data){
                                    $("#tipoCompraSelect").append('<option value="">Selecciona</option>');
                                    $.each(data,function(key, registro) {
                                        $("#tipoCompraSelect").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
                                    });
                                },
                                error: function(data) {
                                    alert('error');
                                }
                            });
                        }
                    });
                }
            });
        });
        //Elimina producto
        $(document).ready(function() {
            $('#modal-danger-productos').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteProducto').attr("href", "{{ url('/admin/elimina_producto') }}" + "/" + id);
            });
        });
        // Elimina gastos de origen
        $(document).ready(function() {
            $('#modal-danger-gastos-origen').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteGastoOrigen').attr("href", "{{ url('/admin/elimina_gasto_origen') }}" + "/" + id);
            });
        });
        // Elimina gastos destino
        $(document).ready(function() {
            $('#modal-gastos-destino').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteGastoDestino').attr("href", "{{ url('/admin/elimina_gasto_destino') }}" + "/" + id);
            });
        });
        // Elimina transito
        $(document).ready(function() {
            $('#modal-danger-transito').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteTransito').attr("href", "{{ url('/admin/elimina_transito') }}" + "/" + id);
            });
        });
        // Elimina pedimento
        $(document).ready(function() {
            $('#modal-danger-pedimento').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#deletePedimento').attr("href", "{{ url('/admin/elimina_pedimento') }}" + "/" + id);
            });
        });

        // Actualiza pedimento
        $('.actualizaPedimento').on('click',function(){
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/pedimento_consulta') }}/"+id,
                dataType: "json",
                type:"GET",
                success: function(data){
                    console.log(data);
                    document.getElementById("numero_pedimento_actualiza").value = data.pedimento;
                    document.getElementById("tipo_cambio_pedimento_pedimento_actualiza").value = data.tipo_cambio_pedimento;
                    document.getElementById("dta_pedimento_actualiza").value = data.dta;
                    document.getElementById("cnt_pedimento_actualiza").value = data.cnt;
                    document.getElementById("igi_pedimento_actualiza").value = data.igi;
                    document.getElementById("prv_pedimento_actualiza").value = data.prv;
                    document.getElementById("iva_pedimento_actualiza").value = data.iva;
                    document.getElementById("pedimento_id").value = data.id;
                    $("#aduana_pedimento_actualiza").val(data.aduana_id);
                    $("#agente_aduanal_pedimento_actualiza").val(data.agente_aduanal_id);
                },
                error: function(data) {
                    alert('error');
                }
            });
        });

        // Actualiza transito
        $('.actualizaTransito').on('click',function(){
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/transito_consulta') }}/"+id,
                dataType: "json",
                type:"GET",
                success: function(data){
                    console.log(data);
                    $("#metodo_transito_actualiza").val(data.metodo_id);
                    document.getElementById("guia_transito_actualiza").value = data.guia;
                    $("#forwarder_transito_actualiza").val(data.forwarder_id);
                    document.getElementById("fecha_embarque_transito_actualiza").value = data.fecha_embarque;
                    document.getElementById("fecha_tentativa_llegada_transito_atualiza").value = data.fecha_tentativa;
                    document.getElementById("comercial_invoce_transito_actualiza").value = data.comercual_invoce;
                    document.getElementById("cajas_transito_actualiza").value = data.cajas;
                    document.getElementById("cbm_transito_actualiza").value = data.cbm;
                    document.getElementById("peso_transito_actualiza").value = data.peso;
                    document.getElementById("transito_id").value = data.id;
                },
                error: function(data) {
                    alert('error');
                }
            });
        });

        // Actualiza gasto de origen
        $('.actualizaGastoOrigen').on('click',function(){
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/gasto_origen_consulta') }}/"+id,
                dataType: "json",
                type:"GET",
                success: function(data){
                    console.log(data);
                    $("#tipo_gasto_origen_actualiza").val(data.tipo_gasto_id);
                    document.getElementById("costo_gastos_origen_actualiza").value = data.costo;
                    document.getElementById("nota_gastos_origen_actualiza").value = data.notas;
                    document.getElementById("gasto_origen_id").value = data.id;
                },
                error: function(data) {
                    alert('error');
                }
            });
        });

        // Actualiza gasto destino
        $('.actualizaGastoDestino').on('click',function(){
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/gasto_destino_consulta') }}/"+id,
                dataType: "json",
                type:"GET",
                success: function(data){
                    console.log(data);
                    $("#tipo_gasto_gastos_destino_actualiza").val(data.tipo_gasto_destino_id);
                    document.getElementById("costo_gastos_destino_actualiza").value = data.costo;
                    document.getElementById("moneda_gastos_destino_actualiza").value = data.moneda;
                    document.getElementById("nota_gastos_destino_actualiza").value = data.notas;
                    document.getElementById("gasto_destino_id").value = data.id;
                },
                error: function(data) {
                    alert('error');
                }
            });
        });

        // Actualiza producto
        $('.productoActualiza').on('click',function(){
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/consulta_producto') }}/"+id,
                dataType: "json",
                type:"GET",
                success: function(data){
                    $('#productosSelectActualiza').val(data[0].sku);
                    $('#productosSelectActualiza').select2().trigger('change');
                    document.getElementById("producto_id_actualiza").value = data[0].producto_id;
                    $("#icoterm_producto_acualiza").val(data[0].incoterm);
                    document.getElementById("leadtime_producto_actualiza").value = data[0].leadtime;
                    document.getElementById("costo_producto_actualiza").value = data[0].costo;
                    document.getElementById("cantidad_producto_actualiza").value = data[0].cantidad;
                    document.getElementById("subtotal_producto_actualiza").value = data[0].total;
                    document.getElementById("producto_orden_id").value = data[0].id;
                },
                error: function(data) {
                    alert('error');
                }
            });
        });


        // Guardado nuevo producto en actualiza
        $(document).ready(function(){
            $("#nuevo-producto-actualiza-form").validate({
                event: "blur",rules: {
                    'sku_producto_nuevo' : "required",
                    'nombre_producto_nuevo' : "required",
                    'costo_producto_nuevo' : "required",
                    'precio_menudeo_producto_nuevo' : "required",
                    'sat_producto_nuevo' : "required",
                    'tipo_producto_nuevo' : "required"
                },
                messages: {
                    'sku_producto_nuevo' : "El SKU es requerido",
                    'nombre_producto_nuevo' : "El Nombre de producto es requerido",
                    'costo_producto_nuevo' : "El Costo de producto es requerido",
                    'precio_menudeo_producto_nuevo' : "El Precio venta al por menor es requerido",
                    'sat_producto_nuevo' : "EL Codigo SAT es requerido",
                    'tipo_producto_nuevo' : "El Tipo de producto es requerido"
                },
                debug: true,errorElement: "label",
                submitHandler: function(form){
                    $.ajax({
                        type: "POST",
                        url: '{{route("producto_base.save")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            sku_producto_nuevo : document.getElementById('sku_producto_nuevo').value,
                            nombre_producto_nuevo : document.getElementById('nombre_producto_nuevo').value,
                            costo_producto_nuevo : document.getElementById('costo_producto_nuevo').value,
                            precio_menudeo_producto_nuevo : document.getElementById('precio_menudeo_producto_nuevo').value,
                            sat_producto_nuevo : document.getElementById('sat_producto_nuevo').value,
                            tipo_producto_nuevo : $('#tipo_producto_nuevo').val(),
                            descripcion_producto_nuevo : document.getElementById('descripcion_producto_nuevo').value
                        },
                        success: function(data){
                            $('#productosSelectActualiza option').remove();
                            $('#nuevo-producto-actualiza-modal').modal('hide');
                            $.ajax({
                                url: "{{route('productos.select')}}",
                                dataType: "json",
                                type:"GET",
                                success: function(data){
                                    $("#productosSelectActualiza").append('<option value="">Selecciona</option>');
                                    $.each(data,function(key, registro) {
                                        $("#productosSelectActualiza").append('<option value='+registro.sku+'>'+registro.name+'</option>');
                                    });
                                    $("#nuevo-producto-actualiza-form")[0].reset();
                                },
                                error: function(data) {
                                    alert('error');
                                }
                            });
                        }
                    });
                }
            });
        });

        // Guardado nuevo producto en guarda
        $(document).ready(function(){
            $("#nuevo-producto-guarda-form").validate({
                event: "blur",rules: {
                    'sku_producto_nuevo' : "required",
                    'nombre_producto_nuevo' : "required",
                    'costo_producto_nuevo' : "required",
                    'precio_menudeo_producto_nuevo' : "required",
                    'sat_producto_nuevo' : "required",
                    'tipo_producto_nuevo' : "required"
                },
                messages: {
                    'sku_producto_nuevo' : "El SKU es requerido",
                    'nombre_producto_nuevo' : "El Nombre de producto es requerido",
                    'costo_producto_nuevo' : "El Costo de producto es requerido",
                    'precio_menudeo_producto_nuevo' : "El Precio venta al por menor es requerido",
                    'sat_producto_nuevo' : "EL Codigo SAT es requerido",
                    'tipo_producto_nuevo' : "El Tipo de producto es requerido"
                },
                debug: true,errorElement: "label",
                submitHandler: function(form){
                    $.ajax({
                        type: "POST",
                        url: '{{route("producto_base.save")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            sku_producto_nuevo : document.getElementById('sku_producto_nuevo').value,
                            nombre_producto_nuevo : document.getElementById('nombre_producto_nuevo').value,
                            costo_producto_nuevo : document.getElementById('costo_producto_nuevo').value,
                            precio_menudeo_producto_nuevo : document.getElementById('precio_menudeo_producto_nuevo').value,
                            sat_producto_nuevo : document.getElementById('sat_producto_nuevo').value,
                            tipo_producto_nuevo : $('#tipo_producto_nuevo').val(),
                            descripcion_producto_nuevo : document.getElementById('descripcion_producto_nuevo').value
                        },
                        success: function(data){
                            $('#productosSelectCrea option').remove();
                            $('#nuevo-producto-guarda-modal ').modal('hide');
                            $.ajax({
                                url: "{{route('productos.select')}}",
                                dataType: "json",
                                type:"GET",
                                success: function(data){
                                    $("#productosSelectCrea").append('<option value="">Selecciona</option>');
                                    $.each(data,function(key, registro) {
                                        $("#productosSelectCrea").append('<option value='+registro.sku+'>'+registro.name+'</option>');
                                    });
                                    $("#nuevo-producto-guarda-form")[0].reset();
                                },
                                error: function(data) {
                                    alert('error');
                                }
                            });
                        }
                    });
                }
            });
        });

    </script>
    <script src="{{asset('js/sistema/admin/orden_compra/orden_compra_actualiza.js')}}"></script>
@stop
@endsection