<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AgenteAduanal extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'agente_aduanal';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apelldos',
        // Llaves foraneas
        'aduana_id'
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
}
