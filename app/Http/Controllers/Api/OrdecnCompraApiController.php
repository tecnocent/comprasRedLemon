<?php

namespace App\Http\Controllers\Api;

use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Log;

class OrdecnCompraApiController extends Controller
{
    private $mOrdenCompra;

    public function __construct(OrdenCompra $ordenCompra)
    {
        $this->mOrdenCompra = $ordenCompra;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $oRequest)
    {
        // Regresa todos los registros activos y borrados paginados
        try {
            // Verifica las variables para despliegue de datos
            $oValidator = Validator::make($oRequest->all(), [
                'per_page' => 'numeric|between:5,100',
                'order' => 'max:30',
                'search' => 'max:100',
                'sort' => 'in:asc,desc',
            ]);
            if ($oValidator->fails()) {
                return response()->json(["status" => "fail", "data" => ["errors" => $oValidator->errors()]]);
            }
            // Filtros
            $sFiltro = $oRequest->input('search', false);
            $sEncargado = $oRequest->input('encargdo_interno', false);
            $sPoCreada = $oRequest->input('po_creada', false);
            $sBorrador = $oRequest->input('borrador', false);
            $sPiPdido = $oRequest->input('pi_pedido', false);
            $sPorAutorizar = $oRequest->input('por_autorizar', false);
            $sProduccion = $oRequest->input('produccion', false);
            $sEnviado = $oRequest->input('enviado', false);
            $sAduana = $oRequest->input('aduana', false);
            $sRecepcion =  $oRequest->input('recepcion', false);
            $sCancelado = $oRequest->input('cancelado', false);
            $sAlmacen = $oRequest->input('almacen', false);
            $sIdentificador = $oRequest->input('identificador', false);
            $aOrdenes = $this->mOrdenCompra
                ->with('proveedor')
                ->where(
                    function ($q) use ($sIdentificador) {
                        if ($sIdentificador !== false) {
                            return $q
                                ->orWhere('identificador', '=', "%$sIdentificador%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sEncargado) {
                        if (!empty($sEncargado)) {
                            return $q
                                ->orWhere('encargdo_interno', 'like', "%$sEncargado%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sPoCreada) {
                        if (!empty($sPoCreada) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sPoCreada%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sBorrador) {
                        if (!empty($sBorrador) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sBorrador%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sPiPdido) {
                        if (!empty($sPiPdido) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sPiPdido%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sPorAutorizar) {
                        if (!empty($sPorAutorizar) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sPorAutorizar%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sProduccion) {
                        if (!empty($sProduccion) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sProduccion%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sEnviado) {
                        if (!empty($sEnviado) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sEnviado%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sAduana) {
                        if (!empty($sAduana) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sAduana%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sRecepcion) {
                        if (!empty($sRecepcion) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sRecepcion%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sCancelado) {
                        if (!empty($sCancelado) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sCancelado%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sAlmacen) {
                        if (!empty($sAlmacen) ) {
                            return $q
                                ->orWhere('status', 'like', "%$sAlmacen%");
                        }
                    }
                )
                ->orderBy($oRequest->input('order', 'created_at'), $oRequest->input('sort', 'desc'))
                ->paginate((int) $oRequest->input('per_page', 25));
            //dd($sPoCreada);
            // Envía datos paginados
            return response()->json(["status" => "success", "data" => ["ordenes" => $aOrdenes]]);
        } catch (\Exception $e) {
            // Registra error
            Log::error('Error en '.__METHOD__.' línea '.$e->getLine().':'.$e->getMessage());
            return ejsend_error([
                'code' => 500,
                'type' => 'Orden',
                'message' => 'Error al obtener el recurso: '.$e->getMessage(),
            ]);
        }
    }
}
