<?php

namespace App\Http\Controllers\Admin\Pedimento;

use App\Http\Controllers\Auth\LoginController;
use App\Models\Pedimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;
use Log;

class PedimentoController extends Controller
{

    protected $mPedimento;

    public function __construct(Pedimento $pedimento)
    {
        $this->mPedimento = $pedimento;
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
            foreach ($oRequest->pedimento as $aPedimento) {
                $pedimentoDigital = $aPedimento['pedimento_digital'];
                $archivo = $pedimentoDigital;
                $pedimentoDigital = $this->guardaArchivo($archivo);
                $pedimento = $this->mPedimento->create([
                    'pedimento' => $aPedimento['numero_pedimento'],
                    'pedimento_digital' => $pedimentoDigital,
                    'tipo_cambio_pedimento' => $aPedimento['tipo_cambio_pedimento_pedimento'],
                    'dta' => $aPedimento['dta_pedimento'],
                    'cnt' => $aPedimento['cnt_pedimento'],
                    'igi' => $aPedimento['igi_pedimento'],
                    'prv' => $aPedimento['prv_pedimento'],
                    'iva' => $aPedimento['iva_pedimento'],
                    'orden_compra_id' => $orden->id,
                    'aduana_id' => $aPedimento['aduana_pedimento'],
                    'agente_aduanal_id' => $aPedimento['agente_aduanal_pedimento'],
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
        try {
            $pedimento = $this->mPedimento->find($id);
            $pedimento->delete();
            // Alerta
            $notification = array(
                'message' => 'Pedimento eliminado de la orden',
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
}
