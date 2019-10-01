@extends('layouts.app')

@section('content')
    <style>
        .select2-selection {
            height: 32px !important;
        }

        .diseno {
            font-size: 10px;
        }

        .formPrincipal {
            height: 68px;
        }

        .compra-create, .content-create-orden {
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
            <h1 style="margin-top:-20px"> Orden de Compra
                <small> Edición</small>
            </h1>
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable compra-create">
                    <div class="">
                        <!-- Formulario -->
                        <form id="form-orden" role="form" method="POST"
                              action="{{route('orden.update', ['id' => $orden->id])}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box box-primary" style="line-height: 2em;">
                                <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                <div class="box-header with-border">
                                    <h3 class="box-title">Ingresa los datos para la edición</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for=""># OC</label>
                                        <input type="text" class="form-control" id="id_orden" name="id_orden"
                                               placeholder="Ingresa el ID de OC" value="{{ $orden->identificador }}"
                                               disabled>
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Estatus</label>
                                        <select class="form-control" name="estatus" id="estatus">
                                            <option value="">Selecciona</option>
                                            <option value="borrador" {{ ( $orden->status == "borrador") ? 'selected' : '' }}>
                                                Borrador
                                            </option>
                                            <option value="po creada" {{ ( $orden->status == "po creada") ? 'selected' : '' }}>
                                                Po Creada
                                            </option>
                                            <option value="pi pedido" {{ ( $orden->status == "pi pedido") ? 'selected' : '' }}>
                                                Pi Pedido
                                            </option>
                                            <option value="por autorizar" {{ ( $orden->status == "por autoriza") ? 'selected' : '' }}>
                                                Por Autorizar
                                            </option>
                                            <option value="produccion" {{ ( $orden->status == "produccion") ? 'selected' : '' }}>
                                                Produccion
                                            </option>
                                            <option value="enviado" {{ ( $orden->status == "enviado") ? 'selected' : '' }}>
                                                Enviado
                                            </option>
                                            <option value="aduana" {{ ( $orden->status == "aduana") ? 'selected' : '' }}>
                                                Aduana
                                            </option>
                                            <option value="recepcion" {{ ( $orden->status == "recepcion") ? 'selected' : '' }}>
                                                Recepcion
                                            </option>
                                            <option value="cancelado" {{ ( $orden->status == "cancelado") ? 'selected' : '' }}>
                                                Cancelado
                                            </option>
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
                                        <button type="button"
                                                class="form-control btn btn-block btn-default pull-right col-sm-2"
                                                data-toggle="modal" data-target="#nuevo-proveedor-modal" name="nuevo_proveedor"
                                                id="nuevo_proveedor"><i class="fa fa-pencil-square-o"></i></button>
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Fecha inicio</label>
                                        <input type="text" class="form-control pull-right datepicker" id="fecha_inicio"
                                               name="fecha_inicio" value="{{ $orden->fecha_inicio }}">
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
                                        <button type="button"
                                                class="form-control btn btn-block btn-default pull-right col-sm-2"
                                                data-toggle="modal" data-target="#nuevo-tipo-compra"
                                                id="nuevo_tipo_compra"><i class="fa fa-pencil-square-o"></i></button>
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Requerimiento</label>
                                        <select class="form-control" name="requerimiento" id="requerimiento">
                                            <option value="">Selecciona</option>
                                            <option value="normal" {{ ( "normal" == $orden->requerimiento) ? 'selected' : '' }}>
                                                Normal
                                            </option>
                                            <option value="urgente" {{ ( "irgente" == $orden->requerimiento) ? 'selected' : '' }}>
                                                Urgente
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">Descripción</label>
                                        <textarea class="form-control" rows="3" placeholder="Ingresa la descripción"
                                                  name="descripcion_oc"
                                                  id="descripcion_oc">{{ $orden->descripcion ?? null }}</textarea>
                                    </div>
                                    <br>
                                    <div id="exTab3" class="form-group col-sm-12">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#1b" data-toggle="tab">Productos</a>
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
                                                <button type="button" id="agregarProductoButton"
                                                        class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#myModal2" style="margin-bottom: 7px;"><i
                                                            class="fa fa-plus"></i> Agregar producto
                                                </button>
                                                <input type="hidden" id="auxStatusOrden" value="{{$orden->status}}">
                                                <p class="text-danger" id="agregarProductoInfo">No puedes agregar
                                                    productos, la orden está en status {{$orden->status}}</p>
                                                <div class="row" id="table2">
                                                    <div class="panel panel-default monto-default" id="aaa">
                                                        <div class="panel-body">
                                                            <table id=""
                                                                   class="table table-striped table-bordered productos"
                                                                   cellspacing="0" width="100%">
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
                                                                        <td>{{ $productoOrden->producto->name }}
                                                                            @if ($productoOrden->variant)
                                                                                - {{ $productoOrden->variant}}
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $productoOrden->cantidad }}</td>
                                                                        <td>{{ $productoOrden->costo }}</td>
                                                                        <td>{{ $productoOrden->total }}</td>
                                                                        <td>{{ $productoOrden->incoterm }}</td>
                                                                        <td>{{ $productoOrden->leadtime }}</td>
                                                                        <td>
                                                                            <button type="button"
                                                                                    id="eliminarProducto"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-productos"
                                                                                    data-id="{{ $productoOrden->id }}">
                                                                                <i class="fa fa-remove"></i></button>
                                                                            <button type="button"
                                                                                    id="editarProducto"
                                                                                    class="btn btn-warning btn-xs productoActualiza"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-producto"
                                                                                    data-id="{{ $productoOrden->id }}">
                                                                                <i class="fa fa-pencil"></i></button>
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
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#myModal3" style="margin-bottom: 7px;"><i
                                                            class="fa fa-plus"></i> Nuevo gasto de origen
                                                </button>
                                                <div class="row" id="table2">
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="gastosOrigen"
                                                                   class="table table-striped table-bordered gastosOrigen"
                                                                   cellspacing="0" width="100%">
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
                                                                        <td>
                                                                            <a href="{{ url('/admin/orden/descarga') }}/{{$gastoOrigenOrden->comprobante}}"
                                                                               class="btn btn-link">Descargar</a></td>
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-gastos-origen"
                                                                                    data-id="{{ $gastoOrigenOrden->id }}">
                                                                                <i class="fa fa-remove"></i></button>
                                                                            <button type="button"
                                                                                    class="btn btn-warning btn-xs actualizaGastoOrigen"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-gasto-origen"
                                                                                    data-id="{{ $gastoOrigenOrden->id }}">
                                                                                <i class="fa fa-pencil"></i></button>
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
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#myModal4" style="margin-bottom: 7px;"><i
                                                            class="fa fa-plus"></i> Nuevo gasto de destino
                                                </button>
                                                <div class="row" id="table3">
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="gastosDestino"
                                                                   class="table table-striped table-bordered gastosDestino"
                                                                   cellspacing="0" width="100%">
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
                                                                            <td>
                                                                                <a href="{{ url('/admin/orden/descarga') }}/{{$gastoDestinoOrden->comprobante}}"
                                                                                   class="btn btn-link">Descargar</a>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button"
                                                                                        class="btn btn-danger btn-xs"
                                                                                        data-toggle="modal"
                                                                                        data-target="#modal-gastos-destino"
                                                                                        data-id="{{ $gastoDestinoOrden->id }}">
                                                                                    <i class="fa fa-remove"></i>
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-warning btn-xs actualizaGastoDestino"
                                                                                        data-toggle="modal"
                                                                                        data-target="#modal-actualiza-gasto-destino"
                                                                                        data-id="{{ $gastoDestinoOrden->id }}">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                </button>
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
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#nuevo-diseno-producto"
                                                        style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Agregar
                                                    diseño
                                                </button>
                                                <div class="row" id="table4">
                                                    <div class="panel panel-default diseno-bajo"
                                                         id="table-monto-default">
                                                        <div class="panel-body table-responsive">
                                                            <table id="diseno"
                                                                   class="table table-striped table-bordered"
                                                                   cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>SKU</th>
                                                                    <th>Producto</th>
                                                                    <th>¿OEM?</th>
                                                                    <th>¿Instructivo?</th>
                                                                    <th>¿Empaque?</th>
                                                                    <th>Status OEM diseño</th>
                                                                    <th>Fecha aviso diseño</th>
                                                                    <th>Producto listo diseño</th>
                                                                    <th>Empaque listo diseño</th>
                                                                    <th>Instructivo listo diseño</th>
                                                                    <th>OEM autorizado por trafico</th>
                                                                    <th>Fecha autorizacion trafico</th>
                                                                    <th>Archivos Diseño</th>
                                                                    <th>Archivos Fabricante</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($disenos as $diseno)
                                                                    <tr>
                                                                        <td>{{ $diseno->producto->sku }}</td>
                                                                        <td>{{ $diseno->producto->name }}</td>
                                                                        <td>{{ ($diseno->oem == true) ? 'SI' : 'NO'  }}</td>
                                                                        <td>{{ ($diseno->instructivo == true) ? 'SI' : 'NO'  }}</td>
                                                                        <td>{{ ($diseno->empaque == true) ? 'SI' : 'NO'  }}</td>
                                                                        <td>{{ $diseno->status_oem_diseno }}</td>
                                                                        <td>{{ $diseno->fecha_aviso_diseno }}</td>
                                                                        @if($diseno->producto_diseno)
                                                                            <td>
                                                                                <a href="{{ url('/admin/orden/descarga') }}/{{ $diseno->producto_diseno }}"
                                                                                   class="btn btn-link">Descargar</a>
                                                                            </td>
                                                                        @else
                                                                            <td>No hay archivo</td>
                                                                        @endif
                                                                        @if($diseno->empaque_diseno)
                                                                            <td>
                                                                                <a href="{{ url('/admin/orden/descarga') }}/{{ $diseno->empaque_diseno }}"
                                                                                   class="btn btn-link">Descargar</a>
                                                                            </td>
                                                                        @else
                                                                            <td>No hay archivo</td>
                                                                        @endif
                                                                        @if($diseno->instructivo_diseno)
                                                                            <td>
                                                                                <a href="{{ url('/admin/orden/descarga') }}/{{ $diseno->instructivo_diseno }}"
                                                                                   class="btn btn-link">Descargar</a>
                                                                            </td>
                                                                        @else
                                                                            <td>No hay archivo</td>
                                                                        @endif
                                                                        @if($diseno->oem_autorizado_trafico)
                                                                            <td>
                                                                                <a href="{{ url('/admin/orden/descarga') }}/{{ $diseno->oem_autorizado_trafico }}"
                                                                                   class="btn btn-link">Descargar</a>
                                                                            </td>
                                                                        @else
                                                                            <td>No hay archivo</td>
                                                                        @endif
                                                                        <td>{{ $diseno->fecha_autorizacion_trafico }}</td>
                                                                        @if($diseno->archivos_fabricante)
                                                                            <td>
                                                                                <?php
                                                                                foreach (json_decode($diseno->archivos_fabricante) as $fileFab => $key) {
                                                                                    echo '<a href="' . url("/admin/orden/descarga") . '/' . $key . '" class="btn btn-link">Descargar</a>';
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        @else
                                                                            <td>No hay archivo</td>
                                                                        @endif
                                                                        @if($diseno->archivos_diseno)
                                                                            <td>
                                                                                <?php
                                                                                foreach (json_decode($diseno->archivos_diseno) as $fileDiseno => $key) {
                                                                                    echo '<a href="' . url("/admin/orden/descarga") . '/' . $key . '" class="btn btn-link">Descargar</a>';
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        @else
                                                                            <td>No hay archivo</td>
                                                                        @endif
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-diseno"
                                                                                    data-id="{{ $diseno->id }}"><i
                                                                                        class="fa fa-remove"></i>
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-warning btn-xs actualizaDiseno"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-diseno"
                                                                                    data-id="{{ $diseno->id }}"><i
                                                                                        class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="5b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#nuevo-pago-guarda-modal"
                                                        style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Agregar
                                                    pago
                                                </button>
                                                <div class="row montoPago" id="montoPago">
                                                    <div class="panel panel-default monto-ssss"
                                                         id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="pagos"
                                                                   class="table table-striped table-bordered pagos"
                                                                   cellspacing="0" width="100%">
                                                                {{--<thead>--}}
                                                                {{--<tr>--}}
                                                                {{--<th>Pago $</th>--}}
                                                                {{--<th>Tipo de cambio</th>--}}
                                                                {{--<th>Comprobante</th>--}}
                                                                {{--<th>Acciones</th>--}}
                                                                {{--</tr>--}}
                                                                {{--</thead>--}}
                                                                <thead>
                                                                <tr>
                                                                    <th>Fecha de pago</th>
                                                                    <th>Referencia</th>
                                                                    <th>Moneda</th>
                                                                    <th>Tipo de cambio</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                @foreach($pagos as $pago)
                                                                    {{--<tr>--}}
                                                                    {{--<td>{{ $pago->pago }}</td>--}}
                                                                    {{--<td>{{ $pago->pago }}</td>--}}
                                                                    {{--<td>{{ $pago->tipo_cambio_pago }}</td>--}}
                                                                    {{--@if($pago->comrpobante)--}}
                                                                    {{--<td><a href="{{ url('/admin/orden/descarga') }}/{{ $pago->comrpobante }}" class="btn btn-link">Descargar</a></td>--}}
                                                                    {{--@else--}}
                                                                    {{--<td>No hay documento</td>--}}
                                                                    {{--@endif--}}
                                                                    {{--<td>--}}
                                                                    {{--<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger-pago" data-id="{{ $pago->id }}"><i class="fa fa-remove"></i></button>--}}
                                                                    {{--<button type="button" class="btn btn-warning btn-xs actualizaPago" data-toggle="modal" data-target="#modal-actualiza-pago" data-id="{{ $pago->id }}"><i class="fa fa-pencil"></i></button>--}}
                                                                    {{--</td>--}}
                                                                    {{--</tr>--}}
                                                                    <tr>
                                                                        <td>{{ $pago->fecha_pago }}</td>
                                                                        <td>{{ $pago->referencia }}</td>
                                                                        <td>{{ $pago->currency->code }}</td>
                                                                        <td>{{ $pago->tipo_cambio_pago }}</td>
                                                                        <td>{{ $pago->pago }}</td>
                                                                        {{--@if($pago->comrpobante)--}}
                                                                        {{--<td><a href="{{ url('/admin/orden/descarga') }}/{{ $pago->comrpobante }}" class="btn btn-link">Descargar</a></td>--}}
                                                                        {{--@else--}}
                                                                        {{--<td>No hay documento</td>--}}
                                                                        {{--@endif--}}
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-pago"
                                                                                    data-id="{{ $pago->id }}"><i
                                                                                        class="fa fa-remove"></i>
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-warning btn-xs actualizaPago"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-pago"
                                                                                    data-id="{{ $pago->id }}"><i
                                                                                        class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row montoPago" id="montoPago">
                                                    <div class="panel panel-default monto-ssss"
                                                         id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="pagos"
                                                                   class="table table-striped table-bordered pagos"
                                                                   cellspacing="0" width="100%">
                                                                <thead>
                                                                <th></th>
                                                                <th>Total</th>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <th>Productos Orden</th>
                                                                    <td>{{$total_productos_orden}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Gastos en Origen</th>
                                                                    <td>{{$total_gastos_origen}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total de la Orden</th>
                                                                    <td>{{$total_orden}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total Pagado</th>
                                                                    <td>{{$total_pagado}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Por Pagar</th>
                                                                    <td>{{$total_por_pagar}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="6b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#transito-modal"><i class="fa fa-plus"></i> Agregar
                                                    transito
                                                </button>
                                                <div class="row" id="table4"><br>
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="transito"
                                                                   class="table table-striped table-bordered transito"
                                                                   cellspacing="0" width="100%">
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
                                                                        <td>
                                                                            <a href="{{ url('/admin/orden/descarga') }}/{{$transitoOrden->comercial_invoce_file}}"
                                                                               class="btn btn-link">Descargar</a></td>
                                                                        <td>{{ $transitoOrden->fecha_embarque }}</td>
                                                                        <td>{{ $transitoOrden->fecha_tentativa }}</td>
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-transito"
                                                                                    data-id="{{ $transitoOrden->id }}">
                                                                                <i class="fa fa-remove"></i></button>
                                                                            <button type="button"
                                                                                    class="btn btn-warning btn-xs actualizaTransito"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-transito"
                                                                                    data-id="{{ $transitoOrden->id }}">
                                                                                <i class="fa fa-pencil"></i></button>
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
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#pedimento-modal"><i class="fa fa-plus"></i>
                                                    Agregar pedimento
                                                </button>
                                                <div class="row" id="pedimento"><br>
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="pedimento"
                                                                   class="table table-striped table-bordered pedimento"
                                                                   cellspacing="0" width="100%">
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
                                                                            <td>
                                                                                <a href="{{ url('/admin/orden/descarga') }}/{{ $pedimentoOrden->pedimento_digital }}"
                                                                                   class="btn btn-link">Descargar</a>
                                                                            </td>
                                                                        @else
                                                                            <td>No hay archivo</td>
                                                                        @endif
                                                                        <td>{{ $pedimentoOrden->aduana->nombre }}</td>
                                                                        <td>{{ $pedimentoOrden->agenteAduanal->nombre }}</td>
                                                                        <td>{{ $pedimentoOrden->tipo_cambio_pedimento }}</td>
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-pedimento"
                                                                                    data-id="{{ $pedimentoOrden->id }}">
                                                                                <i class="fa fa-remove"></i></button>
                                                                            <button type="button"
                                                                                    class="btn btn-warning btn-xs actualizaPago"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-pedimento"
                                                                                    data-id="{{ $pedimentoOrden->id }}">
                                                                                <i class="fa fa-pencil"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="8b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#seguimiento-producto-modal"><i
                                                            class="fa fa-plus"></i> Agregar seguimiento
                                                </button>
                                                <div class="row" id="pedimento"><br>
                                                    <div class="panel panel-default" id="table-monto-default">
                                                        <div class="panel-body">
                                                            <table id="seguimiento"
                                                                   class="table table-striped table-bordered seguimiento"
                                                                   cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Sku</th>
                                                                    <th>Producto</th>
                                                                    <th>Preproducción</th>
                                                                    <th>Producción</th>
                                                                    <th>OEM 1</th>
                                                                    <th>OEM 2</th>
                                                                    <th>OEM 3</th>
                                                                    <th>Empaquetado</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                @foreach($seguimientos as $seguimiento)
                                                                    <tr>
                                                                        <td>{{ $seguimiento->productoOrden->sku }}</td>
                                                                        <td>{{ $seguimiento->productoOrden->name }}</td>
                                                                        @if($seguimiento->foto_preproduccion)
                                                                            <td>
                                                                                <img class="imgZoom"
                                                                                     src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_preproduccion}}"
                                                                                     alt="produccion" height="70"
                                                                                     width="70">
                                                                            </td>
                                                                        @else
                                                                            <td>No hay foto</td>
                                                                        @endif
                                                                        @if($seguimiento->foto_produccion)
                                                                            <td>
                                                                                <img class="imgZoom"
                                                                                     src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_produccion}}"
                                                                                     alt="produccion" height="70"
                                                                                     width="70">
                                                                            </td>
                                                                        @else
                                                                            <td>No hay foto</td>
                                                                        @endif
                                                                        @if($seguimiento->foto_oem_uno)
                                                                            <td>
                                                                                <img class="imgZoom"
                                                                                     src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_oem_uno}}"
                                                                                     alt="produccion" height="70"
                                                                                     width="70">
                                                                            </td>
                                                                        @else
                                                                            <td>No hay foto</td>
                                                                        @endif
                                                                        @if($seguimiento->foto_oem_dos)
                                                                            <td>
                                                                                <img class="imgZoom"
                                                                                     src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_oem_dos}}"
                                                                                     alt="produccion" height="70"
                                                                                     width="70">
                                                                            </td>
                                                                        @else
                                                                            <td>No hay foto</td>
                                                                        @endif
                                                                        @if($seguimiento->foto_oem_tres)
                                                                            <td>
                                                                                <img class="imgZoom"
                                                                                     src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_oem_tres}}"
                                                                                     alt="produccion" height="70"
                                                                                     width="70">
                                                                            </td>
                                                                        @else
                                                                            <td>No hay foto</td>
                                                                        @endif
                                                                        @if($seguimiento->foto_empaquetado)
                                                                            <td>
                                                                                <img class="imgZoom"
                                                                                     src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_empaquetado}}"
                                                                                     alt="produccion" height="70"
                                                                                     width="70">
                                                                            </td>
                                                                        @else
                                                                            <td>No hay foto</td>
                                                                        @endif
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-seguimiento"
                                                                                    data-id="{{ $seguimiento->id }}"><i
                                                                                        class="fa fa-remove"></i>
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-warning btn-xs actualizaSeguimiento"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-seguimiento"
                                                                                    data-id="{{ $seguimiento->id }}"><i
                                                                                        class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="9b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#caracteristica-producto-modal"><i
                                                            class="fa fa-plus"></i> Agregar caracteristica
                                                </button>
                                                <div class="row" id=""><br>
                                                    <div class="panel panel-default" id="table-default">
                                                        <div class="panel-body">
                                                            <table id="caracteristica"
                                                                   class="table table-striped table-bordered caracteristica"
                                                                   cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Sku</th>
                                                                    <th>Producto</th>
                                                                    <th>Especificaciones del producto</th>
                                                                    <th>Especificaciones electricas</th>
                                                                    <th>Link amazon</th>
                                                                    <th>Link alibaba</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                @foreach($caracteristicas as $caracteristica)
                                                                    <tr>
                                                                        <td>{{ $caracteristica->producto->sku }}</td>
                                                                        <td>{{ $caracteristica->producto->name }}</td>
                                                                        <td>{{ $caracteristica->especificaciones_producto }}</td>
                                                                        <td>{{ $caracteristica->especificaciones_electricas }}</td>
                                                                        <td>
                                                                            @if ($caracteristica->link_amazon)
                                                                                <a href="{{ $caracteristica->link_amazon }}"
                                                                                   class="btn btn-link" target="_blank">Link
                                                                                    Amazon</a>
                                                                            @else
                                                                                No hay link
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($caracteristica->link_alibaba)
                                                                                <a href="{{ $caracteristica->link_alibaba }}"
                                                                                   class="btn btn-link" target="_blank">Link
                                                                                    Alibaba</a>
                                                                            @else
                                                                                No hay link
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-caracteristica"
                                                                                    data-id="{{ $caracteristica->id }}">
                                                                                <i class="fa fa-remove"></i></button>
                                                                            <button type="button"
                                                                                    class="btn btn-warning btn-xs actualizaCaracteristica"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-caracteristica"
                                                                                    data-id="{{ $caracteristica->id }}">
                                                                                <i class="fa fa-pencil"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="10b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#guarda-clasificacion-modal"><i
                                                            class="fa fa-plus"></i> Agregar clasificación
                                                </button>
                                                <div class="row" id=""><br>
                                                    <div class="panel panel-default" id="table-default">
                                                        <div class="panel-body">
                                                            <table id="clasificacion"
                                                                   class="table table-striped table-bordered clasificacion"
                                                                   cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Sku</th>
                                                                    <th>Producto</th>
                                                                    <th>Clasificación arancelaria</th>
                                                                    <th>NOM 1</th>
                                                                    <th>NOM 2</th>
                                                                    <th>NOM 3</th>
                                                                    <th>NOM 4</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                @foreach($clasificaciones as $clasificacion)
                                                                    <tr>
                                                                        <td>{{ $clasificacion->producto->sku }}</td>
                                                                        <td>{{ $clasificacion->producto->name }}</td>
                                                                        <td>{{ $clasificacion->clasificacion_arancelaria }}</td>
                                                                        <td>{{ $clasificacion->nom_1 }}</td>
                                                                        <td>{{ $clasificacion->nom_2 }}</td>
                                                                        <td>{{ $clasificacion->nom_3 }}</td>
                                                                        <td>{{ $clasificacion->nom_4 }}</td>
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="btn btn-danger btn-xs"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-danger-clasificacion"
                                                                                    data-id="{{ $clasificacion->id }}">
                                                                                <i class="fa fa-remove"></i></button>
                                                                            <button type="button"
                                                                                    class="btn btn-warning btn-xs actualizaClasificacion"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-actualiza-clasificacion"
                                                                                    data-id="{{ $clasificacion->id }}">
                                                                                <i class="fa fa-pencil"></i></button>
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
        $(document).ready(function () {
            var countPedimento = 0;
            $('#form-orden').validate({
                event: "blur", rules: {
                    'id_orden': "required",
                    'encargado': "required",
                    'proveedor': "required",
                    'fecha_inicio': "required",
                    'almacen_llegada': "required",
                    'tipoCompraSelect': "required"
                },
                messages: {
                    'id_orden': "El #OC es requerido",
                    'encargado': "El Encargado es requerido",
                    'proveedor': "El proveedor es requerido",
                    'fecha_inicio': "La Fecha de inicio es requerida",
                    'almacen_llegada': "El Almacen de llegada es requerido",
                    'tipoCompraSelect': "Tipo de compra requerido"
                },
                debug: true, errorElement: "label",
                submitHandler: function (form) {
                    // do other things for a valid form
                    form.submit();
                }
            });
        });

        // Guardado de nuevo proveedor
        $(document).ready(function () {
            $("#proveedor-form").validate({
                event: "blur", rules: {
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
                debug: true, errorElement: "label",
                submitHandler: function (form) {
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
                        success: function (msg) {
                            document.getElementById("nombreProveedor").value = "";
                            document.getElementById("nombreContactoProveedor").value = "";
                            document.getElementById("taxProveedor").value = "";
                            document.getElementById("direccionProveedor").value = "";
                            document.getElementById("paisProveedor").value = "";
                            document.getElementById("tlefonoProveedor").value = "";
                            document.getElementById("correoProveedor").value = "";
                            $("#nuevo-proveedor-modal").modal('hide');
                            $('#proveedor option').remove();
                            $.ajax({
                                url: "{{route('proveedores.index')}}",
                                dataType: "json",
                                success: function (data) {
                                    $("#proveedor").append('<option value="">Selecciona</option>');
                                    $.each(data, function (key, registro) {
                                        $("#proveedor").append('<option value=' + registro.id + '>' + registro.name + '</option>');
                                    });
                                },
                                error: function (data) {
                                    alert('error');
                                }
                            });
                        }
                    });
                }
            });
        });

        // Guardado de tipo de compra
        $(document).ready(function () {
            $("#tipo-compra-form").validate({
                event: "blur", rules: {
                    'tipoCompraNombre': "required",
                },
                messages: {
                    'tipoCompraNombre': "El tipo de compra es requerido",
                },
                debug: true, errorElement: "label",
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: '{{route("tipo_compra.save")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            tipoCompraNombre: $('#tipoCompraNombre').val(),
                        },
                        success: function (msg) {
                            document.getElementById("tipoCompraNombre").value = "";
                            $("#nuevo-tipo-compra").modal('hide');
                            $('#tipoCompraSelect option').remove();
                            $.ajax({
                                url: "{{route('tipo_compra.index')}}",
                                dataType: "json",
                                type: "GET",
                                success: function (data) {
                                    $("#tipoCompraSelect").append('<option value="">Selecciona</option>');
                                    $.each(data, function (key, registro) {
                                        $("#tipoCompraSelect").append('<option value=' + registro.id + '>' + registro.nombre + '</option>');
                                    });
                                },
                                error: function (data) {
                                    alert('error');
                                }
                            });
                        }
                    });
                }
            });
        });
        //Elimina producto
        $(document).ready(function () {
            $('#modal-danger-productos').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteProducto').attr("href", "{{ url('/admin/elimina_producto') }}" + "/" + id);
            });
        });
        // Elimina gastos de origen
        $(document).ready(function () {
            $('#modal-danger-gastos-origen').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteGastoOrigen').attr("href", "{{ url('/admin/elimina_gasto_origen') }}" + "/" + id);
            });
        });
        // Elimina gastos destino
        $(document).ready(function () {
            $('#modal-gastos-destino').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteGastoDestino').attr("href", "{{ url('/admin/elimina_gasto_destino') }}" + "/" + id);
            });
        });
        // Elimina transito
        $(document).ready(function () {
            $('#modal-danger-transito').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteTransito').attr("href", "{{ url('/admin/elimina_transito') }}" + "/" + id);
            });
        });
        // Elimina pedimento
        $(document).ready(function () {
            $('#modal-danger-pedimento').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deletePedimento').attr("href", "{{ url('/admin/elimina_pedimento') }}" + "/" + id);
            });
        });
        // Elimina pago
        $(document).ready(function () {
            $('#modal-danger-pago').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deletePago').attr("href", "{{ url('/admin/elimina_pago') }}" + "/" + id);
            });
        });
        // Elimina seguimiento
        $(document).ready(function () {
            $('#modal-danger-seguimiento').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteSeguimiento').attr("href", "{{ url('/admin/elimina_seguimiento') }}" + "/" + id);
            });
        });
        // Elimina caracteristica
        $(document).ready(function () {
            $('#modal-danger-caracteristica').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteCaracteristica').attr("href", "{{ url('/admin/elimina_caracteristica') }}" + "/" + id);
            });
        });
        // Elimina clasificacion
        $(document).ready(function () {
            $('#modal-danger-clasificacion').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteClasificacion').attr("href", "{{ url('/admin/elimina_clasificacion') }}" + "/" + id);
            });
        });
        // Elimina diseño
        $(document).ready(function () {
            $('#modal-danger-diseno').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteDiseno').attr("href", "{{ url('/admin/elimina_diseno') }}" + "/" + id);
            });
        });

        // Actualiza pedimento
        $('.actualizaPedimento').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/pedimento_consulta') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
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
                error: function (data) {
                    alert('error');
                }
            });
        });

        // Actualiza transito
        $('.actualizaTransito').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/transito_consulta') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
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
                error: function (data) {
                    alert('error');
                }
            });
        });

        // Actualiza gasto de origen
        $('.actualizaGastoOrigen').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/gasto_origen_consulta') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $("#tipo_gasto_origen_actualiza").val(data.tipo_gasto_id);
                    document.getElementById("costo_gastos_origen_actualiza").value = data.costo;
                    document.getElementById("nota_gastos_origen_actualiza").value = data.notas;
                    document.getElementById("gasto_origen_id").value = data.id;
                },
                error: function (data) {
                    alert('error');
                }
            });
        });

        // Actualiza gasto destino
        $('.actualizaGastoDestino').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/gasto_destino_consulta') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $("#tipo_gasto_gastos_destino_actualiza").val(data.tipo_gasto_destino_id);
                    document.getElementById("costo_gastos_destino_actualiza").value = data.costo;
                    document.getElementById("moneda_gastos_destino_actualiza").value = data.moneda;
                    document.getElementById("nota_gastos_destino_actualiza").value = data.notas;
                    document.getElementById("gasto_destino_id").value = data.id;
                },
                error: function (data) {
                    alert('error');
                }
            });
        });

        // Actualiza producto
        $('.productoActualiza').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/consulta_producto') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    document.getElementById("producto_id_actualiza").value = data[0].producto_id;
                    $("#icoterm_producto_acualiza").val(data[0].incoterm);
                    $("#product_variant_id_acualiza").val(data[0].product_variant_id);
                    document.getElementById("leadtime_producto_actualiza").value = data[0].leadtime;
                    document.getElementById("costo_producto_actualiza").value = data[0].costo;
                    document.getElementById("cantidad_producto_actualiza").value = data[0].cantidad;
                    document.getElementById("subtotal_producto_actualiza").value = data[0].total;
                    document.getElementById("producto_orden_id").value = data[0].id;

                    $('#productosSelectActualiza').val(data[0].sku);
                    $('#productosSelectActualiza').select2().trigger('change');
                },
                error: function (data) {
                    alert('error');
                }
            });
        });

        // Actualiza pago
        $('.actualizaPago').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/pago_consulta') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    document.getElementById('pago_pagos_actualiza').value = data.pago;
                    document.getElementById('tipo_cambio_pago_orden_actualiza').value = data.tipo_cambio_pago;
                    document.getElementById('pago_pagos_id_actualiza').value = data.id;
                },
                error: function (data) {
                    alert('error');
                }
            });
        });

        // Actualiza seguimiento
        $('.actualizaSeguimiento').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/consulta_seguimiento') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $("#producto_seguimiento_id").val(data.producto_orden_id);
                    $("#seguimiento_id").val(data.id);
                    $("#foto-preproduccion").attr("src", "{{asset('documents/orden_compra/images/')}}/" + data.foto_preproduccion);
                    $("#input-preproduccion").change(function () {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#foto-preproduccion-seleccionada').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                    $("#foto-produccion").attr("src", "{{asset('documents/orden_compra/images/')}}/" + data.foto_produccion);
                    $("#input-produccion").change(function () {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#foto-produccion-seleccionada').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                    $("#foto-oem_uno").attr("src", "{{asset('documents/orden_compra/images/')}}/" + data.foto_oem_uno);
                    $("#input-oem_uno").change(function () {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#foto-oem_uno-seleccionada').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                    $("#foto-oem_dos").attr("src", "{{asset('documents/orden_compra/images/')}}/" + data.foto_oem_dos);
                    $("#input-oem_dos").change(function () {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#foto-oem_dos-seleccionada').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                    $("#foto-oem_tres").attr("src", "{{asset('documents/orden_compra/images/')}}/" + data.foto_oem_tres);
                    $("#input-oem_tres").change(function () {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#foto-oem_tres-seleccionada').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                    $("#foto-empaquetado").attr("src", "{{asset('documents/orden_compra/images/')}}/" + data.foto_empaquetado);
                    $("#input-empaquetado").change(function () {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#foto-empaquetado-seleccionada').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                },
                error: function (data) {
                    alert('error');
                }
            });
        });

        // Actualiza ccaracterisitica
        $('.actualizaCaracteristica').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/consulta_caracteristica') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $("#producto_caracterisitca_id").val(data.producto_id);
                    $("#caracteristica_id").val(data.id);
                    $("#especificacion_producto").val(data.especificaciones_producto);
                    $("#especificacion_electrica").val(data.especificaciones_electricas);
                    $("#link_amazon").val(data.link_amazon);
                    $("#link_alibaba").val(data.link_alibaba);

                },
                error: function (data) {
                    alert("error");
                }
            });
        });

        // Actualiza clasificacion
        $('.actualizaClasificacion').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/consulta_clasificacion') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $('#producto_id_actualiza_clasificacion').val(data.producto_id);
                    $('#clasificacion_id').val(data.id);
                    $('#actualiza_clasificacion_arancelaria').val(data.clasificacion_arancelaria);
                    $('#actualiza_nom_1').val(data.nom_1);
                    $('#actualiza_nom_2').val(data.nom_2);
                    $('#actualiza_nom_3').val(data.nom_3);
                    $('#actualiza_nom_4').val(data.nom_4);
                },
                error: function (data) {
                    alert("error");
                }
            });
        });

        // Actualiza diseño
        $('.actualizaDiseno').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/consulta_diseno') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $('#produto_diseno_id').val(data.producto_id);

                    $('#diaeno_id').val(data.id);
                    if (data.empaque === 1) {
                        $('#empaque_diseno_actualiza').prop('checked', true);
                    }
                    if (data.oem === 1) {
                        $('#oem_diseno_actualiza').prop('checked', true);
                    }
                    if (data.instructivo === 1) {
                        $('#instructivo_diseno_actualiza').prop('checked', true);
                    }
                    $('#fecha_diseno_diseno_actualiza').val(data.fecha_aviso_diseno);
                    $('#fecha_trafico_diseno_actualiza').val(data.fecha_autorizacion_trafico);
                },
                error: function (data) {
                    alert("error");
                }
            });
        });

        // Guardado nuevo producto en actualiza
        $(document).ready(function () {
            $("#nuevo-producto-actualiza-form").validate({
                event: "blur", rules: {
                    'sku_producto_nuevo': "required",
                    'nombre_producto_nuevo': "required",
                    'costo_producto_nuevo': "required",
                    'precio_menudeo_producto_nuevo': "required",
                    'sat_producto_nuevo': "required",
                    'tipo_producto_nuevo': "required"
                },
                messages: {
                    'sku_producto_nuevo': "El SKU es requerido",
                    'nombre_producto_nuevo': "El Nombre de producto es requerido",
                    'costo_producto_nuevo': "El Costo de producto es requerido",
                    'precio_menudeo_producto_nuevo': "El Precio venta al por menor es requerido",
                    'sat_producto_nuevo': "EL Codigo SAT es requerido",
                    'tipo_producto_nuevo': "El Tipo de producto es requerido"
                },
                debug: true, errorElement: "label",
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: '{{route("producto_base.save")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            sku_producto_nuevo: document.getElementById('sku_producto_nuevo').value,
                            nombre_producto_nuevo: document.getElementById('nombre_producto_nuevo').value,
                            costo_producto_nuevo: document.getElementById('costo_producto_nuevo').value,
                            precio_menudeo_producto_nuevo: document.getElementById('precio_menudeo_producto_nuevo').value,
                            sat_producto_nuevo: document.getElementById('sat_producto_nuevo').value,
                            tipo_producto_nuevo: $('#tipo_producto_nuevo').val(),
                            variante_producto_nuevo: document.getElementById('variante_producto_nuevo').value,
                            descripcion_producto_nuevo: document.getElementById('descripcion_producto_nuevo').value
                        },
                        success: function (data) {
                            $('#productosSelectActualiza option').remove();
                            $('#nuevo-producto-actualiza-modal').modal('hide');
                            $.ajax({
                                url: "{{route('productos.select')}}",
                                dataType: "json",
                                type: "GET",
                                success: function (data) {
                                    $("#productosSelectActualiza").append('<option value="">Selecciona</option>');
                                    $.each(data, function (key, registro) {
                                        $("#productosSelectActualiza").append('<option value=' + registro.sku + '>' + registro.name + '</option>');
                                    });
                                    $("#nuevo-producto-actualiza-form")[0].reset();
                                },
                                error: function (data) {
                                    alert('error');
                                }
                            });
                        }
                    });
                }
            });
        });

        // Guardado nuevo producto en guarda
        $(document).ready(function () {
            $("#nuevo-producto-guarda-form").validate({
                event: "blur", rules: {
                    'sku_producto_nuevo': "required",
                    'nombre_producto_nuevo': "required",
                    'costo_producto_nuevo': "required",
                    'precio_menudeo_producto_nuevo': "required",
                    'sat_producto_nuevo': "required",
                    'tipo_producto_nuevo': "required"
                },
                messages: {
                    'sku_producto_nuevo': "El SKU es requerido",
                    'nombre_producto_nuevo': "El Nombre de producto es requerido",
                    'costo_producto_nuevo': "El Costo de producto es requerido",
                    'precio_menudeo_producto_nuevo': "El Precio venta al por menor es requerido",
                    'sat_producto_nuevo': "EL Codigo SAT es requerido",
                    'tipo_producto_nuevo': "El Tipo de producto es requerido"
                },
                debug: true, errorElement: "label",
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: '{{route("producto_base.save")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            sku_producto_nuevo: document.getElementById('sku_producto_nuevo').value,
                            nombre_producto_nuevo: document.getElementById('nombre_producto_nuevo').value,
                            costo_producto_nuevo: document.getElementById('costo_producto_nuevo').value,
                            precio_menudeo_producto_nuevo: document.getElementById('precio_menudeo_producto_nuevo').value,
                            sat_producto_nuevo: document.getElementById('sat_producto_nuevo').value,
                            variante_producto_nuevo: document.getElementById('variante_producto_nuevo').value,
                            tipo_producto_nuevo: $('#tipo_producto_nuevo').val(),
                            descripcion_producto_nuevo: document.getElementById('descripcion_producto_nuevo').value
                        },
                        success: function (data) {
                            $('#productosSelectCrea option').remove();
                            $('#nuevo-producto-guarda-modal ').modal('hide');
                            $.ajax({
                                url: "{{route('productos.select')}}",
                                dataType: "json",
                                type: "GET",
                                success: function (data) {
                                    $("#productosSelectCrea").append('<option value="">Selecciona</option>');
                                    $.each(data, function (key, registro) {
                                        $("#productosSelectCrea").append('<option value=' + registro.sku + '>' + registro.name + '</option>');
                                    });
                                    $("#nuevo-producto-guarda-form")[0].reset();
                                },
                                error: function (data) {
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

    <script>
        // Guardado nuevo producto en guarda
        $(document).ready(function () {
            var statusOrden = document.getElementById("auxStatusOrden").value;
            console.log(statusOrden);

            if (statusOrden === 'recepcion' || statusOrden === 'almacen' || statusOrden === 'cancelado') {
                $("#agregarProductoInfo").show();
                $("#agregarProductoButton").attr("disabled", true);
                $("#eliminarProducto").attr("disabled", true);
                $("#editarProducto").attr("disabled", true);
                $("#estatus").prop("disabled", true);
                console.log('inside if');
            } else {
                $("#agregarProductoInfo").hide();
                $("#agregarProductoButton").attr("disabled", false);
                $("#eliminarProducto").attr("disabled", false);
                $("#editarProducto").attr("disabled", false);
                $("#estatus").prop("disabled", false);
                console.log('inside else...');
            }
        });
    </script>

    <script>
        $('#producto_id').change(function () {
            $.ajax({
                type: 'GET',
                url: '/api/productos/' + $(this).val() + '/clasificacion-aduanera/',
                success: function (data) {
                    $('#clasificacion_arancelaria').val(data.clasificacion_arancelaria);
                    $('#nom_1').val(data.nom_1);
                    $('#nom_2').val(data.nom_2);
                    $('#nom_3').val(data.nom_3);
                    $('#nom_4').val(data.nom_4);
                }
            });
        });

        $('#productosSelectCrea').change(function () {
            var selector = $('#product_variant_id');
            $('#product_variant_id option').remove();
            $('#new_variant_product_id').val($(this).val());
            getVariants($(this).val(), selector)

        });

        $('#productosSelectActualiza').change(function () {
            var selector = $('#select_variant_id_acualiza');
            $('#select_variant_id_acualiza option').remove();
            $('#new_variant_product_id').val($(this).val());
            var value = $("#product_variant_id_acualiza").val();
            console.log(value);
            getVariants($(this).val(), selector ,value)

        });

       function getVariants(id, selector, defaultValue){
           if(id){
               $.ajax({
                   type: 'GET',
                   url: '../../api/productos/' + id + '/variantes/',
                   success: function (data) {
                       selector.append('<option value="">Selecciona</option>');
                       $.each(data, function (key, data) {
                           selector.append('<option value=' + data.id + '>' + data.variant + '</option>');
                       });

                       if(defaultValue){
                           selector.val(defaultValue);
                           selector.select2().trigger('change');
                       }
                   }
               });
           }
       }


        $('#producto_id_caracteristicas').change(function () {
            $.ajax({
                type: 'GET',
                url: '/api/productos/' + $(this).val() + '/caracteristicas/',
                success: function (data) {
                    $('#especificacion_producto').val(data.especificaciones_producto);
                    $('#especificacion_electrica').val(data.especificaciones_electricas);
                    $('#link_amazon').val(data.link_amazon);
                    $('#link_alibaba').val(data.link_alibaba);
                }
            });
        });
    </script>
@stop
@endsection