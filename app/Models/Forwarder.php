<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Forwarder extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'forwarder';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'nombre',

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
}
