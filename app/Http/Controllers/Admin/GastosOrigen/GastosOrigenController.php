<?php

namespace App\Http\Controllers\Admin\GastosOrigen;

use App\Models\CostoOrigen;
use App\Models\GastosOrigenOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\ProductoOrdenCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Webpatser\Uuid\Uuid;

class GastosOrigenController extends Controller
{
    protected $mGastosOrigen;
    protected $mCostoOrigen;

    public function __construct(GastosOrigenOrdenCompra $gastosOrigen, CostoOrigen $costoOrigen)
    {
        $this->middleware('auth');
        $this->mGastosOrigen = $gastosOrigen;
        $this->mCostoOrigen = $costoOrigen;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($oRequest, $orden)
    {
        try {
            foreach ($oRequest->gastosOr as $aGastosOrigen) {
                $comprobanteGastosOrigen = $aGastosOrigen['comprobante_gastos_origen'];
                $archivo = $comprobanteGastosOrigen;
                $comprobanteGastosOrigen = $this->guardaArchivo($archivo);

                $gastoOrigen = $this->mGastosOrigen->create([
                    'costo' => $aGastosOrigen['costo_gastos_origen'],
                    'notas' => $aGastosOrigen['nota_gastos_origen'],
                    'comprobante' => $comprobanteGastosOrigen,
                    'orden_compra_id' => $orden->id,
                    'tipo_gasto_id' => $aGastosOrigen['tipo_gasto_origen']
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $oRequest)
    {
        try {
            $gastoOrigen = $this->mGastosOrigen->find($oRequest->gasto_origen_id);
            $gastoOrigen->update([
                'costo' => $oRequest->costo_gastos_origenM,
                'notas' => $oRequest->nota_gastos_origenM,
                'tipo_gasto_id' => $oRequest->tipo_gasto_origenM
            ]);

            if ($oRequest->file('comprobante_gastos_origen')) {
                $comprobanteGastosOrigen = $oRequest->file('comprobante_gastos_origen');
                $archivo = $comprobanteGastosOrigen;
                $comprobanteGastosOrigen = $this->guardaArchivo($archivo);
                $gastoOrigen->update([
                    'comprobante' => $comprobanteGastosOrigen
                ]);
            }
            $notification = array(
                'message' => 'Gasto de Origen actualizado correctamente.',
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $gasto = $this->mGastosOrigen->find($id);
            $gasto->delete();
            // Alerta
            $notification = array(
                'message' => 'Gasto de Origen eliminado de la orden',
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
            $nombre = Uuid::generate(1) . '.' . $file->getClientOriginalExtension();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre, \File::get($file));

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
    public function guardaGastosOrigen(Request $oRequest, $orden)
    {
        try {
            $comprobanteGastosOrigen = $oRequest->file('comprobante_gastos_origen');
            $archivo = $comprobanteGastosOrigen;
            $comprobanteGastosOrigen = $this->guardaArchivo($archivo);

            $gastoOrigen = $this->mGastosOrigen->create([
                'costo' => $oRequest->costo_gastos_origenM,
                'notas' => $oRequest->nota_gastos_origenM,
                'comprobante' => $comprobanteGastosOrigen,
                'orden_compra_id' => $orden,
                'tipo_gasto_id' => $oRequest->tipo_gasto_origenM
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

            $orden_compra = OrdenCompra::findOrFail($orden);
            $orden_compra->total = $total;
            $orden_compra->update();

            $notification = array(
                'message' => 'Gasto de Origen creado correctamente.',
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
    public function consultaGastoOrigen($id)
    {
        $gastoOrigen = $this->mGastosOrigen->find($id);
        return response()->json($gastoOrigen);
    }

    public function guardaTipoGastoOrigen(Request $oRequest)
    {
        try {
            $costoOrigen = $this->mCostoOrigen->create([
                'code' => $oRequest->codigo_gasto_origen,
                'name' => $oRequest->nombre_gasto_origen,
                'description' => $oRequest->descripcion_gasto_origen,
            ]);

            $notification = array(
                'message' => 'Tipo gasto de origen creado correctamente.',
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
}
