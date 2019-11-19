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
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">comercial_invoice</h3>
                        <h4>{{ $orden->comercial_invoice }}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group col-sm-6 formPrincipal">
                        <h3 for="">CBM</h3>
                        <h4>{{ $orden->CBM }}</h4>
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
        <!-- Seguimiento producto -->
        @if(count($seguimientos) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Seguimiento a productos</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
                            <table id="seguimiento" class="table table-striped table-bordered seguimiento" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sku</th>
                                    <th>Producto</th>
                                    <th>Preproducción</th>
                                    <th>Producción</th>
                                    <th>OEM 1</th>
                                    <th>OEM 2</th>
                                    <th>OEM 3</th>
                                    <th>Empaquetado</th>
                                </tr>
                                </thead>
                                @foreach($seguimientos as $seguimiento)
                                    <tr>
                                        <td>{{ $seguimiento->productoOrden->sku }}</td>
                                        <td>{{ $seguimiento->productoOrden->name }}</td>
                                        @if($seguimiento->foto_preproduccion)
                                            <td>
                                                <img class="imgZoom" src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_preproduccion}}" alt="produccion" height="70" width="70">
                                            </td>
                                        @else
                                            <td>No hay foto</td>
                                        @endif
                                        @if($seguimiento->foto_produccion)
                                            <td>
                                                <img class="imgZoom" src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_produccion}}" alt="produccion" height="70" width="70">
                                            </td>
                                        @else
                                            <td>No hay foto</td>
                                        @endif
                                        @if($seguimiento->foto_oem_uno)
                                            <td>
                                                <img class="imgZoom" src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_oem_uno}}" alt="produccion" height="70" width="70">
                                            </td>
                                        @else
                                            <td>No hay foto</td>
                                        @endif
                                        @if($seguimiento->foto_oem_dos)
                                            <td>
                                                <img class="imgZoom" src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_oem_dos}}" alt="produccion" height="70" width="70">
                                            </td>
                                        @else
                                            <td>No hay foto</td>
                                        @endif
                                        @if($seguimiento->foto_oem_tres)
                                            <td>
                                                <img class="imgZoom" src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_oem_tres}}" alt="produccion" height="70" width="70">
                                            </td>
                                        @else
                                            <td>No hay foto</td>
                                        @endif
                                        @if($seguimiento->foto_empaquetado)
                                            <td>
                                                <img class="imgZoom" src="{{asset('documents/orden_compra/images/')}}/{{$seguimiento->foto_empaquetado}}" alt="produccion" height="70" width="70">
                                            </td>
                                        @else
                                            <td>No hay foto</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Caracterisrtica producto -->
        @if(count($caracteristicas) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Caracteristicas de productos</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
                            <table id="seguimiento" class="table table-striped table-bordered seguimiento" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sku</th>
                                    <th>Producto</th>
                                    <th>Especificaciones del producto</th>
                                    <th>Especificaciones electricas</th>
                                    <th>Link Amazon</th>
                                    <th>Link Alibaba</th>
                                </tr>
                                </thead>
                                @foreach($caracteristicas as $caracteristica)
                                    <tr>
                                        <td>{{ $caracteristica->producto->sku }}</td>
                                        <td>{{ $caracteristica->producto->name }}</td>
                                        <td>{{ $caracteristica->especificaciones_producto }}</td>
                                        <td>{{ $caracteristica->especificaciones_electricas }}</td>
                                        <td>
                                            @if ($caracteristica->link_amazon)
                                                <a href="{{ $caracteristica->link_amazon }}" class="btn btn-link" target="_blank">Link Amazon</a>
                                            @else
                                                No hay link
                                            @endif
                                        </td>
                                        <td>
                                            @if ($caracteristica->link_alibaba)
                                                <a href="{{ $caracteristica->link_alibaba }}" class="btn btn-link" target="_blank">Link Alibaba</a>
                                            @else
                                                No hay link
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Caracterisrtica producto -->
        @if(count($clasificaciones) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Clasificación Aduanera</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body">
                            <table id="seguimiento" class="table table-striped table-bordered seguimiento" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sku</th>
                                    <th>Producto</th>
                                    <th>Clasiricacion arancelaria</th>
                                    <th>NOM 1</th>
                                    <th>NOM 2</th>
                                    <th>NOM 3</th>
                                    <th>NOM 4</th>
                                </tr>
                                </thead>
                                @foreach($clasificaciones as $clasificacion)
                                    <tr>
                                        <td>{{ $clasificacion->producto->sku }}</td>
                                        <td>{{ $clasificacion->producto->name }}</td>
                                        <td>{{ $clasificacion->clasificacion_arancelaria }}</td>
                                        <td>{{ $clasificacion->nom_1 }}</td>
                                        <td>{{ $clasificacion->nom_2 }}</td>
                                        <td>{{ $clasificacion->nom_3 }}</td>
                                        <td>{{ $clasificacion->nom_4 }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <!-- Diseño producto -->
        @if(count($disenos) > 0)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="">Diseño de producto</h2>
                </div>
                <div class="panel-body">
                    <div class="row" id="table2">
                        <div class="panel-body table-responsive">
                            <table id="diseno" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>¿OEM?</th>
                                    <th>¿Instructivo?</th>
                                    <th>¿Empaque?</th>
                                    <th>Fecha aviso diseño</th>
                                    <th>Producto listo diseño</th>
                                    <th>Empaque listo diseño</th>
                                    <th>Instructivo listo diseño</th>
                                    <th>OEM autorizado por trafico</th>
                                    <th>Fecha autorizacion trafico</th>
                                    <th>Archivos Diseño</th>
                                    <th>Archivos Fabricante</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($disenos as $diseno)
                                    <tr>
                                        <td>{{ $diseno->producto->name }} {{ $diseno->producto->variant }}</td>
                                        <td>{{ ($diseno->oem == true) ? 'SI' : 'NO'  }}</td>
                                        <td>{{ ($diseno->instructivo == true) ? 'SI' : 'NO'  }}</td>
                                        <td>{{ ($diseno->empaque == true) ? 'SI' : 'NO'  }}</td>
                                        <td>{{ $diseno->fecha_aviso_diseno }}</td>
                                        @if($diseno->producto_diseno)
                                            <td><a href="{{ url('/admin/orden/descarga') }}/{{ $diseno->producto_diseno }}" class="btn btn-link">Descargar</a></td>
                                        @else
                                            <td>No hay archivo</td>
                                        @endif
                                        @if($diseno->empaque_diseno)
                                            <td><a href="{{ url('/admin/orden/descarga') }}/{{ $diseno->empaque_diseno }}" class="btn btn-link">Descargar</a></td>
                                        @else
                                            <td>No hay archivo</td>
                                        @endif
                                        @if($diseno->instructivo_diseno)
                                            <td><a href="{{ url('/admin/orden/descarga') }}/{{ $diseno->instructivo_diseno }}" class="btn btn-link">Descargar</a></td>
                                        @else
                                            <td>No hay archivo</td>
                                        @endif
                                        @if($diseno->oem_autorizado_trafico)
                                            <td><a href="{{ url('/admin/orden/descarga') }}/{{ $diseno->oem_autorizado_trafico }}" class="btn btn-link">Descargar</a></td>
                                        @else
                                            <td>No hay archivo</td>
                                        @endif
                                        <td>{{ $diseno->fecha_autorizacion_trafico }}</td>
                                        @if($diseno->archivos_fabricante)
                                            <td>
                                                <?php
                                                foreach (json_decode($diseno->archivos_fabricante) as $fileFab => $key) {
                                                    echo '<a href="'.url("/admin/orden/descarga").'/'.$key.'" class="btn btn-link">Descargar</a>';
                                                }
                                                ?>
                                            </td>
                                        @else
                                            <td>No hay archivo</td>
                                        @endif
                                        @if($diseno->archivos_diseno)
                                            <td>
                                                <?php
                                                foreach (json_decode($diseno->archivos_diseno) as $fileDiseno => $key) {
                                                    echo '<a href="'.url("/admin/orden/descarga").'/'.$key.'" class="btn btn-link">Descargar</a>';
                                                }
                                                ?>
                                            </td>
                                        @else
                                            <td>No hay archivo</td>
                                        @endif
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