<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Producto extends Model
{
    // Traits
    use Notifiable;

    // Nombre de la tabla
    protected $table = 'products';

    /**
     * Atributos modificables
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'name',
        'barcode',
        'brand',
        'weight',
        'weight_unit',
        'buy_cost_price',
        'cost',
        'wholesale_price',
        'retail_sell_price',
        'image_url',
        'sat_code',
        'description',
        'country',
        'valuePerUnit',
        'variante',
        // Llaves foraneas
        'purchase_product_status_id',
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
     * Estatus de producto (purchase_product_status_id).
     */
    public function estatusProducto()
    {
        return $this->belongsTo('App\Models\EstatusProducto', 'purchase_product_status_id');
    }
}
