<?php

namespace App\Http\Controllers\Reportes;

use App\Models\DisenoProducto;
use App\Models\GastosOrigenOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\PagoMontoOrdenCompra;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReporteController extends Controller
{
    protected $mUser;
    protected $array_productos = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $usuario)
    {
        $this->middleware('auth');
        $this->mUser = $usuario;
    }

    public function reporteProductosPedidos()
    {
        $productos = DB::select(DB::raw("
        SELECT 
        products.id as producto_id,
        products.sku as sku,
products.name as producto,
products.variante as variante,
providers.name as proveedor,
productos_orden_compra.cantidad as qty,
productos_orden_compra.costo as price,
orden_compra.status as status_orden,
orden_compra.metodo_envio as metodo_envio,
orden_compra.guia as guia,
orden_compra.fecha_inicio as fecha_inicio_po,
orden_compra.id as orden_compra_id,
orden_compra.identificador as orden_compra_identificador

from products, productos_orden_compra, orden_compra, providers

where productos_orden_compra.producto_id = products.id
            and productos_orden_compra.orden_compra_id = orden_compra.id
            and orden_compra.proveedor_id = providers.id
          
        "));

        foreach ($productos as $producto) {
            $producto_diseno_orden = DisenoProducto::where('orden_compra_id', $producto->orden_compra_id)
                ->where('producto_id', $producto->producto_id)
                ->first();

            $diseno_oem_estatus = $producto_diseno_orden ? $producto_diseno_orden->status_oem_diseno : '-';
            $diseno_oem_estatus = $diseno_oem_estatus == null ? '-' : $diseno_oem_estatus;
            $producto->status_oem_diseno = $diseno_oem_estatus;
        }

        return view('admin.reportes.productos_pedidos')
            ->with([
                'encargados' => $this->mUser->all(),
                'productos' => $productos
            ]);
    }

    public function reporteDetalleOrden(OrdenCompra $ordenCompra)
    {
        $gastos_origen = GastosOrigenOrdenCompra::where('orden_compra_id', $ordenCompra->id)
            ->get();
        $total_gastos_origen = $gastos_origen->sum('costo');

        $pagos = PagoMontoOrdenCompra::where('orden_compra_id', $ordenCompra->id)
            ->get();
        $total_pagos = $pagos->sum('pago');

        $productos = DB::select(DB::raw("
        SELECT 
        products.id as producto_id,
        products.sku as sku,
products.name as producto,
products.variante as variante,
productos_orden_compra.cantidad as qty,
productos_orden_compra.costo as price,
productos_orden_compra.total as total

from products, productos_orden_compra

where productos_orden_compra.producto_id = products.id
            and productos_orden_compra.orden_compra_id = ?
        "), [$ordenCompra->id]);

        $total_productos = 0;
        foreach ($productos as $producto) {
            $producto_diseno_orden = DisenoProducto::where('orden_compra_id', $ordenCompra->id)
                ->where('producto_id', $producto->producto_id)
                ->first();

            $diseno_oem_estatus = $producto_diseno_orden ? $producto_diseno_orden->status_oem_diseno : '-';
            $diseno_oem_estatus = $diseno_oem_estatus == null ? '-' : $diseno_oem_estatus;
            $producto->status_oem_diseno = $diseno_oem_estatus;

            $total_productos += $producto->total;
        }

        return view('admin.reportes.detalle_orden')
            ->with([
                'productos' => $productos,
                'total_productos' => $total_productos,
                'total_gastos_origen' => $total_gastos_origen,
                'total_pagos' => $total_pagos,
                'ordenCompra' => $ordenCompra,
                'gastosOrigen' => $gastos_origen,
                'pagos' => $pagos
            ]);
    }

    public function reporteCostos()
    {
        $productos = DB::select(DB::raw("
        SELECT 
        products.id as producto_id,
        products.sku as sku,
products.name as producto,
productos_orden_compra.cantidad as qty,
productos_orden_compra.costo as price,
productos_orden_compra.total as total,
orden_compra.identificador as orden_compra_identificador,
orden_compra.id as orden_compra_id,
orden_compra.fecha_recepcion as fecha_recepcion

from products, productos_orden_compra, orden_compra

where productos_orden_compra.producto_id = products.id
            and productos_orden_compra.orden_compra_id = orden_compra.id
            and orden_compra.fecha_recepcion is not null
            and orden_compra.status = 'recepcion'"));

        foreach ($productos as $producto) {
            $this->buscarSkuEnArray($producto);
        }

        return view('admin.reportes.costos')->with([
            'productos' => $this->array_productos
        ]);
    }

    public function buscarSkuEnArray($item)
    {
        $index = 0;
        $found = false;
        foreach ($this->array_productos as $producto) {
            if ($producto->sku == $item->sku) {
                $found = true;
                if (Carbon::parse($producto->fecha_recepcion) > Carbon::parse($item->fecha_recepcion)) {
                    //
                } else {
                    unset($this->array_productos[$index]);
                    $found = false;
                }

                break;
            }
            $index++;
        }

        if (!$found) {
            array_push($this->array_productos, $item);
        }
    }

    public function reporteCostoDetalle($sku)
    {
        Log::info($sku);

        $productos = DB::select(DB::raw("
        SELECT 
        orden_compra.id as orden_compra_id,
        orden_compra.identificador as orden_compra_identificador,
        providers.name as proveedor,
        orden_compra.fecha_recepcion as fecha_recepcion,
        productos_orden_compra.cantidad as qty,
        productos_orden_compra.costo as price
        
from products, productos_orden_compra, orden_compra, providers

where productos_orden_compra.producto_id = products.id
            and productos_orden_compra.orden_compra_id = orden_compra.id
            and orden_compra.fecha_recepcion is not null
            and orden_compra.status = 'recepcion'
            and orden_compra.proveedor_id = providers.id
            and products.sku = $sku"));

        return view('admin.reportes.costos_detalle')->with([
            'productos' => $productos,
            'sku' => $sku
        ]);

    }
}
