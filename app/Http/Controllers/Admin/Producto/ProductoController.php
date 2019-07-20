<?php

namespace App\Http\Controllers\Admin\Producto;

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
                $logo = (in_array('logo', $aProductos)) ? true : false;
                $oem = (in_array('oem', $aProductos)) ? true : false;
                $instructivo = (in_array('instructivo', $aProductos)) ? true : false;

                // @todo:: Hacer la logica para guardar json de archivos**
                //$archivoFabricante = $aProductos['archivosFabricante'];
                //$archivoDesign = $aProductos['archivosDiseno'];
                //$archivoFabricanteProducto = $archivoFabricante;
                //$archivoDesignProducto = $archivoDesign;
                //$archivoFabricanteProducto = $this->guardaArchivo($archivoFabricanteProducto);
                //$archivoDesignProducto = $this->guardaArchivo($archivoDesignProducto);

                $producto = $this->mProducto->create([
                    'cantidad' => $aProductos['cantidad_producto'],
                    'costo' => $aProductos['costo_producto'],
                    'total' => $aProductos['cantidad_producto'] * $aProductos['costo_producto'],
                    'incoterm' => $aProductos['icoterm_producto'],
                    'leadtime' => $aProductos['leadtime_producto'],
                    'logo' => $logo,
                    'box' => $oem,
                    'instructivo' => $instructivo,
                    'archivo_fabricante' => null, //$archivoFabricanteProducto,
                    'archivo_diseno' => null, //$archivoDesignProducto,
                    'tipo' => $aProductos['tipo'],
                    'fecha_requerida' => $aProductos['fechaRequerida'],
                    'orden_compra_id' => $orden->id,
                    'producto_id' => $aProductos['product_id']
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
            $logo = ($oRequest->logo) ? true : false;
            $oem = ($oRequest->oem) ? true : false;
            $instructivo = ($oRequest->instructivo) ? true : false;
            // @todo:: Hacer la logica para guardar json de archivos**
            //$archivoFabricante = $aProductos['archivosFabricante'];
            //$archivoDesign = $aProductos['archivosDiseno'];
            //$archivoFabricanteProducto = $archivoFabricante;
            //$archivoDesignProducto = $archivoDesign;
            //$archivoFabricanteProducto = $this->guardaArchivo($archivoFabricanteProducto);
            //$archivoDesignProducto = $this->guardaArchivo($archivoDesignProducto);

            $producto = $this->mProducto->find($oRequest->producto_orden_id);
            $producto->update([
                'cantidad' => $oRequest->cantidad_productoM,
                'costo' => $oRequest->costo_productoM,
                'total' => $oRequest->costo_productoM * $oRequest->cantidad_productoM,
                'incoterm' => $oRequest->icoterm_productoM,
                'leadtime' => $oRequest->leadtime_productoM,
                'producto_id' => $oRequest->producto_id
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
        try {
            $logo = ($oRequest->logo) ? true : false;
            $oem = ($oRequest->oem) ? true : false;
            $instructivo = ($oRequest->instructivo) ? true : false;
            // @todo:: Hacer la logica para guardar json de archivos**
            //$archivoFabricante = $aProductos['archivosFabricante'];
            //$archivoDesign = $aProductos['archivosDiseno'];
            //$archivoFabricanteProducto = $archivoFabricante;
            //$archivoDesignProducto = $archivoDesign;
            //$archivoFabricanteProducto = $this->guardaArchivo($archivoFabricanteProducto);
            //$archivoDesignProducto = $this->guardaArchivo($archivoDesignProducto);

            $producto = $this->mProducto->create([
                'cantidad' => $oRequest->cantidad_productoM,
                'costo' => $oRequest->costo_productoM,
                'total' => $oRequest->costo_productoM * $oRequest->cantidad_productoM,
                'incoterm' => $oRequest->icoterm_productoM,
                'leadtime' => $oRequest->leadtime_productoM,
                'logo' => $logo,
                'box' => $oem,
                'instructivo' => $instructivo,
                'archivo_fabricante' => null, //$archivoFabricanteProducto,
                'archivo_diseno' => null, //$archivoDesignProducto,
                'tipo' => $oRequest->tipo,
                'fecha_requerida' => $oRequest->fechaRequerida,
                'orden_compra_id' => $orden,
                'producto_id' => $oRequest->producto_id
            ]);

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
}
