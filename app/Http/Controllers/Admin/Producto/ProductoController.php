<?php

namespace App\Http\Controllers\Admin\Producto;

use App\Models\ProductoOrdenCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    protected $mProducto;

    public function __construct(ProductoOrdenCompra $producto)
    {
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
                    'total' => $aProductos['subtotal_producto'],
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
                    'producto_id' => $aProductos['producto_id'],
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
}
