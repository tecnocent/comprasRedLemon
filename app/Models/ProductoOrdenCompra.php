<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductoOrdenCompra extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'productos_orden_compra';
    public $timestamps = false;

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'cantidad',
        'costo',
        'total',
        'incoterm',
        'leadtime',
        'logo',
        'box',
        'archivo_fabricante',
        'archivo_diseno',
        'archivos',
        'tipo',
        'fecha_requerida',
        // Llaves foraneas
        'orden_compra_id',
        'producto_id',
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
     * Oden de compra del producto (orden_compra_id)
     */
    public function ordenCompra()
    {
        return $this->belongsTo('App\Models\OrdenCompra', 'orden_compra_id');
    }

    /**
     * Producto asociado (producto_id)
     */
    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }
}
