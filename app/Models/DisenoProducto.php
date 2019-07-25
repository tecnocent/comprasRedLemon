<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DisenoProducto extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'diseno_producto_orden';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'logo',
        'box',
        'instructivo',
        'archivo_fabricante',
        'archivo_diseno',
        'tipo',
        'fecha_requerida',
        // Relaciones
        'orden_compra_id',
        'producto_id'
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
