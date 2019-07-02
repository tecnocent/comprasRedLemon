@extends('layouts.app')

@section('content')
    <style>
        .select2-selection {
            height: 32px !important;
        }
        .diseno{
            font-size: 10px;
        }
        .formPrincipal {
            height: 68px;
        }

    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content" style="margin-top:0px"><br>
        <!-- Content Header (Page header) -->
        <section class="content">
            <h1 style="margin-top:-20px"> Nueva Orden de Compra<small> Creación</small> </h1>
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <div class="">
                        <!-- Formulario -->
                        <form role="form" method="POST" action="{{route('orden.save')}}">
                            {{ csrf_field() }}
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Ingresa los datos para crear una orden de compra</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for=""># OC</label>
                                        <input type="text" class="form-control" id="id_orden" name="id_orden" placeholder="Ingresa el ID de OC">
                                        @if ($errors->has('id_orden'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('id_orden') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Encargado interno</label>
                                        <select class="form-control" name="encargado">
                                            <option value="">Selecciona</option>
                                            @foreach ($usuarios as $usuaio)
                                                <option value="{{ $usuaio->name }}">{{ $usuaio->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('encargado'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('encargado') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Proveedor</label>
                                        <select class="form-control" name="proveedor">
                                            <option value="">Selecciona</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}">{{ $proveedor->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('proveedor'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('proveedor') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Fecha inicio</label>
                                        <input type="text" class="form-control pull-right datepicker" id="fecha_inicio" name="fecha_inicio">
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Almacen de llegada</label>
                                        <select class="form-control" name="almacen_llegada">
                                            <option value="">Selecciona</option>
                                            @foreach ($almacenes as $almacen)
                                                <option value="{{ $almacen->id }}">{{ $almacen->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('almacen_llegada'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('almacen_llegada') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Tipo de compra</label>
                                        <select class="form-control" name="tipo_compra">
                                            <option value="">Selecciona</option>
                                            <option value="resurtido">Resurtido</option>
                                            <option value="nuevo">Nuevo</option>
                                            <option value="mixto">Mixto</option>
                                        </select>
                                        @if ($errors->has('tipo_compra'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('tipo_compra') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6 formPrincipal">
                                        <label for="">Requerimiento</label>
                                        <select class="form-control" name="requerimiento">
                                            <option value="">Selecciona</option>
                                            <option value="normal"> Normal</option>
                                            <option value="urgente">Urgente</option>
                                        </select>
                                        @if ($errors->has('requerimiento'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('requerimiento') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">Descripción</label>
                                        <textarea class="form-control" rows="3" placeholder="Ingresa la descripción" name="descripcion_oc"></textarea>
                                        @if ($errors->has('descripcion_oc'))
                                            <span class="invalid-feedback" role="alert" style="color: red">
                                                {{ $errors->first('descripcion_oc') }}
                                            </span>
                                        @endif
                                    </div>

                                    <input type="hidden" class="form-control" id="status" name="status">
                                    <br>
                                    <div id="exTab3" class="form-group col-sm-12">
                                        <ul  class="nav nav-pills">
                                            <li class="active">
                                                <a  href="#1b" data-toggle="tab">Productos</a>
                                            </li>
                                            <li>
                                                <a href="#2b" data-toggle="tab">Gastos Origen</a>
                                            </li>
                                            <li>
                                                <a href="#3b" data-toggle="tab">Gastos Destino</a>
                                            </li>
                                            <li>
                                                <a href="#4b" data-toggle="tab">Diseño</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content clearfix">
                                            <div class="tab-pane active" id="1b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal2" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Agregar producto</button>
                                                <div class="row" id="table2">
                                                    <table id="" class="table table-striped table-bordered productos" cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>SKU</th>
                                                            <th>Producto</th>
                                                            <th>Cantidad</th>
                                                            <th>Costo</th>
                                                            <th>Total</th>
                                                            <th>Incoterm</th>
                                                            <th>Lead Time</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="2b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal3" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Nuevo gasto de origen</button>
                                                <div class="row" id="table2">
                                                    <table id="gastosOrigen" class="table table-striped table-bordered gastosOrigen" cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Tipo de gasto</th>
                                                            <th>Costo (USD)</th>
                                                            <th>Notas</th>
                                                            <th>Archivos</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="3b">
                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal4" style="margin-bottom: 7px;"><i class="fa fa-plus"></i> Nuevo gasto de destino</button>
                                                <div class="row" id="table3">
                                                    <table id="gastosDestino" class="table table-striped table-bordered gastosDestino" cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Tipo de gasto</th>
                                                            <th>Costo</th>
                                                            <th>Moneda</th>
                                                            <th>Notas</th>
                                                            <th>Comprobante</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="4b">
                                                <div class="row" id="table4">
                                                    <table id="diseno" class="table table-striped table-bordered diseno" cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>SKU</th>
                                                            <th>Producto</th>
                                                            <th>Descripción</th>
                                                            <th>¿Logo en producto?</th>
                                                            <th>¿OEM BOX?</th>
                                                            <th>¿Instructivo?</th>
                                                            <th>Archivos Die-Cut Fabricante</th>
                                                            <th>Archivos autorizados Diseño</th>
                                                            <th>Tipo</th>
                                                            <th>Fecha requerida</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <br>
                                    <button type="submit" class="btn btn-success pull-right" id="po_creada">Guardar como PO creada</button>
                                    <button type="submit" class="btn btn-primary pull-right" id="borrador" style="margin-right: 10px;">Guardar como borrador</button>
                                </div>
                            </div>
                        </form>
                        <!-- /. Formulario -->
                    </div>
                </section>
            </div>
        </section>
    </div>
    <!-- Modals-->
    @extends('admin.ordenes.modals')
    @section('javascript')
        <script>
            //Status de la orden
            $("#borrador").click(function () {
                $("#status").val('borrador');
            });
            $("#po_creada").click(function () {
                $("#status").val('po creada');
            });
        </script>
        <script src="{{asset('js/sistema/admin/orden_compra/orden_compra.js')}}"></script>
    @stop
@endsection