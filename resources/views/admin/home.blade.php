@extends('layouts.app')

@section('content')
    <style>
        .filtro{
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
            <h1 style="margin-top:-20px"> Ordenes de compra<small> Listado</small> </h1>
        </section>
        <!-- Main content -->
        <div class="row" style="width:100%; margin-top: 10px">
            <section class="col-lg-12 connectedSortable ui-sortable home-section">
                <section class="col-lg-2 connectedSortable ui-sortable">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{route('orden.create')}}" class="btn btn-primary btn-xs" role="button" style="height: 27px;"><i class="fa fa-file"></i> Nueva Orden de compra</a>
                        </div>
                        <div class="box-body">
                            <small>Filtra status</small><br><br>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="todos" >Todos</button>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="po_creadaB" >Po Creada</button>
                                <input type="hidden" class="btn btn-success btn-xs " role="button" style="width: 100%;" value="" id="po_creada" name="po_creada"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="borradorB" >Borrador</button>
                                <input type="hidden" id="borrador" name="borrador"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="pi_pedidoB" >Pi Pedido</button>
                                <input type="hidden" id="pi_pedido" name="pi_pedido"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="por_autorizarB" >Por Autorizar</button>
                                <input type="hidden" id="por_autorizar" name="por_autorizar"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="produccionB" >Produccion</button>
                                <input type="hidden"  id="produccion" name="produccion"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="enviadoB" >Enviado</button>
                                <input type="hidden"   id="enviado" name="enviado"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="aduanaB" >Aduana</button>
                                <input type="hidden"  id="aduana" name="aduana"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="recepcionB" >Recepcion</button>
                                <input type="hidden"  id="recepcion" name="recepcion"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="canceladoB" >Cancelado</button>
                                <input type="hidden"  id="cancelado" name="cancelado"/>
                            </div>
                            <div class="form-group formPrincipal">
                                <button type="button" class="btn btn-success btn-xs filtro col-sm-12" id="almacenB" >Almacen</button>
                                <input type="hidden" id="almacen" name="almacen"/>
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


        <div id="modal-view" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
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

@section('javascript')
    <script>
        $.fn.dataTable.ext.errMode = 'none';
        jQuery(function($){
            // Inicializa tabla de datos
            var dtable = $('#example').DataTable({
                "ajax": {
                    "url": "{{ route('ordenes.index') }}",
                    "dataSrc": "data.ordenes.data",
                    "data": function (d) {
                        var request_data = {};
                        request_data.per_page = d.length;
                        request_data.page = Math.ceil(d.start / d.length) + 1;
                        request_data.order = d.columns[d.order[0].column].data;
                        request_data.sort = d.order[0].dir;
                        //request_data.search = d.search.value; No funciona por ahora
                        request_data.encargdo_interno = $('#encargado').val();
                        request_data.po_creada = $('#po_creada').val();
                        request_data.borrador = $('#borrador').val();
                        request_data.pi_pedido = $('#pi_pedido').val();
                        request_data.por_autorizar = $('#por_autorizar').val();
                        request_data.produccion = $('#produccion').val();
                        request_data.enviado = $('#enviado').val();
                        request_data.aduana = $('#aduana').val();
                        request_data.recepcion = $('#recepcion').val();
                        request_data.cancelado = $('#cancelado').val();
                        request_data.almacen = $('#almacen').val();
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
                    {data: null, orderable: false, render: function (d) { return '<a  class="btn btn-warning btn-xs" role="button"><i class="fa fa-edit"></i></a>'; } },
                    {data: null, orderable: false, render: function (d) { return '<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-view" data-id="'+ d.id +'" role="button"><i class="fa fa-eye"></i></button>'; } },
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
            // Filtros avanzados
            $('#encargado').on('change', function() {
                $("#encargado").val();
                dtable.search('').draw();
            });
            $('#todos').click(function(){
                $('#po_creada').val('');
                $('#borrador').val('');
                $('#pi_pedido').val('');
                $('#por_autorizar').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#po_creadaB').click(function(){
                $('#po_creada').val('po creada');
                $('#borrador').val('');
                $('#pi_pedido').val('');
                $('#por_autorizar').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#borradorB').click(function(){
                $('#borrador').val('borrador');
                $('#po_creada').val('');
                $('#pi_pedido').val('');
                $('#por_autorizar').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#pi_pedidoB').click(function(){
                $('#pi_pedido').val('pi pedido');
                $('#borrador').val('');
                $('#po_creada').val('');
                $('#por_autorizar').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#por_autorizarB').click(function(){
                $('#por_autorizar').val('por autorizar');
                $('#borrador').val('');
                $('#po_creada').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#produccionB').click(function(){
                $('#produccion').val('produccion');
                $('#por_autorizar').val('');
                $('#borrador').val('');
                $('#po_creada').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#enviadoB').click(function(){
                $('#enviado').val('enviado');
                $('#por_autorizar').val('');
                $('#borrador').val('');
                $('#po_creada').val('');
                $('#produccion').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#aduanaB').click(function(){
                $('#aduana').val('aduana');
                $('#por_autorizar').val('');
                $('#borrador').val('');
                $('#po_creada').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#recepcionB').click(function(){
                $('#recepcion').val('recepcion');
                $('#por_autorizar').val('');
                $('#borrador').val('');
                $('#po_creada').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#cancelado').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#canceladoB').click(function(){
                $('#cancelado').val('cancelado');
                $('#por_autorizar').val('');
                $('#borrador').val('');
                $('#po_creada').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#almacen').val('');
                dtable.search('').draw();
            });
            $('#almacenB').click(function(){
                $('#almacen').val('almacen');
                $('#por_autorizar').val('');
                $('#borrador').val('');
                $('#po_creada').val('');
                $('#produccion').val('');
                $('#enviado').val('');
                $('#aduana').val('');
                $('#recepcion').val('');
                $('#cancelado').val('');
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
