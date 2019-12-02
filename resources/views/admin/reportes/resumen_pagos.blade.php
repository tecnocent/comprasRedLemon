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
    <div class="content-wrapper div-home">
        <br>
        <!-- Content Header (Page header) -->
        <section class="">
            <br>
            <h1 style="margin-top:-20px"> Resumen de Pagos
            </h1>
        </section>
        <!-- Main content -->
        <div class="row" style="width:100%; margin-top: 10px">
            <section class="col-lg-12 connectedSortable ui-sortable home-section">
                <section class="col-lg-1 connectedSortable ui-sortable">
                    <div>
                        <div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-11 connectedSortable ui-sortable">
                    <div class="box">
                    <div class="box-body" id="table1">
                        <div class="table-responsive">
                            <table id="pagos_totales" class="table table-striped table-bordered"   style="width:100%; background: #fff">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Pagado</th>
                                    <th>Pagado MXN</th>
                                    <th>Por Pagar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th >Producción:</th>
                                    <th><input disabled type="text" id="total_produccion_pagado"></th>
                                    <th><input disabled type="text" id="total_pagado_MXN_p"></th>
                                    <th><input disabled type="text" id="total_produccion_porPagar"></th>
                                </tr>
                                <tr>
                                    <th >Transito:</th>
                                    <th><input disabled type="text" id="total_transito_pagado"></th>
                                    <th><input disabled type="text" id="total_pagado_MXN_t"></th>
                                    <th><input disabled type="text" id="total_transito_porPagar"></th>
                                </tr>
                                <tr>
                                    <th >Total:</th>
                                    <th><input disabled type="text" id="total_pagado"></th>
                                    <th><input disabled type="text" id="total_pagadoMXN"></th>
                                    <th><input disabled type="text" id="total_porPagar"></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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

        function formatCurrency (number = 0 , isNum = false ,fixed = 0){
            var value = parseFloat(number);
            if(isNum)
                return  value.toFixed(fixed).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            return '$' +   value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        }

        var pagosTable = null;
        var pagosDetail = [];

        // Actualiza producto
        function getResumen() {
            $.ajax({
                url: "{{ url('/reportes/resumen_pagos') }}",
                dataType: "json",
                type: "GET",
                success: function (json) {
                    setPagosTotales(json)
                },
                error: function (data) {
                    alert('error');
                }
            });
        };

        function setPagosTotales(value) {
            $('#total_produccion_pagado').val(formatCurrency(value.produccion.total_pagado));
            $('#total_produccion_porPagar').val(formatCurrency(value.produccion.total_por_pagar));

            $('#total_transito_pagado').val(formatCurrency(value.transito.total_pagado));
            $('#total_transito_porPagar').val(formatCurrency(value.transito.total_por_pagar));

            var totalPagado = value.produccion.total_pagado + value.transito.total_pagado;
            var totalPorPagar = value.produccion.total_por_pagar + value.transito.total_por_pagar;

            var totalPagadoMXNp = value.produccion.total_pagado_mxn;
            var totalPagadoMXNt = value.transito.total_pagado_mxn;
            var totalPagadoMXN = value.transito.total_pagado_mxn + value.produccion.total_pagado_mxn;

            $('#total_pagado').val(formatCurrency(totalPagado));
            $('#total_porPagar').val(formatCurrency(totalPorPagar));

            $('#total_pagado_MXN_p').val(formatCurrency(totalPagadoMXNp));
            $('#total_pagado_MXN_t').val(formatCurrency(totalPagadoMXNt));
            $('#total_pagadoMXN').val(formatCurrency(totalPagadoMXN));
        }

        getResumen();
    </script>
@endsection
