<?php

namespace App\Http\Controllers\Admin\Producto;

use App\Models\GastosOrigenOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\Producto;
use App\Models\ProductoOrdenCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class ProductoController extends Controller
{
    protected $mProducto;

    public function __construct(ProductoOrdenCompra $producto)
    {
        $this->middleware('auth');
        $this->mProducto = $producto;
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
    public function store($oRequest, $orden)
    {
        try {
            foreach ($oRequest->productos as $aProductos) {
                $producto = $this->mProducto->create([
                    'cantidad' => $aProductos['cantidad_producto'],
                    'costo' => $aProductos['costo_producto'],
                    'total' => $aProductos['cantidad_producto'] * $aProductos['costo_producto'],
                    'incoterm' => $aProductos['icoterm_producto'],
                    'leadtime' => $aProductos['leadtime_producto'],
                    'orden_compra_id' => $orden->id,
                    'producto_id' => $aProductos['producto_id']
                ]);
            }

        } catch (\Exception $e) {
            // Alerta
            $notification = array(
                'message' => 'Algun error ocurrio.',
                'alert-type' => 'warning'
            );
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
            return redirect()->back()->with($notification);
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
    public function update(Request $oRequest)
    {
        try {
            $producto = $this->mProducto->find($oRequest->producto_orden_id);
            $producto->update([
                'cantidad' => $oRequest->cantidad_productoM,
                'costo' => $oRequest->costo_productoM,
                'total' => $oRequest->costo_productoM * $oRequest->cantidad_productoM,
                'incoterm' => $oRequest->icoterm_productoM,
                'leadtime' => $oRequest->leadtime_productoM,
                'producto_id' => $oRequest->producto_id,
                'product_variant_id' => (int)$oRequest->select_variant_id_acualiza,
            ]);

            // Alerta
            $notification = array(
                'message' => 'Producto actualizado correctamente.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Alerta
            $notification = array(
                'message' => 'Algun error ocurrio.',
                'alert-type' => 'warning'
            );
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $producto = $this->mProducto->find($id);
            $producto->delete();
            // Alerta
            $notification = array(
                'message' => 'Producto eliminado de la orden',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Algo salio mal',
                'alert-type' => 'warning'
            );
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @param $archivo
     * @return string
     * @throws \Exception
     */
    private function guardaArchivo($archivo)
    {
        if ($archivo) {
            ///obtenemos el campo file definido en el formulario
            $file = $archivo;
            $nombre = Uuid::generate(1).'.'.$file->getClientOriginalExtension();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));

            return $nombre;
        } else {
            return $nombre = '';
        }
    }

    /**
     * @param Request $oRequest
     * @param $orden
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guardaProducto(Request $oRequest, $orden)
    {
        $producto = Producto::where('sku', $oRequest->nombre_productoM)
            ->first();

        try {
            $producto = $this->mProducto->create([
                'cantidad' => $oRequest->cantidad_productoM,
                'costo' => $oRequest->costo_productoM,
                'total' => $oRequest->costo_productoM * $oRequest->cantidad_productoM,
                'incoterm' => $oRequest->icoterm_productoM,
                'leadtime' => $oRequest->leadtime_productoM,
                'product_variant_id' => (int)$oRequest->product_variant_id,
                'orden_compra_id' => $orden,
                'producto_id' => $producto->id
            ]);

            $total = 0;

            $productos = ProductoOrdenCompra::where('orden_compra_id', $orden)
                ->get();
            foreach ($productos as $producto) {
                $total += $producto->total;
            }

            $gastos_origen = GastosOrigenOrdenCompra::where('orden_compra_id', $orden)
                ->get();
            foreach ($gastos_origen as $gasto_origen) {
                $total += $gasto_origen->costo;
            }

            $orden_compra =  OrdenCompra::findOrFail($orden);
            $orden_compra->total = $total;
            $orden_compra->update();

            // Alerta
            $notification = array(
                'message' => 'Producto agregado correctamente.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Alerta
            $notification = array(
                'message' => 'Algun error ocurrio.',
                'alert-type' => 'warning'
            );
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function consultaProducto($id)
    {
        $producto = $this->mProducto->where('productos_orden_compra.id', $id)->join('products', 'productos_orden_compra.producto_id', '=', 'products.id')
            ->select('productos_orden_compra.*', 'products.sku')->get();
        return response()->json($producto);
    }

    public function guardaIncoterm(Request $request)
    {

    }
}
