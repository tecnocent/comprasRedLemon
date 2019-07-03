<!-- Modals requeridos en creacion de orden de compra -->

<!--Modal 1-->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">Agregar productos</h4>
            </div>

            <div class="modal-body" style="width: 98%; margin-left: 10px;">
                <div class="row" id="table3">
                    <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Incoterm</th>
                            <th>Lead Time</th>
                            <th>Costo (USD)</th>
                            <th>Cantidad</th>
                            <th>Subtotal (USD)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-group extras">
                                    <select id="productosSelect" class="form-control selectProductos" name="nombre_productoM" id="nombre_producto" style=" display: block; width: 100%">
                                        <option value="">Selecciona</option>
                                        @foreach($productos as $producto)
                                            <option value="{{$producto->sku}}">{{$producto->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="icoterm_productoM" id="icoterm_producto">
                                        <option value="">Selecciona</option>
                                        <option value="FOM">FOM</option>
                                        <option value="EXW">EXW</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="leadtime_producto" name="leadtime_productoM" placeholder="Lead Time" onKeyPress="return soloNumeros(event)">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control monto" id="costo_producto" name="costo_productoM" placeholder="Costo" onkeyup="multi();" onkeypress="return filterFloat(event,this);">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control monto" id="cantidad_producto" name="cantidad_productoM" placeholder="Cantidad" onkeyup="multi();" onKeyPress="return soloNumeros(event)">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subtotal_producto" name="subtotal_productoM" placeholder="Subtotal" disabled onkeypress="return filterFloat(event,this);">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="adicionar">Agregar</button>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
</div><!-- modal -->
<!--Modal 2-->
<div class="modal right1 fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form role="form" method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Origen (USD)</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tipo de gasto</label>
                        <select class="form-control" name="tipo_gasto_origenM" id="tipo_gasto_origen">
                            <option value="a">Selecciona</option>
                            @foreach($gastosOrigen as $gastoOrigen)
                                <option value="{{$gastoOrigen->name}}">{{$gastoOrigen->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Costo $ (USD)</label>
                        <input type="text" class="form-control" id="costo_gastos_origen" name="costo_gastos_origenM" placeholder="Costo" onkeypress="return filterFloat(event,this);">
                    </div>
                    <div class="form-group">
                        <label for="">Notas</label>
                        <textarea class="form-control" rows="3" placeholder="Nota ..." name="nota_gastos_origenM" id="nota_gastos_origen"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="adicionarGastoOrigen">Agregar</button>
                </div>
            </form><!-- /. Formulario -->
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->
<!--Modal 3-->
<div class="modal right1 fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form role="form" method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Gasto de Destino</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tipo de gasto</label>
                        <select class="form-control" name="tipo_gasto_gastos_destinoM" id="tipo_gasto_gastos_destino">
                            <option value="1">Selecciona</option>
                            @foreach($gastosDestino as $gastoDestino)
                                <option value="{{$gastoDestino->name}}">{{$gastoDestino->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Costo $</label>
                        <input type="text" class="form-control" id="costo_gastos_destino" name="costo_gastos_destinoM" placeholder="Costo" onkeypress="return filterFloat(event,this);">
                    </div>
                    <div class="form-group">
                        <label for="">Moneda</label>
                        <select class="form-control" name="moneda_gastos_destinoM" id="moneda_gastos_destino">
                            <option value="a">Selecciona</option>
                            <option value="MXN">MXN</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Notas</label>
                        <textarea class="form-control" rows="3" placeholder="Nota ..." name="nota_gastos_destinoM" id="nota_gastos_destino"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="adicionarGastoDestino">Agregar</button>
                </div>
            </form><!-- /. Formulario -->
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

