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
        'tipo_cambio_pago',
        'comrpobante',
        // Llaves foraneas
        'monto_pago_id',
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
     * Monto al que pertenece el pago (monto_pago_id)
     */
    public function montoOrden()
    {
        return $this->belongsTo('App\Models\MontoPagoOrdenCompra', 'monto_pago_id');
    }
}
