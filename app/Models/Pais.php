<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'country';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
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
