<?php

namespace App\Http\Controllers\Admin\CaracteristicaProducto;

use App\Models\CaracteristicaProducto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class CaracteristicaProductoController extends Controller
{
    protected $mCaracteristica;

    public function __construct(CaracteristicaProducto $caracteristica)
    {
        $this->mCaracteristica = $caracteristica;
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
            foreach ($oRequest->caracteristicas as $aCaracteristica) {
                $caracteristica = $this->mCaracteristica->create([
                    'especificaciones_producto' => $aCaracteristica['especificacion_producto'],
                    'especificaciones_electricas' => $aCaracteristica['especificacion_electrica'],
                    'link_amazon' => $aCaracteristica['link_amazon'],
                    'link_alibaba' => $aCaracteristica['link_alibaba'],
                    'orden_compra_id' => $orden->id,
                    'producto_id' => $aCaracteristica['producto_id']
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
            $caracteristica = $this->mCaracteristica->find($oRequest->caracteristica_id);
            $caracteristica->update([
                'especificaciones_producto' => $oRequest->especificacion_producto,
                'especificaciones_electricas' => $oRequest->especificaion_electrica,
                'link_amazon' => $oRequest->link_amazon,
                'link_alibaba' => $oRequest->link_alibaba,
                'producto_id' => $oRequest->producto_id
            ]);
            // Alerta
            $notification = array(
                'message' => 'Caracteristica actualizado correctamente.',
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
            $caracteristica = $this->mCaracteristica->find($id);
            $caracteristica->delete();
            // Alerta
            $notification = array(
                'message' => 'Caracteristica eliminada de la orden',
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

    public function guardaCaracteristica(Request $oRequest, $orden)
    {
        try {
            $caracteristica = $this->mCaracteristica->create([
                'especificaciones_producto' => $oRequest->especificacion_producto,
                'especificaciones_electricas' => $oRequest->especificaion_electrica,
                'link_amazon' => $oRequest->link_amazon,
                'link_alibaba' => $oRequest->link_alibaba,
                'producto_id' => $oRequest->producto_id,
                'orden_compra_id' => $orden,
            ]);
            // Alerta
            $notification = array(
                'message' => 'Caracteristica agregada correctamente.',
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
    public function consultaCaracteristica($id)
    {
        $caracteristica = $this->mCaracteristica->find($id);
        return response()->json($caracteristica);
    }
}
