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
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper div-home"><br>
        <!-- Content Header (Page header) -->
        <section class="">
            <br>
            <h1 style="margin-top:-20px"> Ordenes de compra
                <small> Listado</small>
            </h1>
        </section>
        <!-- Main content -->
        <div class="row" style="width:100%; margin-top: 10px">
            <section class="col-lg-12 connectedSortable ui-sortable home-section">
                <section class="col-lg-2 connectedSortable ui-sortable">
                    <div class="box">
                        <div class="box-body">
                            <small>Filtra status</small>
                            <br><br>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="todos">Todos
                                </button>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="po_creadaB">Po
                                    Creada
                                </button>
                                <input type="hidden" class="btn btn-success btn-xs " role="button" style="width: 100%;"
                                       value="" id="po_creada" name="po_creada"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="borradorB">
                                    Borrador
                                </button>
                                <input type="hidden" id="borrador" name="borrador"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="pi_pedidoB">Pi
                                    Pedido
                                </button>
                                <input type="hidden" id="pi_pedido" name="pi_pedido"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12"
                                        id="por_autorizarB">Por Autorizar
                                </button>
                                <input type="hidden" id="por_autorizar" name="por_autorizar"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="produccionB">
                                    Produccion
                                </button>
                                <input type="hidden" id="produccion" name="produccion"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="enviadoB">
                                    Transito
                                </button>
                                <input type="hidden" id="enviado" name="enviado"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="aduanaB">
                                    Aduana
                                </button>
                                <input type="hidden" id="aduana" name="aduana"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="recepcionB">
                                    Recepcion
                                </button>
                                <input type="hidden" id="recepcion" name="recepcion"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="canceladoB">
                                    Cancelado
                                </button>
                                <input type="hidden" id="cancelado" name="cancelado"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="almacenB">
                                    Almacen
                                </button>
                                <input type="hidden" id="almacen" name="almacen"/>
                            </div>

                            <br>
                        </div>
                    </div>
                </section>
                <section class="col-lg-10 connectedSortable ui-sortable">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Ordenes</h3>
                            <div class="box-tools">
                            </div>
                        </div>
                        <div class="box-body" id="table1">
                            <table id="ordenes" class="table table-striped table-bordered responsive" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th data-priority="1">Status</th>
                                    <th data-priority="2">Orden de compra</th>
                                    <th>Encargado</th>
                                    <th>Proveedor</th>
                                    <th>Fecha Orden</th>
                                    <th>Total</th>
                                    <th>Pagado</th>
                                    <th>Por pagar</th>
                                    <th>Fecha tentativa de pago 100%</th>
                                    <th data-priority="3"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ordenes as $orden)
                                    <tr>
                                        <td>{{$orden->status}}</td>
                                        <td>{{$orden->identificador}}</td>
                                        <td>{{$orden->encargdo_interno}}</td>
                                        <td>{{$orden->proveedor->name}}</td>
                                        <td>{{$orden->created_at}}</td>
                                        <td>{{$orden->total ? $orden->total : 0}}</td>
                                        <td>{{$orden->pagado ? $orden->pagado : 0}}</td>
                                        <td>{{$orden->total - $orden->pagado}}</td>
                                        <td></td>
                                        <td>{{ $orden->id }}</td>
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

        <!--Modal detalle pagos-->
        <div class="modal right fade" id="resumen_pagos_modal" tabindex="-1" role="dialog" aria-labelledby="resumen_pagos_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="resumen-pagos-form">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel2">Resumen de Pagos</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row montoPago" id="montoPago">
                                <div class="panel panel-default monto-ssss"
                                     id="table-monto-default">
                                    <div class="panel-body">
                                        <table id="pagos"
                                               class="table table-striped table-bordered pagos"
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Fecha de pago</th>
                                                <th>Referencia</th>
                                                <th>Moneda</th>
                                                <th>Tipo de cambio</th>
                                                <th>Cantidad</th>
                                                <th>comprobate</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row montoPago" id="montoPago">
                                <div class="panel panel-default monto-ssss"
                                     id="table-monto-default">
                                    <fieldset>
                                        <div class="table-responsive">
                                            <table id="pagos_totales" class="table table-striped table-bordered"   style="width:100%; background: #fff">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>TOTAL</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th style="text-align:right">Productos Orden:</th>
                                                    <th><input disabled type="text" id="total_productos_orden"></th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:right">Gastos en Origen:</th>
                                                    <th><input disabled type="text" id="total_gastos_origen"></th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:right">Total de la Orden:</th>
                                                    <th><input disabled type="text" id="total_orden"></th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:right">Total pagado:</th>
                                                    <th><input disabled type="text" id="total_pagado"></th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:right">Por pagar:</th>
                                                    <th><input disabled type="text" id="total_por_pagar"></th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">Cerrar</span></button>
                        </div>
                    </form>
                </div><!-- modal-dialog -->
            </div>
        </div><!-- modal -->


        </div>
    </div>
