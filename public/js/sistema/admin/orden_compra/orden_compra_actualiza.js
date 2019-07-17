// Solo numeros
function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
}

function filestyle() {
    // recargo el filestyle
    $.ajax({
        url: '/dist/js/filestyle.js',
        dataType: 'script'
    });

}
//Suma
function sumar() {
    var total = 0;
    $(".monto").each(function() {
        if (isNaN(parseFloat($(this).val()))) {
            total += 0;
        } else {
            total += parseFloat($(this).val());
        }
    });
    document.getElementById('total_pagado').value = total;

}

// Solo numeros decimales
function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{
            return true;
        }
    }else{
        if(key == 8 || key == 13 || key == 0) {
            return true;
        }else if(key == 46){
            if(filter(tempValue)=== false){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if(preg.test(__val__) === true){
        return true;
    }else{
        return false;
    }

}

//Status de la orden
$("#borrador").click(function () {
    $("#status").val('borrador');
});
$("#po_creada").click(function () {
    $("#status").val('po creada');
});


// Funcion para select2 dentro de modal
$(document).ready(function() {
    $('#productosSelectCrea').select2({
        dropdownParent: $('#myModal2'),
        tags: "true",
        placeholder: "Selecciona",
        allowClear: true
    });
});
$(document).ready(function() {
    $('#productosSelectActualiza').select2({
        dropdownParent: $('#modal-actualiza-producto'),
        tags: "true",
        placeholder: "Selecciona",
        allowClear: true
    });
});
// Ajax trae descrupcion y id de productos
$('#productosSelectActualiza').on('select2:select', function (evt) {
    var producto_sku = $("#productosSelectActualiza").val();
    $.ajax({
        type: 'GET',
        url: "/api/productos",
        dataType: 'json',
        data: {
            'sku': producto_sku,
            'per_page':100
        },
        success: function(data){
            var resultados = [];
            $.each(data.data.productos.data, function(i, o) {
                var registro = {};
                registro.id = o.id;
                registro.description =  o.description;
                resultados.push(registro);
            });
            document.getElementById('producto_id_actualiza').value = resultados[0].id;
        }
    });
});
// Ajax trae descrupcion y id de productos
$('#productosSelectCrea').on('select2:select', function (evt) {
    var producto_sku = $("#productosSelectCrea").val();
    $.ajax({
        type: 'GET',
        url: "/api/productos",
        dataType: 'json',
        data: {
            'sku': producto_sku,
            'per_page':100
        },
        success: function(data){
            var resultados = [];
            $.each(data.data.productos.data, function(i, o) {
                var registro = {};
                registro.id = o.id;
                registro.description =  o.description;
                resultados.push(registro);
            });
            var producto_id = '<input type="hidden" class="form-control pull-right " id="producto_id_crea" name="producto_id" value="'+resultados[0].id+'">'
            var producto_descripcion = '<input type="hidden" class="form-control pull-right " id="producto_descripcion_crea" name="producto_descripcion" value="'+resultados[0].description+'">'

            $('.extras_crea').after(producto_id);
            $('.extras_crea').after(producto_descripcion);
        }
    });
});
// Funcion para subtotal
function multi(){
    var subtotal = 1;
    var change= false;
    $(".monto").each(function(){
        if (!isNaN(parseFloat($(this).val()))) {
            change= true;
            subtotal *= parseFloat($(this).val());
        }
    });
    subtotal = (change)? subtotal:0;
    document.getElementById('subtotal_producto_guarda').value = subtotal;
}
function multi_actauliza(){
    var subtotal = 1;
    var change= false;
    $(".monto_actualiza").each(function(){
        if (!isNaN(parseFloat($(this).val()))) {
            change= true;
            subtotal *= parseFloat($(this).val());
        }
    });
    subtotal = (change)? subtotal:0;
    document.getElementById('subtotal_producto_actualiza').value = subtotal;
}
// Valuda valor unico para #OC
function checkUniq(name, valor) {
    $.ajax({
        type: 'GET',
        url: "/api/ordenes",
        dataType: 'json',
        data: {
            'identificador': valor,
        },
        success: function(data){

            var resultados = [];
            $.each(data.data.ordenes.data, function(i, o) {
                var registro = {};
                registro.id = o.id;
                registro.description =  o.description;
                resultados.push(registro);
            });
            var producto_id = '<input type="hidden" class="form-control pull-right " id="producto_id" name="producto_id" value="'+resultados[0].id+'">'
            var producto_descripcion = '<input type="hidden" class="form-control pull-right " id="producto_descripcion" name="producto_descripcion" value="'+resultados[0].description+'">'

            $('.extras').after(producto_id);
            $('.extras').after(producto_descripcion);


            console.log(data);
            var error = '<label for="identificador" generated="true" class="error">EL #OC esta en uso</label>';
            $('#id_orden').after(error);
        }
    });
}
// Ajax trae descrupcion y id de productos
$('#productosSelectCrea').on('select2:select', function (evt) {
    var producto_sku = $("#productosSelectCrea").val();
    $.ajax({
        type: 'GET',
        url: "/api/productos",
        dataType: 'json',
        data: {
            'sku': producto_sku,
            'per_page':100
        },
        success: function(data){
            var resultados = [];
            $.each(data.data.productos.data, function(i, o) {
                var registro = {};
                registro.id = o.id;
                registro.description =  o.description;
                resultados.push(registro);
            });
            var producto_id = '<input type="hidden" class="form-control pull-right " id="producto_id_crea" name="producto_id" value="'+resultados[0].id+'">'
            var producto_descripcion = '<input type="hidden" class="form-control pull-right " id="producto_descripcion_crea" name="producto_descripcion" value="'+resultados[0].description+'">'

            $('.extras_crea').after(producto_id);
            $('.extras_crea').after(producto_descripcion);
        }
    });
});



// Guardado de productos
$(document).ready(function() {
    var cont = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
    var f = 1; //contador para asignar id al boton que borrara la fila
    $('#productos-form').validate({
        event: "blur",rules: {
            'nombre_productoM' : "required",
            'icoterm_productoM': "required",
            'leadtime_productoM': "required",
            'costo_productoM': "required",
            'cantidad_productoM': "required"
        },
        messages: {
            'nombre_producto' : " Selecciona un producto",
            'icoterm_producto' : "Icoterm requerido",
            'leadtime_producto' : "Lead Time requerido",
            'costo_producto' : "Costo requerido",
            'cantidad_producto' : "Cantidad requerida"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            form.submit();
        }
    });
});



// Guardado de Gasto origen
$(document).ready(function() {
    $('#gastos-origen-form').validate({
        event: "blur",rules: {
            'tipo_gasto_origenM' : "required",
            'costo_gastos_origenM' : "required"
        },
        messages: {
            'tipo_gasto_origenM' : "Selecciona un tipo de gasto",
            'costo_gastos_origenM' : "Costo requerido"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            form.submit();
        }
    });
});

// Guardado de Gasto destino
$(document).ready(function() {
    $('#gastos-destino-form').validate({
        event: "blur",rules: {
            'tipo_gasto_gastos_destinoM' : "required",
            'costo_gastos_destinoM' : "required",
            'moneda_gastos_destinoM' : "required"
        },
        messages: {
            'tipo_gasto_gastos_destinoM' : "Selecciona un tipo de gasto",
            'costo_gastos_destinoM' : "Costo requerido",
            'moneda_gastos_destinoM' : "Moneda requerido"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            form.submit();
        }
    });
});

// Llenado de Pagos
$(document).ready(function() {
    var contadorDiv = 0;
    //obtenemos el valor de los input
    $('#pagos-form').validate({
        event: "blur",rules: {
            'monto_pagos': "required",
            'tipo_cambio_monto_pagos': 'required',
            'bfcvu_pagos': 'required',
            'pago_pagos': 'required',
            'tipo_cambio_pago_pagos': 'required'
        },
        messages: {
            'monto_pagos': "El monto es requerido",
            'pago_pagos': "El pago es requerido",
            'bfcvu_pagos': "BFCV requerido",
            'tipo_cambio_pago_pagos': "Tipo de cambio es requerido",
            'tipo_cambio_monto_pagos': 'Tipo de cambio es requerido'
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            var monto_pagos = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="monto_pagos" name="monto['+ contadorDiv +'][monto_pagos]" value="'+ document.getElementById("monto_pagos").value +'"></div>',
                tipo_cambio_monto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_cambio_monto" name="monto['+ contadorDiv +'][tipo_cambio_monto]" value="'+ document.getElementById("tipo_cambio_monto_pagos").value +'"></div>',
                bfcv = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_cambio_monto" name="monto['+ contadorDiv +'][bfcv]" value="'+ document.getElementById("bfcvu_pagos").value +'"></div>',
                total_pagado = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="total_pagado" name="monto['+ contadorDiv +'][total_pagado]" value="'+ document.getElementById("total_pagado").value +'"></div>',
                buscaComprobante = '<input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" id="comprobante_monto" name="monto['+ contadorDiv +'][comprobanteMonto]" >';

            var monto = '<div class="row" id="remove-div-monto'+contadorDiv+'" class="remove-div-monto">\n' +
                '           <div class="panel panel-default">\n' +
                '               <div class="panel-heading">\n' +
                '                   <div class="row">\n' +
                '                       <div class="col-md-6 line">\n' +
                '                           <div class="form-group">\n' +
                '                               <h4>Monto USD</h4>\n' +
                '                               <h4>$ '+ monto_pagos +''+tipo_cambio_monto+''+bfcv+''+total_pagado+''+ document.getElementById("monto_pagos").value +'</h4>\n' +
                '                           </div>\n' +
                '                       </div>\n' +
                '                       <div class="col-md-5 line">\n' +
                '                           <div class="form-group">\n' +
                '                               <h4>Comprobante</h4>\n' +
                '                               '+ buscaComprobante +'\n' +
                '                           </div>\n' +
                '                       </div>\n' +
                '                       <div class="col-md-1 line">\n' +
                '                           <div class="form-group">\n' +
                '                               <button type="button" name="remove-monto" id="'+ contadorDiv +'" class="close remove-monto"><span aria-hidden="true">×</span></button>\n' +
                '                           </div>\n' +
                '                       </div>\n' +
                '                   </div>\n' +
                '               </div>\n' +
                '               <div class="panel-body">\n' +
                '                   <table id="pagos_a_guardar" class="table table-striped table-bordered pagos_a_guardar" cellspacing="0" width="100%">\n' +
                '                       <thead>\n' +
                '                           <tr>\n' +
                '                               <th>Pago $</th>\n' +
                '                               <th>Comprobante pago</th>\n' +
                '                           </tr>\n' +
                '                           <tbody id="forPagos">\n' +
                '                           </tbody>\n' +
                '                       </thead>\n' +
                '                   </table>\n' +
                '               </div>\n' +
                '           </div>\n' +
                '       </div>';

            $('.montoPago').after(monto);

            $(document).on('click', '.remove-monto', function() {
                var button_id = $(this).attr("id");
                console.log(button_id);
                $('#remove-div-monto' + button_id).remove();
                var nFilas = $(".montoPago").length;
            });
            var pagos = [];
            $('input[name^="pago_pagos"]').each(function() {
                pagos = pagos.concat($(this).val());
            });
            var tipoCambioPago = [];
            $('input[name^="tipo_cambio_pago_pagos"]').each(function() {
                tipoCambioPago = tipoCambioPago.concat($(this).val());
            });
            function logArrayElements(element, index, array) {
                var cuentaPago = 0;
                var filas = 0;
                element.pagosInput.forEach(function(e) {
                    pagoHTML = '<td>'+e+'<input type="hidden" class="form-control pull-right " id="pago-pagos" name="monto['+ cuentaPago +'][pagoP  ]pagos[]pago[]" value="'+ e +'"></td>' +
                        '<td><input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" id="comprobante_pago['+cuentaPago+']" name="monto['+ cuentaPago +'][pagos['+cuentaPago+'][comprobantePago]]" ></td>';

                    fila = fila.concat(pagoHTML);
                    cuentaPago++;
                });
                var cuentaTipoCam = 0;
                element.tipoCambioInput.forEach(function(f) {
                    cambioHTML = '<input type="hidden" class="form-control pull-right " id="pago-pagos" name="monto['+ contadorDiv +']pagos['+contadorDiv+'][tipo_cambio_pago]" value="'+ f +'">'
                    fila = fila.concat(cambioHTML);
                    cuentaTipoCam++;
                });

                var html = '<tr id="removePago'+filas+'">';

                // Loop through array and add table cells
                for (var i=0; i < fila.length; i++) {
                    html += fila[i];
                    // Break into next row
                    var next = i;
                    html += "</tr>";
                }
                html += "</tr>";
                document.getElementById("forPagos").innerHTML = html;
                filas++;

            }
            contadorDiv++;
            var pagosIn = [{
                'pagosInput': pagos,
                'tipoCambioInput': tipoCambioPago
            }];
            var pagoHTML = null;
            var cambioHTML = null;
            var fila = [];
            pagosIn.forEach(logArrayElements);

            // recargo el filestyle
            filestyle();

            // Limpia formulario
            $("#pagos-form")[0].reset();

            $('.pagoAgregado').remove();
            $('.monto-ssss').css("display","none");
            $("#pagos").modal('hide');//oculto el modal
        }
    });
});






$(document).ready(function() {
    var contador = 1;
    $('#otropago').click(function() {
        var pago = '<div id="remove-pago'+contador+'"><div class="col-md-6 line pagos-inputs pagoAgregado"><div class="form-group"><label>Pago</label><input type="text" class="form-control monto" placeholder="Pago" id="pago_pagos-'+contador+'" name="pago_pagos" onkeypress="return filterFloat(event,this);" onkeyup="sumar();"></div></div>' +
            '<div class="col-md-5 line pagos-inputs"><div class="form-group pagoAgregado"><label>Tipo de cambio de pago</label><input type="text" class="form-control" placeholder="Tipo cambio de pago" id="tipo_cambio_pago_pagos-'+contador+'" name="tipo_cambio_pago_pagos"></div></div>' +
            '<div class="col-md-1 line pagos-inputs"><div class="form-group pagoAgregado"><label><br><br></label><button type="button" name="remove-p" id="' + contador + '" class="btn btn-danger remove-p" style="margin-top: 18px;"><i class="fa fa-trash  "></i></button></div></div></div>';
        $('.pago1').after(pago);
        contador++;
    });
    $(document).on('click', '.remove-p', function() {
        var button_id = $(this).attr("id");
        //cuando da click obtenemos el id del boton
        $('#remove-pago' + button_id).remove(); //borra la fila
        //limpia el para que vuelva a contar las filas de la tabla
        var nFilas = $(".pago1").length;
    });
});


// Guardado de Transito
$(document).ready(function() {
    $('#transito-form').validate({
        event: "blur",rules: {
            'metodo_transito' : "required",
            'guia_transito' : "required",
            'forwarder_transito' : "required",
            'fecha_embarque_transito' : "required",
            'fecha_tentativa_llegada_transito' : "required",
            'comercial_invoce_transito' : "required",
            'cbm_transito' : "required",
            'peso_transito' : "required"
        },
        messages: {
            'metodo_transito' : "El metodo es requerido",
            'guia_transito' : "La es Guia es requerida",
            'forwarder_transito' : "El es Forwarder es requerido",
            'fecha_embarque_transito' : "La es Fecha de embarque es requerida",
            'fecha_tentativa_llegada_transito' : "La Fecha tentativa de llegada es requerida",
            'comercial_invoce_transito' : "El Comercial invoce es requerido",
            'cajas_transito' : "Las Cajas son requeridas",
            'peso_transito' : "El es Paso es requerido"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            form.submit();
        }
    });
});

// Guardado de Pedimento
$(document).ready(function() {
    $('#pedimento-form').validate({
        event: "blur",rules: {
            'numero_pedimento' : "required",
            'aduana_pedimento' : "required",
            'agente_aduanal_pedimento' : "required",
            'tipo_cambio_pedimento_pedimento' : "required",
            'dta_pedimento' : "required",
            'cnt_pedimento' : "required",
            'igi_pedimento' : "required",
            'prv_pedimento' : "required",
            'iva_pedimento' : "required",
            'pedimento_digital' : "required"
        },
        messages: {
            'numero_pedimento' : "El Numero de pedimento es requerido",
            'aduana_pedimento' : "Aduana es requerido",
            'agente_aduanal_pedimento' : "El Agente Aduanal es requerido",
            'tipo_cambio_pedimento_pedimento' : "El Tipo de Cambio de Pedimento es requerido",
            'dta_pedimento' : "El DTA es requerido",
            'cnt_pedimento' : "El CNT es requerido",
            'igi_pedimento' : "El IGI es requerido",
            'prv_pedimento' : "El PRV es requerido",
            'iva_pedimento' : "El IVA es requerido",
            'pedimento_digital' : "El Pedimento Digital es requerido"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
                form.submit();
            }
    });
});
