<?php

namespace App\Http\Controllers\Api;

use App\Models\CaracteristicaProducto;
use App\Models\ClasificacionAduanera;
use App\Models\Producto;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Validator;

class ProductoApiController extends Controller
{
    private $mVariant;
   
    private $mProduto;

    public function __construct(Producto $producto, ProductVariant $variant)
    {
       $this->mProduto = $producto;
       $this->mVariant = $variant;
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
            $sSku = $oRequest->input('sku', false);

            $aProductos = $this->mProduto
                ->where(
                    function ($q) use ($sFiltro) {
                        if ($sFiltro !== false) {
                            return $q
                                ->orWhere('id', '=', "%$sFiltro%");
                        }
                    }
                )
                ->where(
                    function ($q) use ($sSku) {
                        if (!empty($sSku)) {
                            return $q
                                ->orWhere('sku', '=', "$sSku");
                        }
                    }
                )
                ->orderBy($oRequest->input('order', 'id'), $oRequest->input('sort', 'asc'))
                ->paginate((int) $oRequest->input('per_page', 25));
            // Envía datos paginados
            return response()->json(["status" => "success", "data" => ["productos" => $aProductos]]);
        } catch (\Exception $e) {
            // Registra error
            Log::error('Error en '.__METHOD__.' línea '.$e->getLine().':'.$e->getMessage());
        }
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
    public function store(Request $request)
    {
        //
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

    public function muestraProducto()
    {
        try {
            $productos = $this->mProduto->all();
            return response()->json($productos);
        }catch (\Exception $e) {
            Log::error('Error en '.__METHOD__.' línea '.$e->getLine().':'.$e->getMessage());
        }
    }

    public function getClasificacionAduanera($producto_id)
    {
        $clasificacion_aduanera = ClasificacionAduanera::where('producto_id', $producto_id)
            ->first();
        return response()->json($clasificacion_aduanera);
    }

    public function getCaracteristicas($producto_id)
    {
        $caaracteristicas = CaracteristicaProducto::where('producto_id', $producto_id)
            ->first();
        return response()->json($caaracteristicas);
    }
   
   public function getVariants($producto_sku)
   {
   
   
      $Producto = $this->mProduto
         ->where('sku',$producto_sku)->first();
         
      $Variantes = ProductVariant::where('product_id', $Producto->id)
         ->get();
      return response()->json($Variantes);
   }
   
   
   /**
    * @param Request $oRequest
    * @param $orden
    * @return \Illuminate\Http\RedirectResponse
    */
   public function guardaVariant(Request $oRequest)
   {
      $sVariantName = $oRequest->input('nombre_variant', false);
      $producto_sku = $oRequest->input('new_variant_product_id', false);
   
      $Producto = $this->mProduto
         ->where('sku',$producto_sku)->first();

      try {
         $moneda = $this->mVariant->create([
            'variant' => $sVariantName,
            'product_id' =>  $Producto->id
         ]);
      
         // Alerta
         $notification = array(
            'message' => 'variante agregado correctamente.',
            'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
      } catch (\Exception $e) {
         // Alerta
         $notification = array(
            'message' => 'Algún error ocurrió.',
            'alert-type' => 'warning'
         );
         Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
         return redirect()->back()->with($notification);
      }
      
   }
   
}
