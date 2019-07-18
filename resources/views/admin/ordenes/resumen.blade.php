@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Orden de compra -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="">Orden de compra</h2>
            </div>
            <div class="panel-body">
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for=""># OC</h3>
                        <h4>{{ $orden->identificador }}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">Estatus</h3>
                        <h4>{{ $orden->status }}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">Encargado interno</h3>
                        <h4>{{ $orden->encargdo_interno }}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">Proveedor</h3>
                        <h4>{{ $orden->proveedor->name }}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">Fecha de inicio</h3>
                        <h4>{{ $orden->fecha_inicio }}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">Almacen de llegada</h3>
                        <h4>{{ $orden->almacen->name }}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">Tipo de compra</h3>
                        <h4>{{ $orden->tipoCompra->nombre }}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">Requerimiento</h3>
                        <h4>{{ $orden->requerimiento }}</h4>
                    </div>
                </div>
                @if($orden->descripcion)
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">Descripción</h3>
                        <h4>{{ $orden->descripcion }}</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- Productos -->
        @if(count($productos) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Productos</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->producto->sku }}</td>
                                        <td>{{ $producto->producto->name }}</td>
                                        <td>{{ $producto->cantidad }}</td>
                                        <td>{{ $producto->costo }}</td>
                                        <td>{{ $producto->total }}</td>
                                        <td>{{ $producto->incoterm }}</td>
                                        <td>{{ $producto->leadtime }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Gastos destino -->
        @if(count($gastosDestino) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Gastos destino</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
                            <table id="gastosDestino" class="table table-striped table-bordered gastosDestino" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Tipo de gasto</th>
                                    <th>Costo</th>
                                    <th>Moneda</th>
                                    <th>Notas</th>
                                    <th>Comprobante</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gastosDestino as $gastoDestino)
                                    <tr>
                                        <td>{{ $gastoDestino->tipoGasto->name }}</td>
                                        <td>{{ $gastoDestino->costo }}</td>
                                        <td>{{ $gastoDestino->moneda }}</td>
                                        <td>{{ $gastoDestino->notas ?? 'Sin registro' }}</td>
                                        <td><a href="{{ url('/admin/orden/descarga') }}/{{$gastoDestino->comprobante}}" class="btn btn-link">Descargar</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Gastos origen -->
        @if(count($gastosOrigen) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Gastos origen</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
                            <table id="gastosOrigen" class="table table-striped table-bordered gastosOrigen" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Tipo de gasto</th>
                                    <th>Costo (USD)</th>
                                    <th>Notas</th>
                                    <th>Archivos</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gastosOrigen as $gastoOrigen)
                                    <tr>
                                        <td>{{ $gastoOrigen->tipoGasto->name }}</td>
                                        <td>{{ $gastoOrigen->costo }}</td>
                                        <td>{{ $gastoOrigen->notas ?? 'Sin registro' }}</td>
                                        <td><a href="{{ url('/admin/orden/descarga') }}/{{$gastoOrigen->comprobante}}" class="btn btn-link">Descargar</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Transito -->
        @if(count($transitos) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Transito</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
                            <table id="transito" class="table table-striped table-bordered transito" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Metodo</th>
                                    <th>Guia</th>
                                    <th>Comercial Invoce</th>
                                    <th>Archivo Comercial Invoce</th>
                                    <th>Fecha embarque</th>
                                    <th>Fecha tentativa llegada</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transitos as $transito)
                                    <tr>
                                        <td>{{ $transito->metodoTransito->nombre }}</td>
                                        <td>{{ $transito->guia }}</td>
                                        <td>{{ $transito->comercual_invoce }}</td>
                                        <td><a href="{{ url('/admin/orden/descarga') }}/{{$transito->comercial_invoce_file}}" class="btn btn-link">Descargar</a></td>
                                        <td>{{ $transito->fecha_embarque }}</td>
                                        <td>{{$transito->fecha_tentativa}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Pedimento -->
        @if(count($pedimentos) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Pedimento</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
                            <table id="pedimento" class="table table-striped table-bordered pedimento" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Pedimento</th>
                                    <th>Pedimento Digital</th>
                                    <th>Aduana</th>
                                    <th>Agente Aduanal</th>
                                    <th>Tipo de Cambio Pedimento</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pedimentos as $pedimento)
                                    <tr>
                                        <td>{{ $pedimento->pedimento }}</td>
                                        <td><a href="{{ url('/admin/orden/descarga') }}/{{$pedimento->pedimento_digital}}" class="btn btn-link">Descargar</a></td>
                                        <td>{{ $pedimento->aduana->nombre }}</td>
                                        <td>{{ $pedimento->agenteAduanal->nombre }}</td>
                                        <td>{{ $pedimento->tipo_cambio_pedimento }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Pagos -->
        @if(count($pagos) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Pagos</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
                            <table id="pagos" class="table table-striped table-bordered pagos" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Pago</th>
                                    <th>Tipo de cambio</th>
                                    <th>Comprobante</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pagos as $pago)
                                    <tr>
                                        <td>{{ $pago->pago }}</td>
                                        <td>{{ $pago->tipo_cambio_pago }}</td>
                                        <td><a href="{{ url('/admin/orden/descarga') }}/{{ $pago->comrpobante }}" class="btn btn-link">Descargar</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    @endif
        <!-- Aceptar -->
        <div class="panel panel-info">
            <div class="panel-body">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Aceptar</a>
                <a href="{{ url('/admin/muestra_orden') }}/{{$orden->id}}" class="btn btn-warning btn-lg pull-right">Editar</a>
            </div>
        </div>
    </div>
@endsection