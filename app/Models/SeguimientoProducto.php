<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SeguimientoProducto extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'seguimiento_productos';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'foto_preproduccion',
        'foto_produccion',
        'foto_oem_uno',
        'foto_oem_dos',
        'foto_oem_tres',
        'foto_empaquetado',
        // Llaves foraneas
        'orden_compra_id',
        'producto_orden_id',
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
     * Producto de orden (producto_orden_id).
     */
    public function productoOrden()
    {
        return $this->belongsTo('App\Models\ProductoOrdenCompra', 'producto_orden_id');
    }

    /**
     * Orden compra (orden_compra_id).
     */
    public function ordenCompra()
    {
        return $this->belongsTo('App\Models\OrdenCompra', 'orden_compra_id');
    }
}
