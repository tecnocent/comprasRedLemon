<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Currency extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'currency';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code'
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
