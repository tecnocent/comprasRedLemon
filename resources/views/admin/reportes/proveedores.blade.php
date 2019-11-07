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
            <h1 style="margin-top:-20px">Proveedores
                <small> Listado</small>
            </h1>
        </section>
        <!-- Main content -->
        <div class="row" style="width:100%; margin-top: 10px">
            <section class="col-lg-12 connectedSortable ui-sortable home-section">
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Proveedores</h3>
                            <div class="box-tools">
                            </div>
                        </div>
                        <br>
                        <div>
                        <button type="button"
                                id="nuevoProveedor"
                                class="btn btn-primary btn-xs proveedorCrea"
                                data-toggle="modal"
                                data-target="#nuevo-proveedor-modal">
                            Agregar Proveedor</button>
                        </div>
                        <div class="box-body" id="table1">
                            <table id="productos_pedidos" class="table table-striped table-bordered responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th data-priority="1">Nombre</th>
                                    <th data-priority="2">Contacto</th>
                                    <th data-priority="2">Correo</th>
                                    <th data-priority="2">Telefono</th>
                                    <th data-priority="2">Pais</th>
                                    <th data-priority="2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proveedores as $proveedor)
                                    <tr>
                                        <td>{{$proveedor->name}}</td>
                                        <td>{{$proveedor->contactname}}</td>
                                        <td>{{$proveedor->email}}</td>
                                        <td>{{$proveedor->phone}}</td>
                                        <td>{{$proveedor->country}}</td>
                                        <td>
                                            <button type="button"
                                                    id="eliminarProveedor"
                                                    class="btn btn-danger btn-xs"
                                                    data-toggle="modal"
                                                    data-target="#modal-danger-proveedor"
                                                    data-id="{{ $proveedor->id }}">
                                                <i class="fa fa-remove"></i></button>
                                            <button type="button"
                                                    id="editarProducto"
                                                    class="btn btn-warning btn-xs proveedorActualiza"
                                                    data-toggle="modal"
                                                    data-target="#nuevo-proveedor-modal"
                                                    data-id="{{ $proveedor->id }}">
                                                <i class="fa fa-pencil"></i></button>                 </td>
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
    @include('admin.reportes.modals.modal_actualiza')
@endsection
@section('javascript')
    <script>
        var datatable = $('#productos_pedidos').DataTable({
            order: [[ 1, 'desc' ]],
            @include('partials/datatables_lang')
        });

        $('#nuevoProveedor').on('click', function () {
            document.getElementById("idProveedor").value=0;
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
        });

        // Actualiza producto
        $('.proveedorActualiza').on('click', function () {
            var id = $(this).data("id");
            $.ajax({
                url: "{{ url('/admin/consulta_proveedor') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function (data) {
                    console.log(data);
                    document.getElementById("idProveedor").value = data[0].id;
                    $("#nombreProveedor").val(data[0].name);
                    $("#nombreContactoProveedor").val(data[0].contactname);
                    $("#taxProveedor").val(data[0].tax);
                    document.getElementById("direccionProveedor").value = data[0].direction;
                    document.getElementById("paisProveedor").value = data[0].country;
                    document.getElementById("tlefonoProveedor").value = data[0].phone;
                    document.getElementById("correoProveedor").value = data[0].email;
                    document.getElementById("bank_account").value = data[0].bank_account;
                    document.getElementById("bank_address").value = data[0].bank_address;
                    document.getElementById("swift").value = data[0].swift;
                },
                error: function (data) {
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
                    if($("#idProveedor").val() != 0) {
                        $.ajax({
                            type: "POST",
                            url: '{{route("proveedor.update")}}',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                idProveedor: $('#idProveedor').val(),
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
                                document.getElementById("idProveedor").value=0;
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
                            }
                        });
                    } else {
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
                            }
                        });
                    }

                }
            });
        });

        $(document).ready(function () {
            $('#modal-danger-proveedor').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $('#deleteProveedor').attr("href", "{{ url('/admin/elimina_proveedor') }}" + "/" + id);
            });
        });

    </script>
@endsection
