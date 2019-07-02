@extends('layouts.app')

@section('content')
    <style>
        .filtro {
            margin-top: -30px !important;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top:0px; width: 100% !important;"><br>
        <!-- Content Header (Page header) -->
        <section class="">
            <br>
            <h1 style="margin-top:-20px"> Ordenes de compra<small> Listado</small> </h1>
        </section>
        <!-- Main content -->
        <div class="row" style="width:100%; margin-top: 10px">
            <section class="col-lg-2 connectedSortable ui-sortable">
                <div class="box">
                    <div class="box-header">
                        <a href="{{route('orden.create')}}" class="btn btn-primary btn-xs" role="button" style="height: 27px;"><i class="fa fa-file"></i> Nueva Orden de compra</a>
                    </div>
                    <div class="box-body">
                        <small>Filtra status</small><br><br>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="PO creada" id="po_creada" name="po_creada"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="Borrador"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="PI Pedido"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="Por Autorizar"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="Produccion"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="Enviado"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="Aduana"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="Recepcion"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="Cancelado"/>
                        </div>
                        <div class="form-group col-sm-12 formPrincipal">
                            <input type="button" class="btn btn-success btn-xs filtro" role="button" style="width: 100%;" value="Almacen"/>
                        </div>

                        <br>
                        <div class="form-group col-sm-12 formPrincipal">
                            <small>Selecciona encargado</small>
                            <select class="form-control" name="encargado" id="encargado">
                                <option value="">Selecciona</option>
                                <option value="">Todos</option>
                                @foreach($encargados as $encargado)
                                    <option value="{{ $encargado->name }}">{{ $encargado->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <table id="example" class="table table-striped table-bordered responsive" cellspacing="0" width="100%">
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
                                <th>Restante</th>
                                <th data-priority="3"></th>
                                <th data-priority="4"></th>
                                <th data-priority="5"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
                        <a id="delete_orden" role="button" class="btn btn-outline"><i class="fa fa-trash"></i> Borrar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
    </div>

@section('javascript')
    <script>
        jQuery(function($){
            // Inicializa tabla de datos
            var dtable = $('#example').DataTable({
                "ajax": {
                    "url": "/api/ordenes",
                    "dataSrc": "data.ordenes.data",
                    "data": function (d) {
                        var request_data = {};
                        request_data.per_page = d.length;
                        request_data.page = Math.ceil(d.start / d.length) + 1;
                        request_data.order = d.columns[d.order[0].column].data;
                        request_data.sort = d.order[0].dir;
                        //request_data.search = d.search.value;
                        request_data.encargdo_interno = $('#encargado').val();
                        return request_data;
                    },
                    "dataFilter": function(response_data){
                        var d = jQuery.parseJSON(response_data);
                        d.recordsTotal = d.data.ordenes.total;
                        d.recordsFiltered = d.data.ordenes.total;
                        return JSON.stringify(d);
                    }
                },
                columns: [
                    {data: 'status'},
                    {data: 'identificador'},
                    {data: null, render: function(d){ if(d.encargdo_interno){ return d.encargdo_interno }else{ return 'S/R' }}},
                    {data: null, render: function (d) { if(d.proveedor_id){ return d.proveedor['name'] } else { return 'S/R' }}},
                    {data: null, render: function(d){ if(d.fecha_inicio){ return d.fecha_inicio }else{ return 'S/R' }}},
                    {data: null, render: function(d){ if(d.metodo_envio){ return d.metodo_envio }else{ return 'S/R' }}},
                    {data: null, render: function(d){ if(d.guia){ return d.guia }else{ return 'S/R' }}},
                    {data: null, render: function(d){ if(d.total){ return d.total }else{ return 0 }}},
                    {data: null, render: function(d){ if(d.pagado){ return d.pagado }else{ return 0 }}},
                    {
                        data: null, orderable: false, render: function(d,t,r) {
                            var restante = d.total - d.pagado;
                            return restante;
                        }
                    },
                    {data: null, orderable: false, render: function (d) { return '<a href="/' + d.id + '" class="btn btn-warning btn-xs" role="button"><i class="fa fa-edit"></i></a>'; } },
                    {data: null, orderable: false, render: function (d) { return '<a href="/' + d.id + '" class="btn btn-primary btn-xs" role="button"><i class="fa fa-copy"></i></a>'; } },
                    {data: null, orderable: false, render: function (d) { return '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger" data-id="'+ d.id +'"><i class="fa fa-remove"></i></button>'; } },
                ],
                // Opciones iguales en todas las tablas.
                "pageLength": 25,
                "serverSide": true,
                "searchDelay": 1500,
                "searching": false,
                @include('partials/datatables_lang')
            });

            // Solo envía el filtro al darle "enter".
            // Corrige error de dataTables que envía el primer caracter como búsqueda al servidor.
            $("#table1 div.dataTables_filter input").unbind();
            $("#table1 div.dataTables_filter input").keyup(function (e) {
                if (e.keyCode == 13) {
                    dtable.search( this.value ).draw();
                }
            });
            $('#encargado').on('change', function() {
                $("#encargado").val();
                dtable.search('').draw();
            });
            $('#po_creada').click(function(){
                $('#po_creada').val();
                dtable.search('').draw();
            });
        });
        $(document).ready(function() {
            $('#modal-danger').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_orden').attr("href", "{{ url('/admin/elimina_orden') }}" + "/" + id);
            });
        });
    </script>
@stop
@endsection