@endsection

@section('javascript')
    <script>

        function formatCurrency (number = 0 , isNum = false ,fixed = 0){
            var value = parseFloat(number);
            if(isNum)
                return  value.toFixed(fixed).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            return '$' +   value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        }

        var datatable = $('#ordenes').DataTable({
            drawCallback: function( settings ) {
                // Actualiza producto
                $('.resumen_pagos').on('click', function () {
                    console.log('click');
                    var id = $(this).data("id");
                    console.log(id);
                    $.ajax({
                        url: "{{ url('/reportes/reporte_pagos') }}/" + id,
                        dataType: "json",
                        type: "GET",
                        success: function (json) {
                            pagosDetail = [];
                            getPagosDetail(json.pagos);
                            getPagosTotales(json);
                        },
                        error: function (data) {
                            alert('error');
                        }
                    });
                });
            },
            columnDefs:
                [
                    {
                        targets: [5, 6, 7],
                        orderable: true,
                        visible: true,
                        render: function (cellData, type, row, meta) {

                            return "" + formatCurrency(cellData) + "";
                        }
                    },
                    {
                        targets: [9],
                        orderable: false,
                        visible: true,
                        render: function (cellData, type, row, meta) {
                           return " <button type=\"button\"\n" +
                            "id=\"resumen_pagos_button\"\n" +
                            "class=\"btn btn-primary btn-xs resumen_pagos\"\n" +
                            "data-toggle=\"modal\"\n" +
                            "data-target=\"#resumen_pagos_modal\"\n" +
                            "data-id=\""+ cellData +"\">\n" +
                            "<i class=\"fa fa-eye\"></i></button>"
                        }
                    }
                ],
            @include('partials/datatables_lang')
        });
        var pagosTable = null;
        var pagosDetail = [];

        pagosTable = $('#pagos').DataTable({
            data: pagosDetail,
            "bPaginate": false,
            "bLengthChange": true,
            "bFilter": false,
            "bInfo": false,
            columnDefs:
                [
                    {
                        targets: [5],
                        orderable: false,
                        render: function (cellData, type, row, meta) {
                            console.log(cellData)
                            return "<a target=\"_blank\" href='../../../documents/orden_compra/"+ cellData +"'>"+cellData+"</a>";
                        }
                    }
                ],
        });


        function getPagosDetail(data){
            $.each(data, function(index, value) {
                var newData = [
                    value.fecha_pago,
                    value.referencia,
                    value.currency_id,
                    value.tipo_cambio_pago,
                    formatCurrency(value.pago),
                    value.comrpobante
                ];
                pagosDetail.push(newData);
            });
            redrawTable();
        }

        function redrawTable(e){
            console.log(pagosDetail);
            pagosTable.clear();
            pagosTable.rows.add(pagosDetail);
            pagosTable.columns.adjust().draw(); // Redraw the DataTable
        }

        function getPagosTotales(value) {
            $('#total_productos_orden').val(formatCurrency(value.total_productos_orden));
            $('#total_gastos_origen').val(formatCurrency(value.total_gastos_origen));
            $('#total_orden').val(formatCurrency(value.total_orden));
            $('#total_pagado').val(formatCurrency(value.total_pagado));
            $('#total_por_pagar').val(formatCurrency(value.total_por_pagar));
        }

        //FILTROS

        $('#todos').on('click', function () {
            datatable.columns(0).search("").draw();
        });

        $('#po_creadaB').on('click', function () {
            datatable.columns(0).search("po creada").draw();
        });

        $('#borradorB').on('click', function () {
            datatable.columns(0).search("borrador").draw();
        });

        $('#pi_pedidoB').on('click', function () {
            datatable.columns(0).search("pedido").draw();
        });

        $('#por_autorizarB').on('click', function () {
            datatable.columns(0).search("por autorizar").draw();
        });

        $('#produccionB').on('click', function () {
            datatable.columns(0).search("produccion").draw();
        });

        $('#enviadoB').on('click', function () {
            datatable.columns(0).search("transito").draw();
        });

        $('#aduanaB').on('click', function () {
            datatable.columns(0).search("aduana").draw();
        });

        $('#recepcionB').on('click', function () {
            datatable.columns(0).search("recepcion").draw();
        });

        $('#canceladoB').on('click', function () {
            datatable.columns(0).search("cancelado").draw();
        });

        $('#almacenB').on('click', function () {
            datatable.columns(0).search("almacen").draw();
        });

     </script>
@endsection
