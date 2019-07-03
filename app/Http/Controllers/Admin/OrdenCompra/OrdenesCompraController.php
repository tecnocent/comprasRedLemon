<?php

namespace App\Http\Controllers\Admin\OrdenCompra;

use App\Http\Requests\OrdenCompraRequest;
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
use Prologue\Alerts\Facades\Alert;
use Validator;

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


    /**
     * OrdenesConpraController constructor.
     * @param Proveedor $proveedor
     */
    public function __construct(OrdenCompra $ordenCompra, Proveedor $proveedor, User $usuario, Almacen $almacen, Producto $producto, CostoDestino $costoDestino, CostoOrigen $costoOrigen, ProductoOrdenCompra $productoOrdenCompra, GastosOrigenOrdenCompra $gastosOrigenOrden, GastosDestinoOrdenCompra $gastosDestinoOrden)
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
            // Productos
            if ($oRequest->has('productos')) {
                foreach ($oRequest->get('productos') as $prod ) {
                    $logo = (in_array('logo', $prod)) ? true : false;
                    $oem = (in_array('oem', $prod)) ? true : false;
                    $instructivo = (in_array('instructivo', $prod)) ? true : false;

                    $productoOrden = $this->mProductoOrdenCompra->create([
                        'cantidad' => $prod['cantidad_producto'],
                        'costo' => $prod['costo_producto'],
                        'total' => $prod['subtotal_producto'],
                        'incoterm' => $prod['icoterm_producto'],
                        'leadtime' => $prod['leadtime_producto'],
                        'logo' => $logo,
                        'box' => $oem,
                        'instructivo' => $instructivo,
                        'archivos_fabricante' => null,
                        'archivos_design' => null,
                        'tipo' => $prod['tipo'],
                        'fecha_requerida' => $prod['fechaRequerida'],
                        'orden_compra_id' => $ordenCompra->id,
                        'producto_id' => $prod['producto_id'],
                    ]);
                }
            }
            // Gastos origen
            if ($oRequest->has('gastosOr')) {
                foreach ($oRequest->get('gastosOr') as $gast ) {
                    $gOrigen = $this->mGastosOrigenOrdenCompra->create([
                        'costo' => $gast['costo_gastos_origen'],
                        'notas' => $gast['nota_gastos_origen'],
                        'comprobante' => $gast['comprobante_gastos_origen'],
                        'orden_compra_id' => $ordenCompra->id,
                        'tipo_gasto_id' => $gast['tipo_gasto_origen'],
                    ]);
                }
            }
            // Gastos destino
            if ($oRequest->has('gastosDe')) {
                foreach ($oRequest->get('gastosDe') as $gast ) {
                    $gOrigen = $this->mGastosDestinoOrdenCompra->create([
                        'moneda' => $gast['moneda_gastos_destino'],
                        'costo' => $gast['costo_gastos_destino'],
                        'notas' => $gast['nota_gastos_destino'],
                        'comprobante' => $gast['comporbante_gastos_destino'],
                        'orden_compra_id' => $ordenCompra->id,
                        'tipo_gasto_destino_id' => $gast['tipo_gasto_gastos_destino'],
                    ]);
                }
            }
            // Alerta
            $notification = array(
                'message' => 'Orden de compra ceada exitosamente.',
                'alert-type' => 'success'
            );
            return redirect()->route('home')->with($notification);

        } catch (\Exception $e) {
            dd($e->getMessage());
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
}
