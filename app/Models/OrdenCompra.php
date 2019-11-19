<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrdenCompra extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'orden_compra';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'guia',
        'total',
        'pagado',
        'identificador',
        'descripcion',
        'fecha_inicio',
        'tipo_compra',
        'requerimiento',
        'fecha_recepcion',
        'metodo_envio',
        'comercial_invoice',
        'CBM',
        // Relaciones
        'proveedor_id',
        'almacen_id',
        'encargdo_interno',
        'po'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Relaciones ===========================================
     */

    /**
     * Orden de proveedor (proveedor_id).
     */
    public function proveedor()
    {
        return $this->belongsTo('App\Models\Proveedor', 'proveedor_id');
    }

    /**
     *  Relacion almacen (almacen_id)
     */
    public function almacen()
    {
        return $this->belongsTo('App\Models\Almacen', 'almacen_id');
    }

    /**
     *  Relacion tipo de compra (tipo_compra)
     */
    public function tipoCompra()
    {
        return $this->belongsTo('App\Models\TipoCompra', 'tipo_compra');
    }

    public function productosOrdenCompra()
    {
        return $this->hasMany('App\Models\ProductoOrdenCompra', 'orden_compra_id');
    }
}
