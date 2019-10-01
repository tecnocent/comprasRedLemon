<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductVariant extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'product_variant';
    public $timestamps = false;

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'variant',
        // Llaves foraneas
        'product_id'
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
     * Producto asociado (producto_id)
     */
    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'product_id');
    }
}
