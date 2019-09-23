<?php

namespace App\Http\Controllers\Admin\ClasificacionAduanera;

use App\Models\ClasificacionAduanera;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class ClasificacionAduaneraController extends Controller
{
    protected $mClasificacion;

    public function __construct(ClasificacionAduanera $clasificacion)
    {
        $this->middleware('auth');
        $this->mClasificacion = $clasificacion;
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
            foreach ($oRequest->clasificaciones as $aClasificacion) {
                $clasificacion = $this->mClasificacion->create([
                    'clasificacion_arancelaria' => $aClasificacion['clasificacion_arancelaria'],
                    'nom_1' => $aClasificacion['nom_1'],
                    'nom_2' => $aClasificacion['nom_2'],
                    'nom_3' => $aClasificacion['nom_3'],
                    'nom_4' => $aClasificacion['nom_4'],
                    'orden_compra_id' => $orden->id,
                    'producto_id' => $aClasificacion['producto_id'],
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
            $clasificacion = $this->mClasificacion->find($oRequest->clasificacion_id);
            $clasificacion->update([
                'clasificacion_arancelaria' => $oRequest->clasificacion_arancelaria,
                'nom_1' => $oRequest->nom_1,
                'nom_2' => $oRequest->nom_2,
                'nom_3' => $oRequest->nom_3,
                'nom_4' => $oRequest->nom_4,
            ]);
            // Alerta
            $notification = array(
                'message' => 'Clasificación actualizada correctamente.',
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
            $clasificacion = $this->mClasificacion->find($id);
            $clasificacion->delete();
            // Alerta
            $notification = array(
                'message' => 'Clasificación eliminada de la orden',
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
     * @param Request $oRequest
     * @param $orden
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guardaClasificacion(Request $oRequest, $orden)
    {
        try {
            $clasificacion = $this->mClasificacion->create([
                'clasificacion_arancelaria' => $oRequest->clasificacion_arancelaria,
                'nom_1' => $oRequest->nom_1,
                'nom_2' => $oRequest->nom_2,
                'nom_3' => $oRequest->nom_3,
                'nom_4' => $oRequest->nom_4,
                'orden_compra_id' => $orden,
                'producto_id' => $oRequest->producto_id
            ]);
            // Alerta
            $notification = array(
                'message' => 'Clasificacion agregada correctamente.',
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
    public function consultaClasificacion($id)
    {
    $clasificacion = $this->mClasificacion->find($id);
        return response()->json($clasificacion);
    }
}
