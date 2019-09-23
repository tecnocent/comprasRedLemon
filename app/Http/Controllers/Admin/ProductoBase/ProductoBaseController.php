<?php

namespace App\Http\Controllers\Admin\ProductoBase;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class ProductoBaseController extends Controller
{
    protected $mProductoBase;

    public function __construct(Producto $producto)
    {
        $this->middleware('auth');
        $this->mProductoBase = $producto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $oRequest)
    {
        try {
            $productoNuevo = $this->mProductoBase->create([
                'sku' => $oRequest->sku_producto_nuevo,
                'name' => $oRequest->nombre_producto_nuevo,
                'cost' => $oRequest->costo_producto_nuevo,
                'retail_sell_price' => $oRequest->precio_menudeo_producto_nuevo,
                'sat_code' => $oRequest->sat_producto_nuevo,
                'variante' => $oRequest->variante_producto_nuevo,
                'description' => $oRequest->descripcion_producto_nuevo,
                'purchase_product_status_id' => $oRequest->tipo_producto_nuevo
            ]);

            // Alerta
            $notification = array(
                'message' => 'Producto agregado correctamente.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
