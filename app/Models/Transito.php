<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transito extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'transito_orden_compra';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'guia',
        'fecha_embarque',
        'fecha_tentativa',
        'comercual_invoce',
        'comercial_invoce_file',
        'cajas',
        'cbm',
        'peso',
        // Llaves foraneas
        'metodo_id',
        'forwarder_id',
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
     * Metodo Transito (metodo_id)
     */
    public function metodoTransito()
    {
        return $this->belongsTo('App\Models\MetodoTransito', 'metodo_id');
    }

    /**
     * Forwarder (forwarder_id)
     */
    public function forwarderTransito()
    {
        return $this->belongsTo('App\Models\Forwarder', 'forwarder_id');
    }

    /**
     * Orden Compra (orden_compra_id)
     */
    public function ordenCompra()
    {
        return $this->belongsTo('App\Models\OrdenCompra', 'orden_compra_id');
    }

}
