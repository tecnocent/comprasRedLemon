<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CaracteristicaProducto extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'caracteristica_productos';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'especificaciones_producto',
        'especificaciones_electricas',
        'link_amazon',
        'link_alibaba',
        'orden_compra_id',
        // Relaciones
        'producto_id',
        'orden_compra_id'
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
     * Producto (producto_id).
     */
    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }
    /**
     * Orden compra (orden_compra_id).
     */
    public function ordenCompra()
    {
        return $this->belongsTo('App\Models\OrdenCompra', 'orden_compra_id');
    }
}
