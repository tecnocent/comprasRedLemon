<!-- Producto Nuevo -->
<div class="modal right1 fade" id="nuevo-producto-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="nuevo-producto-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo producto</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input type="text" class="form-control" placeholder="SKU" id="sku_producto_nuevo" name="sku_producto_nuevo">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre de producto</label>
                                        <input type="text" class="form-control" placeholder="Nombre de producto" id="nombre_producto_nuevo" name="nombre_producto_nuevo">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Costo</label>
                                        <input type="text" class="form-control" placeholder="Costo" id="costo_producto_nuevo" name="costo_producto_nuevo">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Precio venta al por menor</label>
                                        <input type="text" class="form-control" placeholder="Precio venta al por menor" id="precio_menudeo_producto_nuevo" name="precio_menudeo_producto_nuevo">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Codigo SAT</label>
                                        <input type="text" class="form-control" placeholder="Codigo SAT" id="sat_producto_nuevo" name="sat_producto_nuevo">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" id="tipo_producto_nuevo" name="tipo_producto_nuevo">
                                            <option value="">Selecciona</option>
                                            <option value="1">No Definido</option>
                                            <option value="2">Normal</option>
                                            <option value="3">Nuevo</option>
                                            <option value="4">Descontinuado</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-12 line">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" rows="3" id="descripcion_producto_nuevo" name="descripcion_producto_nuevo"></textarea>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="guardarProveedor">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->
