<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proveedor extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'providers';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tax',
        'contactname',
        'direction',
        'country',
        'phone',
        'wechat',
        'whatsapp',
        'email',
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
