<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pedimento extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'pedimentos';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'pedimento',
        'pedimento_digital',
        'tipo_cambio_pedimento',
        'dta',
        'cnt',
        'igi',
        'prv',
        'iva',
        // Llaves foraneas
        'orden_compra_id',
        'aduana_id',
        'agente_aduanal_id'
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
     * Aduana (aduana_id).
     */
    public function aduana()
    {
        return $this->belongsTo('App\Models\Aduana', 'aduana_id');
    }

    /**
     * Agente aduanal (agente_aduanal_id).
     */
    public function agenteAduanal()
    {
        return $this->belongsTo('App\Models\AgenteAduanal', 'agente_aduanal_id');
    }

    /**
     * Orden compra (orden_compra_id).
     */
    public function ordenCompra()
    {
        return $this->belongsTo('App\Models\OrdenCompra', 'orden_compra_id');
    }
}
