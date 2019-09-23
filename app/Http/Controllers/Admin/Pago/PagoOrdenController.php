<?php

namespace App\Http\Controllers\Admin\Pago;

use App\Models\OrdenCompra;
use App\Models\PagoMontoOrdenCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;
use Log;

class PagoOrdenController extends Controller
{
    protected $mPago;

    public function __construct(PagoMontoOrdenCompra $pago)
    {
        $this->middleware('auth');
        $this->mPago = $pago;
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
    public function store(Request $oRequest, $orden)
    {
        try {
            foreach ($oRequest->pago as $aPagos) {
                $comprobante = $aPagos['comporbante_pago'];
                $archivo = $comprobante;
                $comprobante = $this->guardaArchivo($archivo);
                $pago = $this->mPago->create([
                    'pago' => $aPagos['pago_orden'],
                    'tipo_cambio_pago' => $aPagos['tipo_cambio_pago_orden'],
                    'comrpobante' => $comprobante,
                    'orden_compra_id' => $orden->id
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
            $pago = $this->mPago->find($oRequest->pago_id);
            $pago->update([
                'pago' => $oRequest->pago_pagos,
                'tipo_cambio_pago' => $oRequest->tipo_cambio_pago_orden
            ]);
            if ($oRequest->file('pago_comprobante')) {
                $comprobante = $oRequest->file('pago_comprobante');
                $archivo = $comprobante;
                $comprobante = $this->guardaArchivo($archivo);
                $pago->update([
                    'comrpobante' => $comprobante,
                ]);
            }
            // Alerta
            $notification = array(
                'message' => 'Pago actualizado correctamente.',
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
            $pago = $this->mPago->find($id);
            $pago->delete();
            // Alerta
            $notification = array(
                'message' => 'Pago eliminado de la orden',
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
    public function guardaPago(Request $oRequest, $orden)
    {
        if ($oRequest->currency === null) {
            // Alerta
            $notification = array(
                'message' => 'Debes seleccionar una moneda',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

        try {
            $comprobante = $oRequest->file('pago_comprobante');
            $archivo = $comprobante;
            $comprobante = $this->guardaArchivo($archivo);
            $pago = $this->mPago->create([
                'pago' => $oRequest->pago_pagos,
                'tipo_cambio_pago' => $oRequest->tipo_cambio_pago_orden,
                'comrpobante' => $comprobante,
                'orden_compra_id' => $orden,
                'referencia' => $oRequest->referencia_pago,
                'fecha_pago' => $oRequest->fecha_pago,
                'currency_id' => $oRequest->currency
            ]);

            $pagos = PagoMontoOrdenCompra::where('orden_compra_id', $orden)
                ->get();

            $total = 0;
            foreach ($pagos as $pago) {
                $total += $pago->pago;
            }

            $orden_compra =  OrdenCompra::findOrFail($orden);
            $orden_compra->pagado = $total;
            $orden_compra->update();

            // Alerta
            $notification = array(
                'message' => 'Pago agregado correctamente.',
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
    public function consultaPago($id)
    {
        $pago = $this->mPago->find($id);
        return response()->json($pago);
    }
}
