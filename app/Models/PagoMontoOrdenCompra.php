<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PagoMontoOrdenCompra extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'pago_monto_orden_compra';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'pago',
        'referencia',
        'fecha_pago',
        'tipo_cambio_pago',
        'comrpobante',
        // Llaves foraneas
        'orden_compra_id',
        'currency_id'
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
     * Orden de compra (orden_compra_id)
     */
    public function ordenCompra()
    {
        return $this->belongsTo('App\Models\OrdenCompra', 'monto_pago_orden_compra_idid');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id');
    }

    public function tipoGasto()
    {
        return $this->belongsTo('App\Models\CostoOrigen', 'tipo_gasto_id');
    }
}
