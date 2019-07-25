<?php

namespace App\Http\Controllers\Admin\Diseno;

use App\Models\DisenoProducto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
