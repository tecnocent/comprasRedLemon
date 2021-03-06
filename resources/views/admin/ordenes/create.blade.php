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
            <h1 style="margin-top:-20px"> Nueva Orden de Compra<small> Creación</small> </h1>
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable compra-create">
                    <div class="">
                        <!-- Formulario -->
                        <form id="form-orden" role="form" method="POST" action="{{route('orden.save')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box box-primary" style="line-height: 2em;">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <div class="box-header with-border">
                                    <h3 class="box-title">Ingresa los datos para crear una orden de compra</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for=""># OC</label>
                                        <input type="text" class="form-control" id="id_orden" name="id_orden" placeholder="Ingresa el ID de OC">
                                        @if ($errors->has('id_orden'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('id_orden') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Encargado interno</label>
                                        <select class="form-control" name="encargado" id="encargado">
                                            <option value="">Selecciona</option>
                                            @foreach ($usuarios as $usuaio)
                                                <option value="{{ $usuaio->name }}">{{ $usuaio->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('encargado'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('encargado') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-5 formPrincipal">
                                        <label for="">Proveedor</label>
                                        <select id="proveedor" class="form-control" name="proveedor">
                                        </select>
                                        @if ($errors->has('proveedor'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('proveedor') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-1 formPrincipal">
                                        <label for="">&nbsp;</label>
                                        <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2" data-toggle="modal" data-target="#nuevo-proveedor-modal" id="nuevo_proveedor"><i class="fa fa-pencil-square-o"></i> </button>
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Fecha inicio</label>
                                        <input type="text" class="form-control pull-right datepicker" id="fecha_inicio" name="fecha_inicio">
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Almacen de llegada</label>
                                        <select class="form-control" name="almacen_llegada" id="almacen_llegada">
                                            <option value="">Selecciona</option>
                                            @foreach ($almacenes as $almacen)
                                                <option value="{{ $almacen->id }}">{{ $almacen->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('almacen_llegada'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('almacen_llegada') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-5 formPrincipal">
                                        <label for="">Tipo de compra</label>
                                        <select class="form-control" id="tipoCompraSelect" name="tipo_compra">
                                        </select>
                                        @if ($errors->has('tipo_compra'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('tipo_compra') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-1 formPrincipal">
                                        <label for="">&nbsp;</label>
                                        <button type="button" class="form-control btn btn-block btn-default pull-right col-sm-2" data-toggle="modal" data-target="#nuevo-tipo-compra" id="nuevo_tipo_compra"><i class="fa fa-pencil-square-o"></i> </button>
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Requerimiento</label>
                                        <select class="form-control" name="requerimiento" id="requerimiento">
                                            <option value="">Selecciona</option>
                                            <option value="normal"> Normal</option>
                                            <option value="urgente">Urgente</option>
                                        </select>
                                        @if ($errors->has('requerimiento'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('requerimiento') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for=""># CI</label>
                                        <input type="text" class="form-control" id="comercial_invoice" name="comercial_invoice"
                                               placeholder="Ingresa el ID de CI">
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for=""># OC</label>
                                        <input type="text" class="form-control" id="CBM" name="CBM"
                                               placeholder="Ingresa el CBM" >
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">Descripción</label>
                                        <textarea class="form-control" rows="3" placeholder="Ingresa la descripción" name="descripcion_oc" id="descripcion_oc"></textarea>
                                        @if ($errors->has('descripcion_oc'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('descripcion_oc') }}
                                            </span>
                                        @endif
                                    </div>

                                    <input type="hidden" class="form-control" id="status" name="status">
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
                                                <a href="#3b" data-toggle="tab">G. Destino</a>
                                            </li>
                                            <li>
                                                <a href="#2b" data-toggle="tab">G. Origen</a>
                                            </li>
                                            <li>
                                                <a href="#6b" data-toggle="tab">Transito</a>
                                            </li>
                                            <li>
                                                <a href="#7b" data-toggle="tab">Pedimento</a>
                                            </li>
                                            <li>
                                                <a href="#5b" data-toggle="tab">Pago</a>
                                            </li>
                                            <li>
                                                <a href="#8b" data-toggle="tab">Seg. Producto</a>
                                            </li>
                                            <li>
                                                <a href="#9b" data-toggle="tab">Caract. Producto</a>
                                            </li>
                                            <li>
                                                <a href="#10b" data-toggle="tab">Clasific. Aduanera</a>
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
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
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
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
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
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="4b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-diseno" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Agregar diseño</button>
                                                <div class="row" id="table4">
                                                    <div class="panel panel-default diseno-bajo" id="table-monto-default">
                                                        <div class="panel-body  table-responsive">
                                                            <table id="diseno" class="table table-striped table-bordered diseno-table" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>¿OEM?</th>
                                                                    <th>¿Instructivo?</th>
                                                                    <th>¿Empaque?</th>
                                                                    <th>Fecha aviso diseño</th>
                                                                    <th>Producto listo diseño</th>
                                                                    <th>Empaque listo diseño</th>
                                                                    <th>Instructivo listo diseño</th>
                                                                    <th>OEM autorizado por trafico</th>
                                                                    <th>Fecha autorizacion trafico</th>
                                                                    <th>Archivos Diseño</th>
                                                                    <th>Archivos Fabricante</th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="5b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pagos-modal" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Agregar pago</button>
                                                <div class="row montoPago" id="montoPago">
                                                    <div class="panel panel-default monto-ssss" id="table-monto-default">
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
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#transito-modal"><i class="fa fa-plus"></i> Agregar transito</button>
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
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane" id="7b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pedimento-modal"><i class="fa fa-plus"></i> Agregar pedimento</button>
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
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="8b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-seguimiento" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Nuevo seguimiento</button>
                                                <div class="row" id="table2">
                                                    <div class="panel panel-default monto-default">
                                                        <div class="panel-body">
                                                            <table id="seguimiento" class="table table-striped table-bordered seguimiento" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Preproducción</th>
                                                                    <th>Producción</th>
                                                                    <th>OEM 1</th>
                                                                    <th>OEM 2</th>
                                                                    <th>OEM 3</th>
                                                                    <th>Empaquetado</th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="9b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-caracteristica" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Nueva caracteristica</button>
                                                <div class="row" id="table2">
                                                    <div class="panel panel-default monto-default">
                                                        <div class="panel-body">
                                                            <table id="caracteristica" class="table table-striped table-bordered caracteristica" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Especificaciones de producto</th>
                                                                    <th>Especificaciones electricas</th>
                                                                    <th>Link Amazon</th>
                                                                    <th>Link Alibaba</th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="10b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-clasificacion" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Nueva Clasifiación</button>
                                                <div class="row" id="table2">
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="clasificacionRow" class="table table-striped table-bordered clasificacion" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Clasificación arancelaria</th>
                                                                    <th>NOM 1</th>
                                                                    <th>NOM 2</th>
                                                                    <th>NOM 3</th>
                                                                    <th>NOM 4</th>
                                                                </tr>
                                                                </thead>
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
                                    <button type="submit" class="btn btn-success pull-right" id="po_creada">Guardar como PO creada</button>
                                    <button type="submit" class="btn btn-primary pull-right" id="borrador" style="margin-right: 10px;">Guardar como borrador</button>
                                </div>
                            </div>
                        </form>
                        <!-- /. Formulario -->
                    </div>
                </section>
            </div>
        </section>
    </div>
    <!-- Modals-->
    @include('admin.ordenes.modals.modal_crea')
    @include('admin.ordenes.modals.modal_crea_nuevo_prducto')
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

            // Llenado de select proveedores
            $(document).ready(function() {
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
                                bank_account: $('#bank_account').val(),
                                bank_address: $('#bank_address').val(),
                                swift: $('#swift').val(),
                            },
                            success: function(msg){
                                document.getElementById("nombreProveedor").value="";
                                document.getElementById("nombreContactoProveedor").value="";
                                document.getElementById("taxProveedor").value="";
                                document.getElementById("direccionProveedor").value="";
                                document.getElementById("paisProveedor").value="";
                                document.getElementById("tlefonoProveedor").value="";
                                document.getElementById("correoProveedor").value="";
                                document.getElementById("bank_account").value="";
                                document.getElementById("bank_address").value="";
                                document.getElementById("swift").value="";
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

            // Select tipo de compra
            $(document).ready(function() {
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


            // Guardado nuevo producto
            $(document).ready(function(){
                $("#nuevo-producto-form").validate({
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
                                console.log(data);
                                $('#productosSelect option').remove();
                                $('#nuevo-producto-modal').modal('hide');
                                $.ajax({
                                    url: "{{route('productos.select')}}",
                                    dataType: "json",
                                    type:"GET",
                                    success: function(data){
                                        $("#productosSelect").append('<option value="">Selecciona</option>');
                                        $.each(data,function(key, registro) {
                                            $("#productosSelect").append('<option value='+registro.sku+'>'+registro.name+'</option>');
                                        });
                                        $("#nuevo-producto-form")[0].reset();
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
        <script src="{{asset('js/sistema/admin/orden_compra/orden_compra.js')}}"></script>
    @stop
@endsection