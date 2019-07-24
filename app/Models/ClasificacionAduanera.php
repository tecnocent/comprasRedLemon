<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ClasificacionAduanera extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'clasificacion_aduaneras';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'clasificacion_arancelaria',
        'nom_1',
        'nom_2',
        'nom_3',
        'nom_4',
        // Llaves foraneas
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
     * Producto (agente_aduanal_id).
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
