<?php

namespace App\Http\Controllers\Admin\SeguimientoProducto;

use App\Models\SeguimientoProducto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;
use Log;

class SeguimientoProductoController extends Controller
{
    protected $mSeguimiento;

    public function __construct(SeguimientoProducto $seguimiento)
    {
        $this->mSeguimiento = $seguimiento;
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
        try {
            $seguimiento = $this->mSeguimiento->find($id);
            $seguimiento->delete();
            // Alerta
            $notification = array(
                'message' => 'Seguimiento eliminado de la orden',
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
    public function guardaSeguimiento(Request $oRequest, $orden)
    {
        try {
            $fotoPreproduccion = ($oRequest->file('preproduccion_seguimiento')) ? $oRequest->file('preproduccion_seguimiento') : null;
            $fotoProduccion = ($oRequest->file('produccion_seguimiento')) ? $oRequest->file('produccion_seguimiento') : null;
            $fotoOEMuno = ($oRequest->file('oem_uno_seguimiento')) ? $oRequest->file('oem_uno_seguimiento') : null;
            $fotoOEMdos = ($oRequest->file('oem_dos_seguimiento')) ? $oRequest->file('oem_dos_seguimiento') : null;
            $fotoOEMtres = ($oRequest->file('oem_tres_seguimiento')) ? $oRequest->file('oem_tres_seguimiento') : null;
            $fotoEmpaquetado = ($oRequest->file('empaquetado_seguimiento')) ? $oRequest->file('oem_tres_seguimiento') : null;

            $preproduccion = $this->guardaImagen($fotoPreproduccion);
            $produccion = $this->guardaImagen($fotoProduccion);
            $oemUno = $this->guardaImagen($fotoOEMuno);
            $oemDos = $this->guardaImagen($fotoOEMdos);
            $oemTres = $this->guardaImagen($fotoOEMtres);
            $empaquetado = $this->guardaImagen($fotoEmpaquetado);

            $seguimiento = $this->mSeguimiento->create([
                'foto_preproduccion' => $preproduccion,
                'foto_produccion'    => $produccion,
                'foto_oem_uno'       => $oemUno,
                'foto_oem_dos'       => $oemDos,
                'foto_oem_tres'      => $oemTres,
                'foto_empaquetado'   => $empaquetado,
                'orden_compra_id'    => $orden,
                'producto_orden_id'  => $oRequest->producto_seguimiento_id
            ]);

            // Alerta
            $notification = array(
                'message' => 'Seguimiento agregado correctamente.',
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
     * @param $archivo
     * @return null|string
     * @throws \Exception
     */
    public function guardaImagen($archivo)
    {
        if(!empty($archivo)) {
            // ruta de las imagenes guardadas
            $ruta = public_path().'/documents/orden_compra/images/';
            // recogida del form
            $imagenOriginal = $archivo;
            // crear instancia de imagen
            $imagen =  Image::make($imagenOriginal);
            // generar un nombre aleatorio para la imagen
            $nombre = Uuid::generate(1).'.'. $imagenOriginal->getClientOriginalExtension();
            $imagen->resize(800,533);
            $imagen->save($ruta . $nombre, 100);
            return $nombre;
        } else {
            return $nombre = null;
        }
    }
}
