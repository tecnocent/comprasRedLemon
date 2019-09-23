<?php

namespace App\Http\Controllers\Admin\Transito;

use App\Models\Forwarder;
use App\Models\MetodoTransito;
use App\Models\OrdenCompra;
use App\Models\Transito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Webpatser\Uuid\Uuid;

class TransitoController extends Controller
{
    protected $mTransito;
    protected $mMetodoTransito;
    protected $mForwarderTransito;

    public function __construct(Transito $transito, MetodoTransito $metodoTransito, Forwarder $forwarderTransito)
    {
        $this->middleware('auth');
        $this->mTransito = $transito;
        $this->mMetodoTransito= $metodoTransito;
        $this->mForwarderTransito= $forwarderTransito;
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
            foreach ($oRequest->transito as $aTransito) {
                $comerialInvoiceFile = $aTransito['archivo_comercial_invoce_file'];
                $archivo = $comerialInvoiceFile;
                $comerialInvoiceFile = $this->guardaArchivo($archivo);
                $transito = $this->mTransito->create([
                    'guia' => $aTransito['guia_transito'],
                    'fecha_embarque' => $aTransito['fecha_embarque_transito'],
                    'fecha_tentativa' => $aTransito['fecha_tentativa_llegada_transito'],
                    'comercual_invoce' => $aTransito['comercial_invoce_transito'],
                    'comercial_invoce_file' => $comerialInvoiceFile,
                    'cajas' => $aTransito['cajas_transito'],
                    'cbm' => $aTransito['cbm_transito'],
                    'peso' => $aTransito['peso_transito'],
                    'metodo_id' => $aTransito['metodo_transito'],
                    'forwarder_id' => $aTransito['forwarder_transito'],
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
     * @param Request $oRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $oRequest)
    {
        try {

            $transito = $this->mTransito->find($oRequest->transito_id);
            $transito->update([
                'guia' => $oRequest->guia_transito,
                'fecha_embarque' => $oRequest->fecha_embarque_transito,
                'fecha_tentativa' => $oRequest->fecha_tentativa_llegada_transito,
                'comercual_invoce' => $oRequest->comercial_invoce_transito,
                'cajas' => $oRequest->cajas_transito,
                'cbm' => $oRequest->cbm_transito,
                'peso' => $oRequest->peso_transito,
                'metodo_id' => $oRequest->metodo_transito,
                'forwarder_id' => $oRequest->forwarder_transito
            ]);
            if ($oRequest->file('archivo_comercial_invoce_file')){
                $comerialInvoiceFile = $oRequest->file('archivo_comercial_invoce_file');
                $archivo = $comerialInvoiceFile;
                $comerialInvoiceFile = $this->guardaArchivo($archivo);
                $transito->update([
                    'comercial_invoce_file' => $comerialInvoiceFile
                ]);
            }
            // Alerta
            $notification = array(
                'message' => 'Transito agrgado correctamente.',
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
            $transito = $this->mTransito->find($id);
            $transito->delete();

            $orden_compra =  OrdenCompra::findOrFail($transito->orden_compra_id);
            $orden_compra->guia = null;
            $orden_compra->metodo_envio = null;
            $orden_compra->update();

            // Alerta
            $notification = array(
                'message' => 'Transito eliminado de la orden',
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
    public function guardaTransito(Request $oRequest, $orden)
    {
        try {
            $comerialInvoiceFile = $oRequest->file('archivo_comercial_invoce_file');
            $archivo = $comerialInvoiceFile;
            $comerialInvoiceFile = $this->guardaArchivo($archivo);
            $transito = $this->mTransito->create([
                'guia' => $oRequest->guia_transito,
                'fecha_embarque' => $oRequest->fecha_embarque_transito,
                'fecha_tentativa' => $oRequest->fecha_tentativa_llegada_transito,
                'comercual_invoce' => $oRequest->comercial_invoce_transito,
                'comercial_invoce_file' => $comerialInvoiceFile,
                'cajas' => $oRequest->cajas_transito,
                'cbm' => $oRequest->cbm_transito,
                'peso' => $oRequest->peso_transito,
                'metodo_id' => $oRequest->metodo_transito,
                'forwarder_id' => $oRequest->forwarder_transito,
                'orden_compra_id' => $orden
            ]);

            $orden_compra =  OrdenCompra::findOrFail($orden);
            $orden_compra->guia = $oRequest->guia_transito;

            $metodo_envio = MetodoTransito::findOrFail($oRequest->metodo_transito);
            $orden_compra->metodo_envio = $metodo_envio->nombre;

            $orden_compra->update();

            // Alerta
            $notification = array(
                'message' => 'Transito agregado correctamente.',
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
    public function consultaTransito($id)
    {
        $transito = $this->mTransito->find($id);
        return response()->json($transito);
    }

    public function guardaMetodoTransito(Request $oRequest)
    {
        try {
            $metodoTransito = $this->mMetodoTransito->create([
                'nombre' => $oRequest->nombre_metodo,
            ]);

            $notification = array(
                'message' => 'Método de tránsito creado correctamente.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Alerta
            $notification = array(
                'message' => 'Algun error ocurrió.',
                'alert-type' => 'warning'
            );
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
            return redirect()->back()->with($notification);
        }
    }

    public function guardaForwarderTransito(Request $oRequest)
    {
        try {
            $forwarderTransito = $this->mForwarderTransito->create([
                'nombre' => $oRequest->nombre_forwarder,
            ]);

            $notification = array(
                'message' => 'Forwarder de tránsito creado correctamente.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Alerta
            $notification = array(
                'message' => 'Algun error ocurrió.',
                'alert-type' => 'warning'
            );
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
            return redirect()->back()->with($notification);
        }
    }
}
