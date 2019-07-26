<?php

namespace App\Http\Controllers\Admin\OrdenCompra;

use App\Http\Controllers\Admin\CaracteristicaProducto\CaracteristicaProductoController;
use App\Http\Controllers\Admin\ClasificacionAduanera\ClasificacionAduaneraController;
use App\Http\Controllers\Admin\GastosDestino\GastosDestinoController;
use App\Http\Controllers\Admin\GastosOrigen\GastosOrigenController;
use App\Http\Controllers\Admin\Pago\PagoOrdenController;
use App\Http\Controllers\Admin\Pedimento\PedimentoController;
use App\Http\Controllers\Admin\Producto\ProductoController;
use App\Http\Controllers\Admin\SeguimientoProducto\SeguimientoProductoController;
use App\Http\Controllers\Admin\Transito\TransitoController;
use App\Http\Requests\OrdenCompraRequest;
use App\Models\Aduana;
use App\Models\AgenteAduanal;
use App\Models\CaracteristicaProducto;
use App\Models\ClasificacionAduanera;
use App\Models\DisenoProducto;
use App\Models\MetodoTransito;
use App\Models\MontoPagoOrdenCompra;
use App\Models\PagoMontoOrdenCompra;
use App\Models\Pedimento;
use App\Models\SeguimientoProducto;
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
    protected $mPagoMontoPagoOrden;
    protected $mTransito;
    protected $mPedimento;
    protected $mAduana;
    protected $mAgenteAduanal;
    protected $mMetodoTransito;
    protected $mSeguimiento;
    protected $mCaracteristica;
    protected $mClasificacion;
    protected $mDiseno;


    public function __construct(OrdenCompra $ordenCompra, DisenoProducto $diseno, ClasificacionAduanera $clasificacion, CaracteristicaProducto $caracteristica, SeguimientoProducto $seguimiento, MetodoTransito $metodoTransito, Aduana $aduana, AgenteAduanal $agenteAduanal, Pedimento $pedimento, Transito $transito, PagoMontoOrdenCompra $pago,Proveedor $proveedor, User $usuario, Almacen $almacen, Producto $producto, CostoDestino $costoDestino, CostoOrigen $costoOrigen, ProductoOrdenCompra $productoOrdenCompra, GastosOrigenOrdenCompra $gastosOrigenOrden, GastosDestinoOrdenCompra $gastosDestinoOrden)
    {
        $this->middleware('auth');
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
        $this->mTransito = $transito;
        $this->mPedimento = $pedimento;
        $this->mAduana = $aduana;
        $this->mAgenteAduanal = $agenteAduanal;
        $this->mMetodoTransito = $metodoTransito;
        $this->mSeguimiento = $seguimiento;
        $this->mCaracteristica = $caracteristica;
        $this->mClasificacion = $clasificacion;
        $this->mDiseno = $diseno;
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
            'gastosOrigen' => $this->mCostoOrigen->all(),
            'aduanas' => $this->mAduana->all(),
            'agentesAduanales' => $this->mAgenteAduanal->all(),
            'metodosTransito' => $this->mMetodoTransito->all()
        ]);
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

            // Gastos origen
            if ($oRequest->has('gastosOr')) {
                $gastosOrigen  = new GastosOrigenController($this->mGastosOrigenOrdenCompra);
                $gastosOrigen->store($oRequest, $ordenCompra);
            }

            // Productos
            if ($oRequest->has('productos')) {
                $producto = new ProductoController($this->mProductoOrdenCompra);
                $producto->store($oRequest, $ordenCompra);

                //Seguimiento producto
                if ($oRequest->has('seguimiento')) {
                    $seguimiento = new SeguimientoProductoController($this->mSeguimiento);
                    $seguimiento->store($oRequest, $ordenCompra);
                }

                //Caracteristica producto
                if ($oRequest->has('caracteristicas')) {
                    $caracteristicaProducto = new CaracteristicaProductoController($this->mCaracteristica);
                    $caracteristicaProducto->store($oRequest, $ordenCompra);
                }

                //Clasificacion aduanera
                if ($oRequest->has('clasificaciones')) {
                    $clasificacionAduanera = new ClasificacionAduaneraController($this->mClasificacion);
                    $clasificacionAduanera->store($oRequest, $ordenCompra);
                }
            }

            // Pagos
            if ($oRequest->has('pago')) {
                $pago = new PagoOrdenController($this->mPagoMontoPagoOrden);
                $pago->store($oRequest, $ordenCompra);
            }

            return redirect()->route('orden.resumen',['id' => $ordenCompra->id]);

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
        $tiposCompra = \App\Models\TipoCompra::all();
        $orden = $this->mOrdenCompra->find($id);
        $productos = $this->mProductoOrdenCompra->where('orden_compra_id',$orden->id)->get();
        $gastosDestino = $this->mGastosDestinoOrdenCompra->where('orden_compra_id', $orden->id)->get();
        $gastosOrigen = $this->mGastosOrigenOrdenCompra->where('orden_compra_id', $orden->id)->get();
        $transitos = $this->mTransito->where('orden_compra_id', $orden->id)->get();
        $pedimentos = $this->mPedimento->where('orden_compra_id', $orden->id)->get();
        $pagos = $this->mPagoMontoPagoOrden->where('orden_compra_id', $orden->id)->get();
        $seguimientos = $this->mSeguimiento->where('orden_compra_id', $orden->id)->get();
        $caracteristicas = $this->mCaracteristica->where('orden_compra_id', $orden->id)->get();
        $clasificaciones = $this->mClasificacion->where('orden_compra_id', $orden->id)->get();
        $disenos = $this->mDiseno->where('orden_compra_id', $orden->id)->get();
        return view('admin.ordenes.show')->with([
            'orden'             => $orden,
            'proveedores'       => $this->mProveedor->all(),
            'productosOrden'    => $productos,
            'gastosDestinoOrden'=> $gastosDestino,
            'gastosOrigenOrden' => $gastosOrigen,
            'transitosOrden'    => $transitos,
            'pedimentosOrden'   => $pedimentos,
            'pagos'             => $pagos,
            'seguimientos'      => $seguimientos,
            'caracteristicas'   => $caracteristicas,
            'clasificaciones'   => $clasificaciones,
            'disenos'           => $disenos,
            'usuarios'          => $this->mUser->all(),
            'almacenes'         => $this->mAlmacen->all(),
            'productos'         => $this->mProducto->all(),
            'gastosDestino'     => $this->mCostoDestino->all(),
            'tiposCompra'       => $tiposCompra,
            'gastosOrigen'      => $this->mCostoOrigen->all(),
            'aduanas'           => $this->mAduana->all(),
            'agentesAduanales'  => $this->mAgenteAduanal->all(),
            'metodosTransito'   => $this->mMetodoTransito->all(),
        ]);
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
    public function update(Request $oRequest, $id)
    {
        try {
            $orden = $this->mOrdenCompra->find($id);
            $orden->update([
                'status'            => $oRequest->estatus,
                'encargdo_interno'  => $oRequest->encargado,
                'descripcion'       => $oRequest->descripcion,
                'fecha_inicio'      => $oRequest->fecha_inicio,
                'tipo_compra'       => $oRequest->tipo_compra,
                'requerimiento'     => $oRequest->requerimiento,
                'proveedor_id'      => $oRequest->proveedor,
                'almacen_id'        => $oRequest->almacen_llegada,
            ]);

            // Alerta
            $notification = array(
                'message' => 'Orden de actualizada correctamente',
                'alert-type' => 'success'
            );

            return redirect()->route('home')->with($notification);
        } catch (\Exception $e) {
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
     * @param $id
     * @return $this
     */
    public function resumen($id)
    {
        $orden = $this->mOrdenCompra->find($id);
        $productos = $this->mProductoOrdenCompra->where('orden_compra_id',$orden->id)->get();
        $gastosDestino = $this->mGastosDestinoOrdenCompra->where('orden_compra_id', $orden->id)->get();
        $gastosOrigen = $this->mGastosOrigenOrdenCompra->where('orden_compra_id', $orden->id)->get();
        $transitos = $this->mTransito->where('orden_compra_id', $orden->id)->get();
        $pedimentos = $this->mPedimento->where('orden_compra_id', $orden->id)->get();
        $pagos = $this->mPagoMontoPagoOrden->where('orden_compra_id', $orden->id)->get();
        $seguimientos = $this->mSeguimiento->where('orden_compra_id', $orden->id)->get();
        $caracteristicas = $this->mCaracteristica->where('orden_compra_id', $orden->id)->get();
        $clasificaciones = $this->mClasificacion->where('orden_compra_id', $orden->id)->get();

        return view('admin.ordenes.resumen')->with([
            'orden'             => $orden,
            'productos'         => $productos,
            'gastosDestino'     => $gastosDestino,
            'gastosOrigen'      => $gastosOrigen,
            'transitos'         => $transitos,
            'pedimentos'        => $pedimentos,
            'pagos'             => $pagos,
            'seguimientos'      => $seguimientos,
            'caracteristicas'   => $caracteristicas,
            'clasificaciones'   => $clasificaciones
        ]);
    }


    /**
     * @param $archivo
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function descarga($archivo)
    {
        $pathtoFile = public_path().'/documents/orden_compra/'.$archivo;
        return response()->download($pathtoFile);
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
