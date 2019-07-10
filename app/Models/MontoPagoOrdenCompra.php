<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MontoPagoOrdenCompra extends Model
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
        'monto',
        'tipo_cambio',
        'comprobante_monto',
        'bfcv',
        'total_pagado',
        'restante',
        // Llaves foraneas
        'orden_compra_id',
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
     * Orden de compra a la que pertenece el pago (orden_compra_id)
     */
    public function ordenCompra()
    {
        return $this->belongsTo('App\Models\OrdenCompra', 'orden_compra_id');
    }
}
