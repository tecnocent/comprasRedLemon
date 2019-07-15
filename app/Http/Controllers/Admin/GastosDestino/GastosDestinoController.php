<?php

namespace App\Http\Controllers\Admin\GastosDestino;

use App\Models\GastosDestinoOrdenCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Webpatser\Uuid\Uuid;

class GastosDestinoController extends Controller
{
    protected $mGastosDestino;

    public function __construct(GastosDestinoOrdenCompra $gastosDestino)
    {
        $this->mGastosDestino = $gastosDestino;
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
            foreach ($oRequest->gastosDe as $aGastosDestino) {
                $comprobanteFile = $aGastosDestino['comporbante_gastos_destino'];
                $archivo = $comprobanteFile;
                $comprobanteFile = $this->guardaArchivo($archivo);
                $gastoDe = $this->mGastosDestino->create([
                    'moneda' => $aGastosDestino['moneda_gastos_destino'],
                    'costo' => $aGastosDestino['costo_gastos_destino'],
                    'notas' => $aGastosDestino['nota_gastos_destino'],
                    'comprobante' => $comprobanteFile,
                    'orden_compra_id' => $orden->id,
                    'tipo_gasto_destino_id' => $aGastosDestino['tipo_gasto_gastos_destino'],
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
            $gasto = $this->mGastosDestino->find($id);
            $gasto->delete();
            // Alerta
            $notification = array(
                'message' => 'Gasto Destino eliminado de la orden',
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
