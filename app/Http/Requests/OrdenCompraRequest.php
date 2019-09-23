<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrdenCompraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'                        => 'alpha_spaces|in:borrador,po creada,pi pedido,por autorizar,produccion,enviado,aduana,recepcion,cancelado,almacen',
            'guia'                          => '',
            'total'                         => 'numeric|between:0.99,999999999.99',
            'pagado'                        => 'numeric|between:0.99,999999999.99',
            'id_orden'                      => 'alpha_dash|unique:orden_compra,identificador',
            'encargado'                     => '',
            'proveedor'                     => '',
            'fecha_inicio'                  => 'date|nullable',
            'almacen_llegada'               => '',
            'tipo_compra'                   => '',
            'requerimiento'                 => '',
            'descripcion_oc'                => 'max:255|nullable',
            //'sku'                           => 'array',
            //'sku.*'                         => '',
            //'cantidad_producto'             => 'array',
            //'cantidad_producto.*'           => 'numeric',
            //'costo_producto'                => 'array',
            //'costo_producto.*'              => 'numeric|between:0.99,999999999.99',
            //'subtotal_producto'             => 'array',
            //'subtotal_producto.*'           => 'numeric|between:0.99,999999999.99',
            //'icoterm_producto'              => 'array',
            //'icoterm_producto.*'            => '',
            //'leadtime_producto'             => 'array',
            //'leadtime_producto.*'           => 'numeric',
            //'archivosFrbricante'            => 'array',
            //'archivosFrbricante.*'          => 'file|nullable',
            //'archivosDiseno'                => 'array',
            //'archivosDiseno.*'              => 'file|nullable   ',
            //'tipo'                          => 'array',
            //'tipo.*'                        => '',
            //'fechaRequerida'                => 'array',
            //'fechaRequerida.*'              => 'date',
            //'tipo_gasto_origen'             => 'array',
            //'tipo_gasto_origen.*'           => '',
            //'costo_gastos_origen'           => 'array',
            //'costo_gastos_origen.*'         => '',
            //'nota_gastos_origen'            => 'array',
            //'nota_gastos_origen.*'          => 'max:255|nullable',
            //'tipo_gasto_gastos_destino'     => 'array',
            //'tipo_gasto_gastos_destino.*'   => '',
            //'costo_gastos_destino'          => 'array',
            //'costo_gastos_destino.*'        => 'between:0.99,999999999.99',
            //'moneda_gastos_destino'         => 'array',
            //'moneda_gastos_destino.*'       => 'string',
            //'nota_gastos_destino'           => 'array',
            //'nota_gastos_destino.*'         => 'max:255|nullable',
        ];
    }
    /**
     * @return array
     */
    public function attributes(){
        return [
            'id_orden'                      => '#OC',
            'proveedor'                     => 'Proveedor',
            'fecha_inicio'                  => 'Fecha de inicio',
            'almacen_llegada'               => 'Almacen de llegada',
            'encargado'                     => 'Encargado interno',
            'tipo_compra'                   => 'Tipo de compra',
            'requerimiento'                 => 'Requerimiento',
            'descripcion_oc'                => 'Descripción de orden',
            'sku'                           => 'SKU',
            'cantidad_producto'             => 'Cantidad',
            'costo_producto'                => 'Costo de producto',
            'subtotal_producto'             => 'Subtotal',
            'icoterm_producto'              => 'IcoTerm',
            'leadtime_producto'             => 'Lead Time',
            'archivosFrbricante.*'          => 'Archivos de fabricante',
            'archivosDiseno.*'              => 'Archivos de diseño',
            'tipo'                          => 'Tipo',
            'fechaRequerida'                => 'Fecha requerida',
            'tipo_gasto_origen'             => 'Tipo de gastos de origen',
            'costo_gastos_origen'           => 'Costo de gastos de origen',
            'nota_gastos_origen'            => 'Nota gastosde origen',
            'tipo_gasto_gastos_destino'     => 'Tipo gastos de origen',
            'costo_gastos_destino'          => 'Costo gastos de destino',
            'moneda_gastos_destino'         => 'Moneda',
            'nota_gastos_destino'           => 'Nota gastos de destino',
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        if($validator->fails()) {
            throw new HttpResponseException(redirect()->back()->withErrors($validator));
        }
    }
}
