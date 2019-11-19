<?php

namespace App\Http\Controllers\Admin\Csv;

use App\CSV;
use App\Models\Aduana;
use App\Models\AgenteAduanal;
use App\Models\CaracteristicaProducto;
use App\Models\ClasificacionAduanera;
use App\Models\DisenoProducto;
use App\Models\Forwarder;
use App\Models\MetodoTransito;
use App\Models\PagoMontoOrdenCompra;
use App\Models\Pedimento;
use App\Models\SeguimientoProducto;
use App\Models\Transito;
use App\Models\Almacen;
use App\Models\CostoDestino;
use App\Models\CostoOrigen;
use App\Models\GastosDestinoOrdenCompra;
use App\Models\GastosOrigenOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\Producto;
use App\Models\ProductoOrdenCompra;
use App\Models\ProductVariant;
use App\Models\Proveedor;
use App\Models\Currency;
use App\Models\TipoCompra;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Concerns\ToModel;

class ComprasImport implements ToModel
{
   
   public function model(array $row)
   {
      return new Compra([
         'Tipo'     => $row[0],
         'comprador'     => $row[1],
         'proveedor'    => $row[5],
         'sku' => $row[6],
         'producto' => $row[7],
         'cantidad' => $row[8],
         'costo' => $row[9],
         'envio' => $row[11],
         'guia' => $row[14],
         'fecha_llegada' => $row[16],
         'monto' => $row[17],
         'tc' => $row[18],
         'fecha_primer' => $row[20],
         'monto_segundo' => $row[22],
         'tc2' => $row[23],
         'fecha_segundo' => $row[25],
         'status' => $row[30],
      ]);
   }
}

