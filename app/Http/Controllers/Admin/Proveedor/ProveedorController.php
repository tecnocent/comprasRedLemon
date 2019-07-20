<?php

namespace App\Http\Controllers\Admin\Proveedor;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProveedorController extends Controller
{
    protected $mProveedor;

    /**
     * ProveedorController constructor.
     * @param Proveedor $proveedor
     */
    public function __construct(Proveedor $proveedor)
    {
        $this->middleware('auth');
        $this->mProveedor = $proveedor;
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
    public function store(Request $oRequest)
    {
        try {
            // Nuevo proveedor
            $proveedor = $this->mProveedor->create([
                'name' => $oRequest->nombreProveedor,
                'tax' => $oRequest->taxProveedor,
                'contactname' => $oRequest->nombreContactoProveedor,
                'direction' => $oRequest->direccionProveedor,
                'country' => $oRequest->paisProveedor,
                'phone' => $oRequest->tlefonoProveedor,
                'wechat' => $oRequest->null,
                'whatsapp' => $oRequest->null,
                'email' => $oRequest->correoProveedor,
            ]);

        } catch(\Exception $e) {
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
