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
        'oem',
        'empaque',
        'instructivo',
        'fecha_aviso_diseno',
        'producto_diseno',
        'empaque_diseno',
        'instructivo_diseno',
        'oem_autorizado_trafico',
        'fecha_autorizacion_trafico',
        'archivos_fabricante',
        'archivos_diseno',
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
