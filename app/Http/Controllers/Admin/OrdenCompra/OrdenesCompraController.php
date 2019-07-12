<?php

namespace App\Http\Controllers\Admin\OrdenCompra;

use App\Http\Controllers\Admin\GastosDestino\GastosDestinoController;
use App\Http\Controllers\Admin\GastosOrigen\GastosOrigenController;
use App\Http\Controllers\Admin\Pedimento\PedimentoController;
use App\Http\Controllers\Admin\Producto\ProductoController;
use App\Http\Controllers\Admin\Transito\TransitoController;
use App\Http\Requests\OrdenCompraRequest;
use App\Models\MontoPagoOrdenCompra;
use App\Models\PagoMontoOrdenCompra;
use App\Models\Pedimento;
use App\Models\Transito;
use Illuminate\Support\Facades\Storage;
use App\Models\Almacen;
use App\Models\CostoDestino;
use App\Models\CostoOrigen;
use App\Models\GastosDestinoOrdenCompra;
use App\Models\GastosOrigenOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\Producto;
use App\Models\ProductoOrdenCompra;
use App\Models\Proveedor;
use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Symfony\Component\Console\Helper\TableRows;
use Validator;
use File;
use Uuid;

class OrdenesCompraController extends Controller
{

    protected $mProveedor;
    protected $mUser;
    protected $mAlmacen;
    protected $mProducto;
    protected $mCostoDestino;
    protected $mCostoOrigen;
    protected $mOrdenCompra;
    protected $mProductoOrdenCompra;
    protected $mGastosOrigenOrdenCompra;
    protected $mGastosDestinoOrdenCompra;
    protected $mMontoPagoOrden;
    protected $mPagoMontoPagoOrden;
    protected $mTransito;
    protected $mPedimento;


    /**
     * OrdenesCompraController constructor.
     * @param OrdenCompra $ordenCompra
     * @param Pedimento $pedimento
     * @param Transito $transito
     * @param MontoPagoOrdenCompra $monto
     * @param PagoMontoOrdenCompra $pago
     * @param Proveedor $proveedor
     * @param User $usuario
     * @param Almacen $almacen
     * @param Producto $producto
     * @param CostoDestino $costoDestino
     * @param CostoOrigen $costoOrigen
     * @param ProductoOrdenCompra $productoOrdenCompra
     * @param GastosOrigenOrdenCompra $gastosOrigenOrden
     * @param GastosDestinoOrdenCompra $gastosDestinoOrden
     */
    public function __construct(OrdenCompra $ordenCompra, Pedimento $pedimento, Transito $transito, MontoPagoOrdenCompra $monto, PagoMontoOrdenCompra $pago,Proveedor $proveedor, User $usuario, Almacen $almacen, Producto $producto, CostoDestino $costoDestino, CostoOrigen $costoOrigen, ProductoOrdenCompra $productoOrdenCompra, GastosOrigenOrdenCompra $gastosOrigenOrden, GastosDestinoOrdenCompra $gastosDestinoOrden)
    {
        $this->mProveedor = $proveedor;
        $this->mUser = $usuario;
        $this->mAlmacen = $almacen;
        $this->mProducto = $producto;
        $this->mCostoDestino = $costoDestino;
        $this->mCostoOrigen = $costoOrigen;
        $this->mOrdenCompra = $ordenCompra;
        $this->mProductoOrdenCompra = $productoOrdenCompra;
        $this->mGastosOrigenOrdenCompra = $gastosOrigenOrden;
        $this->mGastosDestinoOrdenCompra = $gastosDestinoOrden;
        $this->mPagoMontoPagoOrden = $pago;
        $this->mMontoPagoOrden = $monto;
        $this->mTransito = $transito;
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

        return view('admin.ordenes.create')->with([
            'proveedores' => $this->mProveedor->all(),
            'usuarios' => $this->mUser->all(),
            'almacenes' => $this->mAlmacen->all(),
            'productos' => $this->mProducto->all(),
            'gastosDestino' => $this->mCostoDestino->all(),
            'gastosOrigen' => $this->mCostoOrigen->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $oRequest
     * @return \Illuminate\Http\Response
     */
    public function store(OrdenCompraRequest $oRequest)
    {
        try {
            // Orden de compra
            $ordenCompra = $this->mOrdenCompra->create([
                'status'            => $oRequest->status,
                'identificador'     => $oRequest->id_orden,
                'encargdo_interno'  => $oRequest->encargado,
                'descripcion'       => $oRequest->descripcion,
                'fecha_inicio'      => $oRequest->fecha_inicio,
                'tipo_compra'       => $oRequest->tipo_compra,
                'requerimiento'     => $oRequest->requerimiento,
                'proveedor_id'      => $oRequest->proveedor,
                'almacen_id'        => $oRequest->almacen_llegada,
            ]);

            // Pedimento
            if ($oRequest->has('pedimento')) {
                $pedimento = new PedimentoController($this->mPedimento);
                $pedimento->store($oRequest, $ordenCompra);
            }

            // Transito
            if ($oRequest->has('transito')) {
                $transito = new TransitoController($this->mTransito);
                $transito->store($oRequest, $ordenCompra);
            }

            // Gastos destino
            if ($oRequest->has('gastosDe')) {
                $gastosDestino = new GastosDestinoController($this->mGastosDestinoOrdenCompra);
                $gastosDestino->store($oRequest, $ordenCompra);
            }

            // Productos
            if ($oRequest->has('productos')) {
                $producto = new ProductoController($this->mProductoOrdenCompra);
                $producto->store($oRequest, $ordenCompra);
            }

            // Gastos origen
            if ($oRequest->has('gastosOr')) {
                $gastosOrigen  = new GastosOrigenController($this->mGastosOrigenOrdenCompra);
                $gastosDestino->store($oRequest, $ordenCompra);
            }


            // Alerta
            $notification = array(
                'message' => 'Orden de compra ceada exitosamente.',
                'alert-type' => 'success'
            );

            return redirect()->route('home')->with($notification);

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
            $oValidator = Validator::make(['id' => $id], [
                'id' => 'required|numeric',
            ]);
            if ($oValidator->fails()) {
                throw new HttpResponseException(redirect()->back()->withErrors($oValidator));
            }
            // Busca orden
            $oOrdenCompra = $this->mOrdenCompra->find($id);
            if ($oOrdenCompra == null) {
                return view('admin/errores/no_encontrado')->with(['model' => 'OrdenCompra', 'id' => $id]);
            }
            // Elimina orden compra
            $oOrdenCompra->delete();

            // Alerta
            $notification = array(
                'message' => 'Orden de compra eliminada',
                'alert-type' => 'error'
            );
            return redirect()->route('home')->with($notification);
        }catch (\Exception $e) {
            // Alerta
            $notification = array(
                'message' => 'Ocurrio algun error',
                'alert-type' => 'warning'
            );
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
            return redirect()->back()->with($notification);
        }
    }


    /**
     * Guardado de archivos
     * @param $path
     * @param $identificador
     * @param $archivo
     * @param $tipoArchivo
     * @return string
     */
    private function guardaArchivo($identificador,$archivo,$tipoArchivo)
    {
        ///obtenemos el campo file definido en el formulario
        $file = $archivo;
        //obtenemos el nombre del archivo
        $nombreSubs = $tipoArchivo.$identificador;
        $nombre = $nombreSubs.$file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));

        return $nombre;
    }

}
