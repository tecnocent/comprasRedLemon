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
            $aOrdenes = $this->mOrdenCompra
                ->with('proveedor')
                ->where(
                    function ($q) use ($sFiltro) {
                        if ($sFiltro !== false) {
                            return $q
                                ->orWhere('identificador', '=', "%$sFiltro%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sEncargado) {
                        if (!empty($sEncargado)) {
                            return $q
                                ->orWhere('encargdo_interno', '=', $sEncargado);
                        }
                    }
                )
                ->orderBy($oRequest->input('order', 'id'), $oRequest->input('sort', 'asc'))
                ->paginate((int) $oRequest->input('per_page', 25));

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
