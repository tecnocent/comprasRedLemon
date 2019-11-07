<!--Modal Nuevo Proveedor-->
<div class="modal right1 fade" id="nuevo-proveedor-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario -->
            <form id="proveedor-form" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" name="x" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Proveedor</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="hidden" class="form-control" placeholder="Nombre" id="idProveedor" name="idProveedor">
                                        <input type="text" class="form-control" placeholder="Nombre" id="nombreProveedor" name="nombreProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Nombre de contacto</label>
                                        <input type="text" class="form-control" placeholder="Nombre de contacto" id="nombreContactoProveedor" name="nombreContactoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Tax</label>
                                        <input type="text" class="form-control" placeholder="Tax" id="taxProveedor" name="taxProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" placeholder="Dirección" id="direccionProveedor" name="direccionProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>País</label>
                                        <input type="text" class="form-control" placeholder="País" id="paisProveedor" name="paisProveedor">
                                    </div>
                                </div>
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" class="form-control" placeholder="Telefono" id="tlefonoProveedor" name="tlefonoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="email" class="form-control" placeholder="Correo" id="correoProveedor" name="correoProveedor">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Cuanta bancaria</label>
                                        <input type="text" class="form-control" placeholder="Cuanta bancaria" id="bank_account" name="bank_account">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Dirección Banco</label>
                                        <input type="text" class="form-control" placeholder="Dirección Banco" id="bank_address" name="bank_address">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-6 line">
                                    <div class="form-group">
                                        <label>Código Swift</label>
                                        <input type="text" class="form-control" placeholder="Swift" id="swift" name="swift">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="guardarProveedor" id="guardarProveedor">Guardar</button>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
</div><!-- modal -->

<div class="modal modal-danger fade" id="modal-danger-proveedor" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro de borrar el proveedor?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a id="deleteProveedor" role="button" class="btn btn-outline"><i class="fa fa-trash"></i> Borrar</a>
            </div>
        </div>
    </div>
</div>