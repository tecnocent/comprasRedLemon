@extends('layouts.app')

@section('content')
    <style>
        .filtro {
            margin-bottom: 10px;
        }

        .home-section {
            padding-right: 0px !important;
            padding-left: 0px !important;
            margin-left: -74px;
            width: 105%;
        }

        .div-home {
            margin-top: 0px;
            width: 111% !important;
            min-height: 273px;
            margin-left: -57px;
        }

        .button-group {
            margin: auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper div-home"><br>
        <!-- Content Header (Page header) -->
        <section class="">
            <br>
            <h1 style="margin-top:-20px"> Productos pedidos
                <small> Listado</small>
            </h1>
        </section>
        <!-- Main content -->
        <div class="row" style="width:100%; margin-top: 10px">
            <section class="col-lg-12 connectedSortable ui-sortable home-section">
                {{--<section class="col-lg-12 connectedSortable ui-sortable">--}}
                    {{--<div class="btn-group" role="group" aria-label="...">--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="todos" >Todos</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="po_creadaB" >Po Creada</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="borradorB" >Borrador</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="pi_pedidoB" >Pi Pedido</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="por_autorizarB" >Por Autorizar</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="produccionB" >Produccion</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="enviadoB" >Enviado</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="aduanaB" >Aduana</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="recepcionB" >Recepcion</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="canceladoB" >Cancelado</button>--}}
                        {{--<button type="button" class="btn btn-success btn-xs filtro" id="almacenB" >Almacen</button>--}}
                    {{--</div>--}}
                {{--</section>--}}

                <section class="col-lg-12">
                    <div class="btn-group button-group" role="group">
                        <button type="button" class="btn btn-success filtro" id="todos" >Todos</button>
                        <button type="button" class="btn btn-success filtro" id="po_creadaB" >Po Creada</button>
                        <button type="button" class="btn btn-success filtro" id="borradorB" >Borrador</button>
                        <button type="button" class="btn btn-success filtro" id="pi_pedidoB" >Pi Pedido</button>
                        <button type="button" class="btn btn-success filtro" id="por_autorizarB" >Por Autorizar</button>
                        <button type="button" class="btn btn-success filtro" id="produccionB" >Produccion</button>
                        <button type="button" class="btn btn-success filtro" id="enviadoB" >Enviado</button>
                        <button type="button" class="btn btn-success filtro" id="aduanaB" >Aduana</button>
                        <button type="button" class="btn btn-success filtro" id="recepcionB" >Recepcion</button>
                        <button type="button" class="btn btn-success filtro" id="canceladoB" >Cancelado</button>
                        <button type="button" class="btn btn-success filtro" id="almacenB" >Almacen</button>
                    </div>
                </section>

                <section class="col-lg-12 connectedSortable ui-sortable">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Productos pedidos</h3>
                            <div class="box-tools">
                            </div>
                        </div>
                        <div class="box-body" id="table1">
                            <table id="productos_pedidos" class="table table-striped table-bordered responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th data-priority="1">SKU</th>
                                    <th data-priority="2">Producto</th>
                                    <th data-priority="2">Variante</th>
                                    <th data-priority="2">Qty</th>
                                    <th data-priority="2">Costo</th>
                                    <th data-priority="2">Proveedor</th>
                                    <th data-priority="2">Tipo de envío</th>
                                    <th data-priority="2">Guía</th>
                                    <th data-priority="2">Inicio PO</th>
                                    <th data-priority="2">Orden</th>
                                    <th data-priority="2">Status OEM diseño</th>
                                    <th data-priority="2">Status Orden </th>
                                    <th data-priority="2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productos as $producto)
                                    <tr>
                                        <td>{{$producto->sku}}</td>
                                        <td>{{$producto->producto}}</td>
                                        <td>{{$producto->variante}}</td>
                                        <td>{{$producto->qty}}</td>
                                        <td>{{$producto->price}}</td>
                                        <td>{{$producto->proveedor}}</td>
                                        <td>{{$producto->metodo_envio}}</td>
                                        <td>{{$producto->guia}}</td>
                                        <td>{{$producto->fecha_inicio_po}}</td>
                                        <td>{{$producto->orden_compra_identificador}}</td>
                                        <td>{{$producto->status_oem_diseno}}</td>
                                        <td>{{$producto->status_orden}}</td>
                                        <td>
                                            <a href="{{ url('/admin/muestra_orden/'.$producto->orden_compra_id) }}" class="btn btn-warning btn-xs" role="button"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('/admin/reportes/detalle-orden/'.$producto->orden_compra_id) }}" class="btn btn-warning btn-xs" role="button"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </section>
        </div>
        <!-- /.content -->
    </div>

@endsection
@section('javascript')
    <script>
        var datatable = $('#productos_pedidos').DataTable({
            order: [[ 8, 'desc' ]],
            @include('partials/datatables_lang')
        });

        $('#todos').on('click', function () {
            datatable.columns(11).search("").draw();
        });

        $('#po_creadaB').on('click', function () {
            console.log(datatable ,"po creada");
            datatable.columns(11).search("po creada").draw();
        });

        $('#borradorB').on('click', function () {
            datatable.columns(11).search("borrador").draw();
        });

        $('#pi_pedidoB').on('click', function () {
            datatable.columns(11).search("pi_pedido").draw();
        });

        $('#por_autorizarB').on('click', function () {
            datatable.columns(11).search("por_autorizar").draw();
        });

        $('#produccionB').on('click', function () {
            datatable.columns(11).search("produccion").draw();
        });

        $('#enviadoB').on('click', function () {
            datatable.columns(11).search("transito").draw();
        });

        $('#aduanaB').on('click', function () {
            datatable.columns(11).search("aduana").draw();
        });

        $('#recepcionB').on('click', function () {
            datatable.columns(11).search("recepcion").draw();
        });

        $('#canceladoB').on('click', function () {
            datatable.columns(11).search("cancelado").draw();
        });

        $('#almacenB').on('click', function () {
            datatable.columns(11).search("almacen").draw();
        });
    </script>
@endsection
