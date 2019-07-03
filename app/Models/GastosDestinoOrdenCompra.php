<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GastosDestinoOrdenCompra extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'gasto_destino_orden_compra';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'moneda',
        'notas',
        'comprobante',
        // Llaves foraneas
        'orden_compra_id',
        'tipo_gasto_destino_id',
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
     * Tipo de gasto (tipo_gasto_id)
     */
    public function tipoGasto()
    {
        return $this->belongsTo('App\Models\CostoDestino', 'tipo_gasto_destino_id');
    }
}
