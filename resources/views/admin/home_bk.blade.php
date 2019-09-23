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
                        <div class="box-header">
                            <a href="{{route('orden.create')}}" class="btn btn-primary btn-xs" role="button"
                               style="height: 27px;"><i class="fa fa-file"></i> Nueva Orden de compra</a>
                        </div>
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
                                    Enviado
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
                            {{--<div class="form-group col-sm-12 formPrincipal">--}}
                                {{--<small>Selecciona encargado</small>--}}
                                {{--<select class="form-control" name="encargado" id="encargado">--}}
                                    {{--<option value="">Selecciona</option>--}}
                                    {{--<option value="">Todos</option>--}}
                                    {{--@foreach($encargados as $encargado)--}}
                                        {{--<option value="{{ $encargado->name }}">{{ $encargado->name }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
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
                                    <th>Fecha PI</th>
                                    <th>Método envio</th>
                                    <th>Guia</th>
                                    <th>Total</th>
                                    <th>Pagado</th>
                                    <th>Por pagar</th>
                                    <th data-priority="3"></th>
                                    <th data-priority="5"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ordenes as $orden)
                                    <tr>
                                        <td>{{$orden->status}}</td>
                                        <td>{{$orden->identificador}}</td>
                                        <td>{{$orden->encargdo_interno}}</td>
                                        <td>{{$orden->proveedor->name}}</td>
                                        <td>{{$orden->fecha_inicio}}</td>
                                        <td>{{$orden->metodo_envio ? $orden->metodo_envio : 'S/R'}}</td>
                                        <td>{{$orden->guia ? $orden->guia : 'S/R'}}</td>
                                        <td>{{$orden->total ? $orden->total : 0}}</td>
                                        <td>{{$orden->pagado ? $orden->pagado : 0}}</td>
                                        <td>{{$orden->total - $orden->pagado}}</td>
                                        <td>
                                            <a href="{{ url('/admin/muestra_orden/'.$orden->id) }}" class="btn btn-warning btn-xs" role="button"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger" data-id="{{$orden->id}}"><i class="fa fa-remove"></i></button>
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

        <!-- Modal -->
        <div class="modal modal-danger fade" id="modal-danger" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Advertencia</h4>
                    </div>
                    <div class="modal-body">
                        <p>¿Estas seguro de borrar la orden?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                        <a id="delete_orden" role="button" class="btn btn-outline"><i class="fa fa-trash"></i>
                            Borrar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->


        <div id="modal-view" class="modal fade bd-example-modal-lg right" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Orden de compra: </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">

                            </div>
                            <div class="form-group">

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('#modal-danger').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $('#delete_orden').attr("href", "{{ url('/admin/elimina_orden') }}" + "/" + id);
        });

        var datatable = $('#ordenes').DataTable({
            @include('partials/datatables_lang')
        });

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
            datatable.columns(0).search("pi pedido").draw();
        });

        $('#por_autorizarB').on('click', function () {
            datatable.columns(0).search("por autorizar").draw();
        });

        $('#produccionB').on('click', function () {
            datatable.columns(0).search("produccion").draw();
        });

        $('#enviadoB').on('click', function () {
            datatable.columns(0).search("enviado").draw();
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
