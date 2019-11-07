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
                'bank_account' => $oRequest->bank_account,
                'bank_address'=> $oRequest->bank_address,
                'swift' => $oRequest->swift
            ]);
           $notification = array(
              'message' => 'Proveedor vreado correctamente.',
              'alert-type' => 'success'
           );
           return redirect()->back()->with($notification);
        } catch(\Exception $e) {
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
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
    public function update(Request $request)
    {
       try {
          $proveedor = $this->mProveedor->find($request->idProveedor);
          // Nuevo proveedor
          $proveedor->update([
             'name' => $request->nombreProveedor,
             'tax' => $request->taxProveedor,
             'contactname' => $request->nombreContactoProveedor,
             'direction' => $request->direccionProveedor,
             'country' => $request->paisProveedor,
             'phone' => $request->tlefonoProveedor,
             'wechat' => $request->null,
             'whatsapp' => $request->null,
             'email' => $request->correoProveedor,
             'bank_account' => $request->bank_account,
             'bank_address'=> $request->bank_address,
             'swift' => $request->swift
          ]);
          
          // Alerta
          $notification = array(
             'message' => 'Proveedor actualizado correctamente.',
             'alert-type' => 'success'
          );
          return redirect()->back()->with($notification);
       } catch(\Exception $e) {
          $notification = [
             'message' => $e->getMessage(),
             'alert-type' => 'error'
          ];
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
          $proveedor = $this->mProveedor->find($id);
          $proveedor->delete();
          // Alerta
          $notification = array(
             'message' => 'Producto eliminado de la orden',
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
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
   public function consulta($id)
   {
      $provvedor = $this->mProveedor->where('id', $id)
         ->select('*')->get();
      return response()->json($provvedor);
   }
   
}
