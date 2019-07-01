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
        // Relaciones
        'proveedor_id',
        'almacen_id',
        'encargdo_interno',
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
}
