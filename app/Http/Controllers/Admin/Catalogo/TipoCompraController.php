<?php

namespace App\Http\Controllers\Admin\Catalogo;

use App\Models\TipoCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoCompraController extends Controller
{
    protected $mTipoCompa;

    /**
     * TipoCompraController constructor.
     * @param TipoCompra $tipoCompra
     */
    public function __construct(TipoCompra $tipoCompra)
    {
        $this->mTipoCompa = $tipoCompra;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oTiposCompra = $this->mTipoCompa->all();

        return response()->json($oTiposCompra);
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
    public function store(Request $oRequest)
    {
        try {
            // Nuevo tipo de compra
            $tipoCompra = $this->mTipoCompa->create([
                'nombre' => $oRequest->tipoCompraNombre,
            ]);
        } catch (\Exception $e) {
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            redirect()->back()->with($notification);
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
