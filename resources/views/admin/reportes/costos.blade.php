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
            <h1 style="margin-top:-20px">Costos
                <small> Listado</small>
            </h1>
        </section>
        <!-- Main content -->
        <div class="row" style="width:100%; margin-top: 10px">
            <section class="col-lg-12 connectedSortable ui-sortable home-section">
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Costos</h3>
                            <div class="box-tools">
                            </div>
                        </div>
                        <div class="box-body" id="table1">
                            <table id="costos" class="table table-striped table-bordered responsive" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th data-priority="1">SKU</th>
                                    <th data-priority="2">Fecha última llegada</th>
                                    <th data-priority="2">Qty</th>
                                    <th data-priority="2">Precio</th>
                                    <th data-priority="2">Orden compra</th>
                                    <th data-priority="2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productos as $producto)
                                    <tr class="clickable-row" data-href="{{route('reportes.costo-detalle', ['sku'=>$producto->sku])}}" style="cursor: pointer;">
                                        <td>{{$producto->sku}}</td>
                                        <td>{{$producto->fecha_recepcion}}</td>
                                        <td>{{$producto->qty}}</td>
                                        <td>{{$producto->price}}</td>
                                        <td>{{$producto->orden_compra_identificador}}</td>
                                        <td>
                                            <a href="{{route('reportes.costo-detalle', ['sku'=>$producto->sku])}}">
                                                <button class="btn btn-warning btn-xs" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
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
        var datatable = $('#costos').DataTable({
            @include('partials/datatables_lang')
        });
    </script>

    <script>
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    </script>
@endsection


