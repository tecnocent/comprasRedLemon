<?php

namespace App\Http\Controllers\Admin\OrdenCompra;

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
use Validator;
use File;

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
            // Pagos
           ////if ($oRequest->has('monto')) {

           //    dd($oRequest->all());
           //    // Guardado de archivos producto
           //    $archivos = [];
           //    $comprobantesMonto = $oRequest->file('pagos');
           //    foreach ($oRequest->pagos as $pago) {
           //        $montoPago = $this->mMontoPagoOrden->create([
           //            'monto'             => $pago['monto_pagos'],
           //            'tipo_cambio'       => $pago['tipo_cambio_monto'],
           //            'comprobante_monto' => null,
           //            'bfcv'              => $pago['bfcv'],
           //            'total_pagado'      => $pago['total_pagado'],
           //            'restante'          => $pago['monto_pagos'] - $pago['total_pagado'],
           //            'orden_compra_id'   => 1,
           //        ]);
           //    }
           //}
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
            $identificador = $ordenCompra->id;
            // Productos
            if ($oRequest->has('productos')) {
                // Guardado de archivos producto
                $archivos = [];
                $archivosProductos = $oRequest->file('productos');
                if (isset($archivosProductos)) {
                    for ($i = 0; $i < count($archivosProductos); $i++) {
                        $fabricante = $archivosProductos[$i]['archivosFabricante'];
                        $design = $archivosProductos[$i]['archivosDiseno'];
                        if ($fabricante) {
                            $archivoFab = $this->guardaArchivo($identificador, $fabricante, 'archivo-fabricante-');
                            $archivos[] = $archivoFab;
                        }
                        if ($design) {
                            $archivoDis = $this->guardaArchivo($identificador, $design, 'archivo-design-');
                            $archivos[] = $archivoDis;
                        }
                    }
                }
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
                        'archivos' => json_encode($archivos),
                        'tipo' => $prod['tipo'],
                        'fecha_requerida' => $prod['fechaRequerida'],
                        'orden_compra_id' => $ordenCompra->id,
                        'producto_id' => $prod['producto_id'],
                    ]);
                }
            }
            // Gastos origen
            if ($oRequest->has('gastosOr')) {
                $archivosG = [];
                $archivosGastosOrigen = $oRequest->file('gastosOr');
                if (isset($archivosGastosOrigen)) {
                    for ($i = 0; $i < count($archivosGastosOrigen); $i++) {
                        $gastos = $archivosGastosOrigen[$i]['comprobante_gastos_origen'];
                        if ($gastos) {
                            $archivoGastosOr = $this->guardaArchivo($identificador, $gastos, 'archivo-gastosO-');
                            $archivosG[] = $archivoGastosOr;
                        }
                    }
                }
                foreach ($oRequest->get('gastosOr') as $gast ) {
                    $gOrigen = $this->mGastosOrigenOrdenCompra->create([
                        'costo' => $gast['costo_gastos_origen'],
                        'notas' => $gast['nota_gastos_origen'],
                        'comprobante' => json_encode($archivosG),
                        'orden_compra_id' => $ordenCompra->id,
                        'tipo_gasto_id' => $gast['tipo_gasto_origen'],
                    ]);
                }
            }
            // Gastos destino
            if ($oRequest->has('gastosDe')) {
                $archivosD = [];
                $archivosGastosDestino = $oRequest->file('gastosDe');
                if (isset($archivosGastosDestino)) {
                    for ($i = 0; $i < count($archivosGastosDestino); $i++) {
                        $gastosDestino = $archivosGastosDestino[$i]['comporbante_gastos_destino'];
                        if ($gastosDestino) {
                            $archivoDestino = $this->guardaArchivo($identificador, $gastosDestino, 'archivo-gastosD-');
                            $archivosD[] = $archivoDestino;
                        }
                    }
                }
                foreach ($oRequest->get('gastosDe') as $gast ) {
                    $gOrigen = $this->mGastosDestinoOrdenCompra->create([
                        'moneda' => $gast['moneda_gastos_destino'],
                        'costo' => $gast['costo_gastos_destino'],
                        'notas' => $gast['nota_gastos_destino'],
                        'comprobante' => json_encode($archivosD),
                        'orden_compra_id' => $ordenCompra->id,
                        'tipo_gasto_destino_id' => $gast['tipo_gasto_gastos_destino'],
                    ]);
                }
            }
            // Transito
            if ($oRequest->has('transito')) {
                foreach ($oRequest->get('transito') as $transito ) {
                    $transito = $this->mTransito->create([
                        'guia' => $transito['guia_transito'],
                        'fecha_embarque' => $transito['fecha_embarque_transito'],
                        'fecha_tentativa' => $transito['fecha_tentativa_llegada_transito'],
                        'comercual_invoce' => $transito['comercial_invoce_transito'],
                        'comercial_invoce_file' => null,
                        'cajas' => $transito['cajas_transito'],
                        'cbm' => $transito['cbm_transito'],
                        'peso' => $transito['peso_transito'],
                        'metodo_id' => $transito['metodo_transito'],
                        'forwarder_id' => $transito['forwarder_transito'],
                        'orden_compra_id' => $identificador
                    ]);
                }
            }
            // Pedimento
            if ($oRequest->has('pedimento')) {
                foreach ($oRequest->get('pedimento') as $pedimento ) {
                    $pedimento = $this->mPedimento->create([
                        'pedimento' => $pedimento['numero_pedimento'],
                        'pedimento_digital' => null,
                        'tipo_cambio_pedimento' => $pedimento['tipo_cambio_pedimento_pedimento'],
                        'dta' => $pedimento['dta_pedimento'],
                        'cnt' => $pedimento['cnt_pedimento'],
                        'igi' => $pedimento['igi_pedimento'],
                        'prv' => $pedimento['prv_pedimento'],
                        'iva' => $pedimento['iva_pedimento'],
                        'orden_compra_id' => $identificador,
                        'aduana_id' => $pedimento['aduana_pedimento'],
                        'agente_aduanal_id' => $pedimento['agente_aduanal_pedimento']
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
