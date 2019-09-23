<?php

namespace App\Http\Controllers\Api;

use App\Models\OrdenCompra;
use App\Models\Producto;
use App\Models\ProductoOrdenCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Log;

class ProductoOrdenCompraApiController extends Controller
{
    private $mOrdenCompra;

    public function __construct(OrdenCompra $ordenCompra)
    {
        $this->mOrdenCompra = $ordenCompra;
    }

    public function productosPeidos()
    {
//        $productos = Producto::take(5)->get();
//        Log::info('query...');
//        $productos = DB::select(DB::raw("
//            SELECT distinct products.sku as producto_sku,
//products.name as producto_nombre,
//providers.name as proveedor,
//productos_orden_compra.cantidad as qty,
//productos_orden_compra.costo as price,
//orden_compra.status as status,
//orden_compra.metodo_envio as metodo_envio,
//orden_compra.guia as guia,
//orden_compra.fecha_inicio as fecha_inicio,
//orden_compra.id as orden_compra_id
//
//from products, productos_orden_compra, orden_compra, providers, diseno_producto_orden
//
//where productos_orden_compra.producto_id = products.id
//            and productos_orden_compra.orden_compra_id = orden_compra.id
//            and orden_compra.proveedor_id = providers.id"));

//        Log::info($productos);
//        $productos = $productos[0];
//        Log::info($productos);
//        return view('admin.reportes.productos_pedidos', compact('productos'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $oRequest)
    {
        // Regresa todos los productos en orden de compra
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
            $sRecepcion = $oRequest->input('recepcion', false);
            $sCancelado = $oRequest->input('cancelado', false);
            $sAlmacen = $oRequest->input('almacen', false);
            $sIdentificador = $oRequest->input('identificador', false);

//            $productos_pedidos = ProductoOrdenCompra::
//                has('ordenCompra')
//                ->with('producto', 'ordenCompra.proveedor')
//                ->orderBy($oRequest->input('id', 'created_at'), $oRequest->input('sort', 'desc'))
//                ->paginate((int)$oRequest->input('per_page', 25));

//            SELECT products.sku as producto_sku,
//products.name as producto_nombre,
//providers.name as proveedor,
//productos_orden_compra.cantidad as qty,
//productos_orden_compra.costo as price,
//orden_compra.status as status,
//orden_compra.metodo_envio as metodo_envio,
//orden_compra.guia as guia,
//orden_compra.fecha_inicio as fecha_inicio,
//orden_compra.id as orden_compra_id,
//
//from products, productos_orden_compra, orden_compra, providers, diseno_producto_orden
//
//where productos_orden_compra.producto_id = products.id
//            and productos_orden_compra.orden_compra_id = orden_compra.id
//            and orden_compra.proveedor_id = providers.id

            $query = DB::select(DB::raw("            
            SELECT distinct products.sku as producto_sku,
products.name as producto_nombre,
providers.name as proveedor,
productos_orden_compra.cantidad as qty,
productos_orden_compra.costo as price,
orden_compra.status as status,
orden_compra.metodo_envio as metodo_envio,
orden_compra.guia as guia,
orden_compra.fecha_inicio as fecha_inicio,
orden_compra.id as orden_compra_id

from products, productos_orden_compra, orden_compra, providers, diseno_producto_orden

where productos_orden_compra.producto_id = products.id
            and productos_orden_compra.orden_compra_id = orden_compra.id
            and orden_compra.proveedor_id = providers.id"));

//                $productos_pedidos = ProductoOrdenCompra::with(
//                    'ordenCompra',
//                    'producto',
//                    'ordenCompra.proveedor'
//                )
//                ->orderBy($oRequest->input('order', 'created_at'), $oRequest->input('sort', 'desc'))
//                ->paginate((int) $oRequest->input('per_page', 25));

//            $perPage = $oRequest->input("per_page", 25);
//            $page = $oRequest->input("page", 1);
//            $skip = $page * $perPage;
//            if($take < 1) { $take = 1; }
//            if($skip < 0) { $skip = 0; }

//            Log::info(json_encode($query));
            $result = collect($query);
//            Log::info($result);
//            Log::info($result->count());
//            $totalCount = $query->count();
//            $results = $query
//                ->take((int)$oRequest->input('per_page', 25))
//                ->get();

//            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($results, $totalCount, $take, $page);


//            Log::info(json_encode($paginator));
//            Log::info($totalCount);

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
                        if (!empty($sPoCreada)) {
                            return $q
                                ->orWhere('status', 'like', "%$sPoCreada%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sBorrador) {
                        if (!empty($sBorrador)) {
                            return $q
                                ->orWhere('status', 'like', "%$sBorrador%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sPiPdido) {
                        if (!empty($sPiPdido)) {
                            return $q
                                ->orWhere('status', 'like', "%$sPiPdido%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sPorAutorizar) {
                        if (!empty($sPorAutorizar)) {
                            return $q
                                ->orWhere('status', 'like', "%$sPorAutorizar%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sProduccion) {
                        if (!empty($sProduccion)) {
                            return $q
                                ->orWhere('status', 'like', "%$sProduccion%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sEnviado) {
                        if (!empty($sEnviado)) {
                            return $q
                                ->orWhere('status', 'like', "%$sEnviado%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sAduana) {
                        if (!empty($sAduana)) {
                            return $q
                                ->orWhere('status', 'like', "%$sAduana%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sRecepcion) {
                        if (!empty($sRecepcion)) {
                            return $q
                                ->orWhere('status', 'like', "%$sRecepcion%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sCancelado) {
                        if (!empty($sCancelado)) {
                            return $q
                                ->orWhere('status', 'like', "%$sCancelado%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sAlmacen) {
                        if (!empty($sAlmacen)) {
                            return $q
                                ->orWhere('status', 'like', "%$sAlmacen%");
                        }
                    }
                )
                ->orderBy($oRequest->input('order', 'created_at'), $oRequest->input('sort', 'desc'))
                ->paginate((int)$oRequest->input('per_page', 25));

            Log::info($aOrdenes);
            Log::info($result);
            // Envía datos paginados
//            return response()->json([
//                "status" => "success",
//                "data" => [
//                    "ordenes" => $aOrdenes,
//                    "productos_pedidos" => $result
//                ]
//            ]);

            return view('admin.reportes.productos_pedidos', compact($result));
        } catch (\Exception $e) {
            // Registra error
            Log::error('Error en ' . __METHOD__ . ' línea ' . $e->getLine() . ':' . $e->getMessage());
            return ejsend_error([
                'code' => 500,
                'type' => 'Orden',
                'message' => 'Error al obtener el recurso: ' . $e->getMessage(),
            ]);
        }
    }
}
