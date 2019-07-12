<?php

namespace App\Http\Controllers\Admin\Transito;

use App\Models\Transito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Webpatser\Uuid\Uuid;

class TransitoController extends Controller
{
    protected $mTransito;

    public function __construct(Transito $transito)
    {
        $this->mTransito = $transito;
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
