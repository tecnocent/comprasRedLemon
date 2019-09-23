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
        <!-- Main content -->

        <!-- /.Detalles de la Orden de Compra -->
        <div class="row" style="width:100%; margin-top: 10px">
            <section class="col-md-11">
                <h3>Detalles de la Orden de Compra</h3>
                <div class="box">
                    <div class="col-md-3">
                        <table class="table responsive">
                            <tr>
                                <th>PO Number</th>
                                <td>{{$ordenCompra->identificador ? $ordenCompra->identificador : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Status Orden</th>
                                <td>{{$ordenCompra->status ? $ordenCompra->status : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Proveedor</th>
                                <td>{{$ordenCompra->proveedor->name ? $ordenCompra->proveedor->name : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Encargado</th>
                                <td>{{$ordenCompra->encargdo_interno ? $ordenCompra->encargdo_interno : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Método de Envío</th>
                                <td>{{$ordenCompra->metodo_envio ? $ordenCompra->metodo_envio : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Número de Guía</th>
                                <td>{{$ordenCompra->guia ? $ordenCompra->guia : '-'}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table class="table responsive">
                            <tr>
                                <th>Fecha de inicio</th>
                                <td>{{$ordenCompra->fecha_inicio ? $ordenCompra->fecha_inicio : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Requerimiento</th>
                                <td>{{$ordenCompra->requerimiento ? $ordenCompra->requerimiento: '-'}}</td>
                            </tr>
                            <tr>
                                <th>Almacén</th>
                                <td>{{$ordenCompra->almacen->name ? $ordenCompra->almacen->name: '-'}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table class="table responsive">
                            <tr>
                                <th>Total Productos</th>
                                <td>{{$total_productos ? $total_productos : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Total Gastos en Origen</th>
                                <td>{{$total_gastos_origen ? $total_gastos_origen : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>{{$ordenCompra->total ? $ordenCompra->total : '-'}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table class="table responsive">
                            <tr>
                                <th>Pagado</th>
                                <td>{{$ordenCompra->pagado ? $ordenCompra->pagado : '-'}}</td>
                            </tr>
                            <tr>
                                <th>Por pagar</th>
                                <td>{{$ordenCompra->total -  $ordenCompra->pagado ? $ordenCompra->total -  $ordenCompra->pagado : '-'}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>

            <!-- /.Productos -->
            <section class="col-md-11">
                <h3>Productos</h3>
                <div class="box">
                    <table id="productos" class="table table-striped table-bordered responsive" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th data-priority="1">SKU</th>
                            <th data-priority="2">Producto</th>
                            <th data-priority="2">Variante</th>
                            <th data-priority="2">Qty</th>
                            <th data-priority="2">Precio</th>
                            <th data-priority="2">Total</th>
                            <th data-priority="2">Status OEM Diseño</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{$producto->sku ? $producto->sku : '-'}}</td>
                                <td>{{$producto->producto ? $producto->producto : '-'}}</td>
                                <td>{{$producto->variante ? $producto->variante : '-'}}</td>
                                <td>{{$producto->qty ? $producto->qty : '-'}}</td>
                                <td>{{$producto->price ? $producto->price : '-'}}</td>
                                <td>{{$producto->total ? $producto->total : '-'}}</td>
                                <td>{{$producto->status_oem_diseno ? $producto->status_oem_diseno : '-'}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- /.Gastos en origen -->
            <section class="col-md-11">
                <h3>Gastos en origen</h3>
                <div class="box">
                    <table id="gastos_origen" class="table table-striped table-bordered responsive" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th data-priority="1">Tipo de gasto</th>
                            <th data-priority="2">Cantidad</th>
                            <th data-priority="2">Comprobante</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gastosOrigen as $gastoOrigen)
                            <tr>
                                <td>{{$gastoOrigen->tipoGasto->name ? $gastoOrigen->tipoGasto->name : '-'}}</td>
                                <td>{{$gastoOrigen->costo ? $gastoOrigen->costo : '-'}}</td>
                                <td>{{$gastoOrigen->comprobante ? $gastoOrigen->comprobante : '-'}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- /.Pagos -->
            <section class="col-md-11">
                <h3>Pagos</h3>
                <div class="box">
                    <table id="pagos" class="table table-striped table-bordered responsive" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th data-priority="1">Fecha del pago</th>
                            <th data-priority="1">Cantidad</th>
                            <th data-priority="1">Moneda</th>
                            <th data-priority="2">Tipo Cambio</th>
                            <th data-priority="2">Referencia</th>
                            <th data-priority="2">Comprobante</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagos as $pago)
                            <tr>
                                <td>{{$pago->fecha_pago ? $pago->fecha_pago : '-'}}</td>
                                <td>{{$pago->pago ? $pago->pago : '-'}}</td>
                                <td>{{$pago->currency->code ? $pago->currency->code : '-'}}</td>
                                <td>{{$pago->tipo_cambio_pago ? $pago->tipo_cambio_pago : '-'}}</td>
                                <td>{{$pago->comprobante ? $pago->comprobante : '-'}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <!-- /.content -->
    </div>

@endsection

@section('javascript')
    <script>
        $('#productos').DataTable({
            "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
            "paging": false,//Dont want paging
            "bPaginate": false,//Dont want paging
            @include('partials/datatables_lang')
        });

        $('#gastos_origen').DataTable({
            "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
            "paging": false,//Dont want paging
            "bPaginate": false,//Dont want paging
            @include('partials/datatables_lang')
        });

        $('#pagos').DataTable({
            "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
            "paging": false,//Dont want paging
            "bPaginate": false,//Dont want paging
            @include('partials/datatables_lang')
        });
    </script>
@endsection

