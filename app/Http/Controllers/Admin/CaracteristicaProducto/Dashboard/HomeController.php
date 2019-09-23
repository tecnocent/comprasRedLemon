<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\DisenoProducto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Log;

class HomeController extends Controller
{
    protected $mUser;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home')->with(['encargados' => $this->mUser->all()]);
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
orden_compra.id as orden_compra_id

from products, productos_orden_compra, orden_compra, providers

where productos_orden_compra.producto_id = products.id
            and productos_orden_compra.orden_compra_id = orden_compra.id
            and orden_compra.proveedor_id = providers.id
          
        "));

        foreach($productos as $producto) {
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
}