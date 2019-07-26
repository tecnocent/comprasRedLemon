<?php

namespace App\Http\Controllers\Admin\Diseno;

use App\Models\DisenoProducto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;
use Log;

class DisenoController extends Controller
{
    protected $mDiseno;

    public function __construct(DisenoProducto $design)
    {
        $this->middleware('auth');
        $this->mDiseno = $design;
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
            foreach ($oRequest->disenos as $aDiseno) {
                $logo  = (array_has($aDiseno, 'logo')) ? true : false;
                $box  = (array_has($aDiseno, 'box')) ? true : false;
                $instructivo  = (array_has($aDiseno, 'instructivo')) ? true : false;

                $fileDiseno = $aDiseno['file_diseno'];
                $archivoDiseno = $fileDiseno;
                $fileDiseno = $this->guardaArchivo($archivoDiseno);

                $fileFabricante = $aDiseno['file_fabricante'];
                $archivoFabricante = $fileFabricante;
                $fileFabricante = $this->guardaArchivo($archivoFabricante);

                $desing = $this->mDiseno->create([
                    'logo'                  => $logo,
                    'box'                   => $box,
                    'instructivo'           => $instructivo,
                    'archivo_fabricante'    => $fileFabricante,
                    'archivo_diseno'        => $fileDiseno,
                    'tipo'                  => $aDiseno['tipo'],
                    'fecha_requerida'       => $aDiseno['fecha_requerida'],
                    'producto_id'           => $aDiseno['producto_id'],
                    'orden_compra_id'       => $orden->id
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
            $oem = (array_has($oRequest->all(),'oem')) ? true : false;
            $empaque = (array_has($oRequest->all(),'empaque')) ? true : false;
            $instructivo = (array_has($oRequest->all(),'instructivo')) ? true : false;
            $archivosFabricante = [];
            $archivosDiseno = [];
            $contadorFabricante = 0;
            $contadorDiseno = 0;

            $fileProductoDiseno = $this->guardaArchivo($oRequest->file('producto_diseno'));
            $fileEmpaque = $this->guardaArchivo($oRequest->file('empaque_diseno'));
            $fileInstructivo = $this->guardaArchivo($oRequest->file('instructivo_diseno'));
            $oemAutorizado = $this->guardaArchivo($oRequest->file('instructivo_diseno'));

            if (array_has($oRequest->all, 'archivos_fabricante')){
                foreach ($oRequest->archivos_fabricante as $fileFrabricante) {
                    $fFrabricante = $this->guardaArchivo($fileFrabricante);
                    $archivosFabricante[$contadorFabricante] = $fFrabricante;
                    $contadorFabricante++;
                }
            }
            if (array_has($oRequest->all, 'archivos_diseno')) {
                foreach ($oRequest->archivos_diseno as $fileDiseno) {
                    $fDiseno = $this->guardaArchivo($fileDiseno);
                    $archivosDiseno[$contadorDiseno] = $fDiseno;
                    $contadorDiseno++;
                }
            }
            $diseno = $this->mDiseno->find($oRequest->diseno_id);
            $diseno->update([
                'oem'                           => $oem,
                'empaque'                       => $empaque,
                'instructivo'                   => $instructivo,
                'fecha_aviso_diseno'            => $oRequest->fecha_aviso_diseno,
                'fecha_autorizacion_trafico'    => $oRequest->fecha_autorizacion_trafico,
            ]);
            if (!empty($fileProductoDiseno)){
                $diseno->update([
                    'producto_diseno' => $fileProductoDiseno,
                ]);
            }
            if (!empty($fileEmpaque)){
                $diseno->update([
                    'empaque_diseno' => $fileEmpaque,
                ]);
            }
            if (!empty($fileInstructivo)){
                $diseno->update([
                    'instructivo_diseno' => $fileInstructivo,
                ]);
            }
            if (!empty($oemAutorizado)){
                $diseno->update([
                    'oem_autorizado_trafico' => $oemAutorizado,
                ]);
            }
            if (count($archivosFabricante) > 0){
                $diseno->update([
                    'archivos_fabricante' => json_encode($archivosFabricante, JSON_FORCE_OBJECT),
                ]);
            }
            if (count($archivosDiseno) > 0){
                $diseno->update([
                    'archivos_diseno' => json_encode($archivosDiseno, JSON_FORCE_OBJECT)
                ]);
            }
            // Alerta
            $notification = array(
                'message' => 'Diseño agregado correctamente.',
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
            $diseno = $this->mDiseno->find($id);
            $diseno->delete();
            // Alerta
            $notification = array(
                'message' => 'Diseño eliminado de la orden',
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
    public function guardaDiseno(Request $oRequest, $orden)
    {
        try {
            $oem = (array_has($oRequest->all(),'oem')) ? true : false;
            $empaque = (array_has($oRequest->all(),'empaque')) ? true : false;
            $instructivo = (array_has($oRequest->all(),'instructivo')) ? true : false;
            $archivosFabricante = [];
            $archivosDiseno = [];
            $contadorFabricante = 0;
            $contadorDiseno = 0;

            $fileProductoDiseno = $this->guardaArchivo($oRequest->file('producto_diseno'));
            $fileEmpaque = $this->guardaArchivo($oRequest->file('empaque_diseno'));
            $fileInstructivo = $this->guardaArchivo($oRequest->file('instructivo_diseno'));
            $oemAutorizado = $this->guardaArchivo($oRequest->file('instructivo_diseno'));

            foreach ($oRequest->archivos_fabricante as $fileFrabricante) {
                $fFrabricante = $this->guardaArchivo($fileFrabricante);
                $archivosFabricante[$contadorFabricante] = $fFrabricante;
                $contadorFabricante++;
            }

            foreach ($oRequest->archivos_diseno as $fileDiseno) {
                $fDiseno = $this->guardaArchivo($fileDiseno);
                $archivosDiseno[$contadorDiseno] = $fDiseno;
                $contadorDiseno++;
            }

            $diseno = $this->mDiseno->create([
                'oem'                           => $oem,
                'empaque'                       => $empaque,
                'instructivo'                   => $instructivo,
                'fecha_aviso_diseno'            => $oRequest->fecha_aviso_diseno,
                'producto_diseno'               => $fileProductoDiseno,
                'empaque_diseno'                => $fileEmpaque,
                'instructivo_diseno'            => $fileInstructivo,
                'oem_autorizado_trafico'        => $oemAutorizado,
                'fecha_autorizacion_trafico'    => $oRequest->fecha_autorizacion_trafico,
                'archivos_fabricante'           => json_encode($archivosFabricante, JSON_FORCE_OBJECT),
                'archivos_diseno'               => json_encode($archivosDiseno, JSON_FORCE_OBJECT),
                'orden_compra_id'               => $orden,
                'producto_id'                   => $oRequest->producto_id
            ]);
            // Alerta
            $notification = array(
                'message' => 'Diseño agregado correctamente.',
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function consultaDiseno($id)
    {
        $diseno = $this->mDiseno->find($id);
        return response()->json($diseno);
    }
}
