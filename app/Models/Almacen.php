<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Almacen extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'warehouse';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip_code',
        'contact_number',
        'country_id',
        'type_id',
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
     * Pais de proveedor (country_id).
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Pais', 'country_id');
    }

}
