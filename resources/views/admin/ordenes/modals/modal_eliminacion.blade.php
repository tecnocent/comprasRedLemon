<!-- Modals-->
<div class="modal modal-danger fade" id="modal-danger-productos" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro de borrar el producto de la orden #OC: {{ $orden->identificador }}?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a id="deleteProducto" role="button" class="btn btn-outline"><i class="fa fa-trash"></i> Borrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-danger fade" id="modal-danger-gastos-origen" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro de borrar el gasto origen de la orden #OC: {{ $orden->identificador }}?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a id="deleteGastoOrigen" role="button" class="btn btn-outline"><i class="fa fa-trash"></i> Borrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-danger fade" id="modal-gastos-destino" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro de borrar el gasto destino de la orden #OC: {{ $orden->identificador }}?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a id="deleteGastoDestino" role="button" class="btn btn-outline"><i class="fa fa-trash"></i> Borrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-danger fade" id="modal-danger-transito" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro de borrar el transito de la orden #OC: {{ $orden->identificador }}?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a id="deleteTransito" role="button" class="btn btn-outline"><i class="fa fa-trash"></i> Borrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-danger fade" id="modal-danger-pedimento" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro de borrar el pedimento de la orden #OC: {{ $orden->identificador }}?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a id="deletePedimento" role="button" class="btn btn-outline"><i class="fa fa-trash"></i> Borrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-danger fade" id="modal-danger-pago" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro de borrar el pago de la orden #OC: {{ $orden->identificador }}?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a id="deletePago" role="button" class="btn btn-outline"><i class="fa fa-trash"></i> Borrar</a>
            </div>
        </div>
    </div>
</div>