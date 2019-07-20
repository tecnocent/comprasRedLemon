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
        $this->middleware('auth');
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
    public function store(Request $oRequest, $orden)
    {
        try {
            foreach ($oRequest->seguimiento as $seguimientoProducto) {
                if ($seguimientoProducto['preproduccion_seguimiento'] ||
                    $seguimientoProducto['produccion_seguimiento'] ||
                    $seguimientoProducto['oem_uno_seguimiento'] ||
                    $seguimientoProducto['oem_dos_seguimiento'] ||
                    $seguimientoProducto['oem_tres_seguimiento'] ||
                    $seguimientoProducto['empaquetado_seguimiento']) {

                    $fotoPreproduccion = ($seguimientoProducto['preproduccion_seguimiento']) ? $seguimientoProducto['preproduccion_seguimiento'] : null;
                    $fotoProduccion = ($seguimientoProducto['produccion_seguimiento']) ? $seguimientoProducto['produccion_seguimiento'] : null;
                    $fotoOEMuno = ($seguimientoProducto['oem_uno_seguimiento']) ? $seguimientoProducto['oem_uno_seguimiento'] : null;
                    $fotoOEMdos = ($seguimientoProducto['oem_dos_seguimiento']) ? $seguimientoProducto['oem_dos_seguimiento'] : null;
                    $fotoOEMtres = ($seguimientoProducto['oem_tres_seguimiento']) ? $seguimientoProducto['oem_tres_seguimiento'] : null;
                    $fotoEmpaquetado = ($seguimientoProducto['empaquetado_seguimiento']) ? $seguimientoProducto['oem_tres_seguimiento'] : null;

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
                }
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
            $fotoPreproduccion = ($oRequest->file('preproduccion_seguimiento')) ? $oRequest->file('preproduccion_seguimiento') : null;
            $fotoProduccion = ($oRequest->file('produccion_seguimiento')) ? $oRequest->file('produccion_seguimiento') : null;
            $fotoOEMuno = ($oRequest->file('oem_uno_seguimiento')) ? $oRequest->file('oem_uno_seguimiento') : null;
            $fotoOEMdos = ($oRequest->file('oem_dos_seguimiento')) ? $oRequest->file('oem_dos_seguimiento') : null;
            $fotoOEMtres = ($oRequest->file('oem_tres_seguimiento')) ? $oRequest->file('oem_tres_seguimiento') : null;
            $fotoEmpaquetado = ($oRequest->file('empaquetado_seguimiento')) ? $oRequest->file('empaquetado_seguimiento') : null;

            $preproduccion = $this->guardaImagen($fotoPreproduccion);
            $produccion = $this->guardaImagen($fotoProduccion);
            $oemUno = $this->guardaImagen($fotoOEMuno);
            $oemDos = $this->guardaImagen($fotoOEMdos);
            $oemTres = $this->guardaImagen($fotoOEMtres);
            $empaquetado = $this->guardaImagen($fotoEmpaquetado);

            if ($preproduccion) {
                $seguimiento = $this->actualiza('foto_preproduccion', $preproduccion,$oRequest->seguimiento_id);
            }
            if ($produccion) {
                $seguimiento = $this->actualiza('foto_produccion', $produccion,$oRequest->seguimiento_id);
            }
            if ($oemUno) {
                $seguimiento = $this->actualiza('foto_oem_uno', $oemUno,$oRequest->seguimiento_id);
            }
            if ($oemDos) {
                $seguimiento = $this->actualiza('foto_oem_dos', $oemDos,$oRequest->seguimiento_id);
            }
            if ($oemTres) {
                $seguimiento = $this->actualiza('foto_oem_tres', $oemTres,$oRequest->seguimiento_id);
            }
            if ($empaquetado) {
                $seguimiento = $this->actualiza('foto_empaquetado', $empaquetado,$oRequest->seguimiento_id);
            }
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
            $ruta = public_path().'/documents/orden_compra/images/';
            $imagenOriginal = $archivo;
            $imagen =  Image::make($imagenOriginal);
            $nombre = Uuid::generate(1).'.'. $imagenOriginal->getClientOriginalExtension();
            $imagen->resize(800,533);
            $imagen->save($ruta . $nombre, 100);
            return $nombre;
        } else {
            return $nombre = null;
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function consultaSeguimiento($id)
    {
        $seguimiento = $this->mSeguimiento->find($id);
        return response()->json($seguimiento);
    }

    /**
     * @param $parametro
     * @param $valor
     * @param $id
     */
    private function actualiza($parametro, $valor, $id)
    {
        $seguimiento = $this->mSeguimiento->find($id);
        $seguimiento->update([
            $parametro => $valor
        ]);
    }
}
