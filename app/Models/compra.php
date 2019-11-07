<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Compra extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'Tipo',
       'comprador',
       'proveedor',
       'sku',
       'producto',
       'cantidad',
       'costo',
       'envio',
       'guia',
       'fecha_llegada',
       'monto',
       'tc',
       'fecha_primer',
       'monto_segundo' ,
       'tc2',
       'fecha_segundo',
       'status',
    ];

    
}