class CsvController extends Controller
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
   protected $mForwarderTransito;
   protected $mSeguimiento;
   protected $mCaracteristica;
   protected $mClasificacion;
   protected $mDiseno;
   protected $mCurrency;
   protected $mProductVariant;
   protected $mTipoCompra;
   
   public function __construct(OrdenCompra $ordenCompra,
                               DisenoProducto $diseno,
                               ClasificacionAduanera $clasificacion,
                               CaracteristicaProducto $caracteristica,
                               SeguimientoProducto $seguimiento,
                               MetodoTransito $metodoTransito,
                               Forwarder $forwarderTransito,
                               Aduana $aduana,
                               AgenteAduanal $agenteAduanal,
                               Pedimento $pedimento,
                               Transito $transito,
                               PagoMontoOrdenCompra $pagoMontoOrdenCompra,
                               Proveedor $proveedor,
                               User $usuario,
                               Almacen $almacen,
                               Producto $producto,
                               ProductVariant $productVariant,
                               CostoDestino $costoDestino,
                               CostoOrigen $costoOrigen,
                               ProductoOrdenCompra $productoOrdenCompra,
                               GastosOrigenOrdenCompra $gastosOrigenOrden,
                               GastosDestinoOrdenCompra $gastosDestinoOrden,
                               Currency $currency,
                               TipoCompra $tipoCompra)
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
      $this->mPagoMontoPagoOrden = $pagoMontoOrdenCompra;
      $this->mTransito = $transito;
      $this->mPedimento = $pedimento;
      $this->mAduana = $aduana;
      $this->mAgenteAduanal = $agenteAduanal;
      $this->mMetodoTransito = $metodoTransito;
      $this->mForwarderTransito = $forwarderTransito;
      $this->mSeguimiento = $seguimiento;
      $this->mCaracteristica = $caracteristica;
      $this->mClasificacion = $clasificacion;
      $this->mDiseno = $diseno;
      $this->mCurrency = $currency;
      $this->mProductVariant = $productVariant;
      $this->mTipoCompra = $tipoCompra;
   }

    public function index()
    {
        return view('admin.ordenes.csv');
    }


  
    public function compras(Request $request){
      $array = Excel::toArray(new ComprasImport, request()->file('file'), null)[0];
      //dd($array);
       for ($i = 1; $i <= count($array); $i++) {
          $data = isset($array[$i])?$array[$i]:null;
          //dd($data);
          if(isset($data)) {
             $encargadoName = $data[1];
             $proveedorName = $data[19];
             $fechaInicio = $data[2];
             $po = $data[3];
             $CBM = $data[26];
             $almacenId = 1;
             $tipoDeCompraNombre = (empty($data[0]) || is_null($data[0])) ? 'NUEVO': $data[0];
             $requerimiento = 'normal';
             $statusPo = $data[44];
             $envio = $data[25];
             $descripcion = $data[48];
             $sku = $data[20];
             $productName = $data[21];
             $cantidad = $data[22];
             $costoUsd = $data[23];
             $guia = $data[28];
             $comercialInvoice = $data[18];
             $montoPrimerPago = $data[31];
             $tipoCambioPrimerPago = $data[32];
             $fechaPrimerPago = (empty($data[34]) || is_null($data[34])) ? null : $data[34];
             $montoSegundoPago = $data[36];
             $tipoCambioSegundoPago = $data[37];
             $fechaSegundoPago = (empty($data[39]) || is_null($data[39])) ? null : $data[39];
             $fechLlegadaPuerto = ( empty($data[29]) || is_null($data[29])) ? null : $data[29];
             $fechLlegadaAlmacen =( empty($data[30]) || is_null($data[30])) ? null : $data[30];
   
             $encargado = $this->mUser->where('name', $encargadoName)->first();
             if(is_null($encargado) && isset($encargadoName)){
                $encargado = $this->mUser->create([
                   'name' => $encargadoName,
                   'email' => $encargadoName.'@compras.com',
                   'password' => '$2y$10$Oersmp9dnv5Q7zL8TAwlo.OxixOu0o5BI7lFUOuNiVxj8pZp656pe'
                ]);
             }
   
             $proveedor = $this->mProveedor->where('name', $proveedorName)->first();
             if(is_null($proveedor)){
                $proveedor = $this->mProveedor->create([
                   'name'            =>  isset($proveedorName) ? $proveedorName : 'No name',
                   'email'     => ''
                ]);
                $proveedorId = $proveedor->id;
             } else {
                $proveedorId = $proveedor->id;
             }
   
   
             $tipoDeCompra = $this->mTipoCompra->where('nombre', $tipoDeCompraNombre)->first();
             if(is_null($tipoDeCompra)){
                $tipoDeCompra = $this->mTipoCompra->create([
                   'nombre'      => isset($tipoDeCompraNombre) ? $tipoDeCompraNombre: 'No name'
                ]);
                $tipoDeCompraId = $tipoDeCompra->id;
             } else {
                $tipoDeCompraId = $tipoDeCompra->id;
             }
   
   
             $ordenCompra = $this->mOrdenCompra->where('po', $po)->first();
             if(is_null($ordenCompra)){
                // Orden de compra
                $ordenCompra = $this->mOrdenCompra->create([
                   'status'            => $statusPo,
                   'identificador'     => $po,
                   'po'                => $po,
                   'encargdo_interno'  => $encargadoName,
                   'fecha_inicio'      => $fechaInicio,
                   'tipo_compra'       => $tipoDeCompraId,
                   'requerimiento'     => $requerimiento,
                   'proveedor_id'      => $proveedorId,
                   'almacen_id'        => $almacenId,
                   'metodo_envio'      => $envio,
                   'fecha_recepcion'   => $fechLlegadaAlmacen,
                   'guia'              => $guia,
                   'comercial_invoice' => $comercialInvoice,
                   'CBM'               => $CBM
                ]);
                $ordenCompraId = $ordenCompra->id;
             } else {
                $ordenCompraId = $ordenCompra->id;
                $ordenCompra->update([
                   'status'            => $statusPo,
                   'identificador'     => $po,
                   'po'                => $po,
                   'encargdo_interno'  => $encargadoName,
                   'fecha_inicio'      => $fechaInicio,
                   'tipo_compra'       => $tipoDeCompraId,
                   'requerimiento'     => $requerimiento,
                   'proveedor_id'      => $proveedorId,
                   'almacen_id'        => $almacenId,
                   'metodo_envio'      => $envio,
                   'fecha_recepcion'   => $fechLlegadaAlmacen,
                   'guia'              => $guia,
                   'comercial_invoice' => $comercialInvoice,
                   'CBM'               => $CBM
                ]);
             }
   
             $producto_id = 0;
             $producto = $this->mProducto->where('sku', $sku)->first();
             if(is_null($producto)){
                $producto = $this->mProducto->create([
                   'sku'  => $sku,
                   'name' =>  isset($productName) ?$productName : '',
                   'description' => $descripcion,
                   'cost' =>  isset($costoUsd) ? $costoUsd:0,
                   'purchase_product_status_id' => 1
                ]);
                $producto_id = $producto->id;
             } else {
                $producto_id = $producto->id;
             }
   
             if($producto_id != 0) {
                $productoCompra = $this->mProductoOrdenCompra->create([
                   'cantidad' => $cantidad,
                   'costo' => $costoUsd,
                   'total' => $cantidad * $costoUsd,
                   'incoterm' => NULL,
                   'leadtime' => NULL,
                   'orden_compra_id' => $ordenCompraId,
                   'producto_id' => $producto_id,
                   'product_variant_id' => 0,
                ]);
   
                $total = 0;
   
                $productos = ProductoOrdenCompra::where('orden_compra_id', $ordenCompraId)
                   ->get();
   
                foreach ($productos as $producto) {
                   $total += $producto->total;
                }
             }
             $ordenCompra->total = $total;
             $ordenCompra->update();
            if($montoPrimerPago > 0){
               $pago1 = $this->mPagoMontoPagoOrden->create([
                  'pago' => $montoPrimerPago,
                  'tipo_cambio_pago' => $tipoCambioPrimerPago,
                  'comrpobante' => '',
                  'orden_compra_id' => $ordenCompraId,
                  'fecha_pago' => $fechaPrimerPago,
                  'currency_id' => 1
               ]);
            }
            
            if($montoSegundoPago >0){
               $pago2 = $this->mPagoMontoPagoOrden->create([
                  'pago' => $montoSegundoPago,
                  'tipo_cambio_pago' => $tipoCambioSegundoPago,
                  'comrpobante' => '',
                  'orden_compra_id' => $ordenCompraId,
                  'fecha_pago' => $fechaSegundoPago,
                  'currency_id' => 1
               ]);
            }
           
   
             $totalPagado = 0;
   
             $pagos = PagoMontoOrdenCompra::where('orden_compra_id', $ordenCompraId)
                ->get();
   
             foreach ($pagos as $pago) {
                $totalPagado += $pago->pago;
             }
   
             $ordenCompra->pagado = $totalPagado;
             $ordenCompra->update();
          }
          
       }
       
       
       return redirect('/admin/ordenes')->with('success', 'All good!');
 
    }

}
