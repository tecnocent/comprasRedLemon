// Solo numeros
function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
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
    $('#productosSelect').select2({
        dropdownParent: $('#myModal2'),
        tags: "true",
        placeholder: "Selecciona",
        allowClear: true
    });
});

// Script de boton file para seleccionar el arcivo a subir
$(function() {
    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
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
    document.getElementById('subtotal_producto').value = subtotal;
}

// Ajax trae descrupcion y id de productos
$('#productosSelect').on('select2:select', function (evt) {
    var producto_sku = $("#productosSelect").val();
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
            var producto_id = '<input type="hidden" class="form-control pull-right " id="producto_id" name="producto_id" value="'+resultados[0].id+'">'
            var producto_descripcion = '<input type="hidden" class="form-control pull-right " id="producto_descripcion" name="producto_descripcion" value="'+resultados[0].description+'">'

            $('.extras').after(producto_id);
            $('.extras').after(producto_descripcion);
        }
    });
});

// Llenado de tabla productos
$(document).ready(function() {
    var cont = 0;
    //obtenemos el valor de los input
    $('#adicionar').click(function() {
        var i = 1; //contador para asignar id al boton que borrara la fila
        var f = 1; //contador para asignar id al boton que borrara la fila

        var id_producto = '<input type="hidden" class="form-control pull-right " id="producto_id" name="productos['+ cont +'][producto_id]" value="'+ document.getElementById("producto_id").value +'">'
        var descripcion_producto = '<input type="hidden" class="form-control pull-right " id="producto_descripcion" name="productos['+ cont +'][producto_descripcion]" value="'+ document.getElementById("producto_descripcion").value +'">'
        var sku = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="sku" name="productos['+ cont +'][sku]" value="'+$("select[name='nombre_productoM'] option:selected").val()+'"></div>';
        var skuDis = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="skuDis" name="productos['+ cont +'][skuDis]" value="'+ $("select[name='nombre_productoM'] option:selected").val() +'"></div>';
        var nombre_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="nombre_productoDis" name="productos['+ cont +'][nombre_productoDis]" value="'+ $("select[name='nombre_productoM'] option:selected").text() +'"></div>';
        var nombre_productoDis = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" value="'+ $("select[name='nombre_productoM'] option:selected").text() +'"></div>';
        var icoterm_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="icoterm_producto" name="productos['+ cont +'][icoterm_producto]" value="'+ document.getElementById("icoterm_producto").value +'"></div>';
        var leadtime_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="leadtime_producto" name="productos['+ cont +'][leadtime_producto]" value="'+ document.getElementById("leadtime_producto").value +'"></div>';
        var costo_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="costo_producto" name="productos['+ cont +'][costo_producto]" value="'+ document.getElementById("costo_producto").value +'"></div>';
        var cantidad_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="cantidad_producto" name="productos['+ cont +'][cantidad_producto]" value="'+ document.getElementById("cantidad_producto").value +'"></div>';
        var total = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="subtotal_producto" name="productos['+ cont +'][subtotal_producto]" value="'+ document.getElementById("subtotal_producto").value +'"></div>';
        var logo = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="productos['+ cont +'][logo]" id="logo"/> <span></span></label></div>';
        var oem = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="productos['+ cont +'][oem]" id="oem"/> <span></span></label></div>';
        var instructivo = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="productos['+ cont +'][instructivo]", id="instructivo"/> <span></span></label></div>';
        var archivosFrbricante = '<div class="form-group col-sm-12"><label class="input-group-btn"><span class="btn btn-primary"><i class="fa fa-file"></i> Buscar&hellip; <input type="file" style="display: none;" name="productos['+ cont +'][archivosFabricante]" id="archivosFrbricante" class="file-input"></span></label></div>';
        var archivosDiseno = '<div class="form-group col-sm-12"><label class="input-group-btn"><span class="btn btn-primary"><i class="fa fa-file"></i> Buscar&hellip; <input type="file" style="display: none;" multiple name="productos['+ cont +'][archivosDiseno]" id="archivosDiseno"></span></label></div>';
        var tipo = '<div class="form-group col-sm-12"><select class="form-control select-tipo" name="productos['+ cont +'][tipo]"><option value="">Selecciona</option><option value="normal"> Normal</option><option value="urgente">Urgente</option></select></div>';
        var fechaRequerida = '<div class="form-group col-sm-12"><input type="date" class="form-control pull-right fecha-requerida" id="fechaRequerida" name="productos['+ cont +'][fechaRequerida]"></div>';

        var fila = '<tr id="row'+ i +'">' +
            '<td>' + sku +' '+ $("select[name='nombre_productoM'] option:selected").val() +' '+ id_producto +' '+descripcion_producto+'</td>' +
            '<td>' + nombre_producto +' '+ $("select[name='nombre_productoM'] option:selected").text() +'</td>' +
            '<td>' + cantidad_producto +' '+ document.getElementById("cantidad_producto").value +'</td>' +
            '<td>' + costo_producto +' '+ document.getElementById("costo_producto").value +'</td>' +
            '<td>' + total +' '+ document.getElementById("subtotal_producto").value +'</td>' +
            '<td>' + icoterm_producto +' '+ document.getElementById("icoterm_producto").value +'</td>' +
            '<td>' + leadtime_producto +' '+ document.getElementById("leadtime_producto").value +'</td>' +
            '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fa fa-trash  "></i></button></td>' +
            '</tr>'; //esto seria lo que contendria la fila
        var filaD = '<tr id="rowD' + f + '">' +
            '<td>' + skuDis +' '+ $("select[name='nombre_productoM'] option:selected").val() +'</td>' +
            '<td>' + nombre_productoDis +' '+ $("select[name='nombre_productoM'] option:selected").text() +'</td>' +
            '<td>' + document.getElementById("producto_descripcion").value + '</td>' +
            '<td>' + logo + '</td>' +
            '<td>' + oem + '</td>' +
            '<td>' + instructivo + '</td>' +
            '<td>' + archivosFrbricante + '</td>' +
            '<td>' + archivosDiseno + '</td>' +
            '<td>' + tipo + '</td>' +
            '<td>' + fechaRequerida + '</td>' +
            '</tr>'; //esto seria lo que contendria la fila



        $('.productos tr:first').after(fila);
        $('.diseno tr:first').after(filaD);

        cont++;
        console.log(cont);
        i++;
        f++;

        $("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
        var nFilas = $(".productos tr").length;
        $("#adicionados").append(nFilas - 1);
        //le resto 1 para no contar la fila del header
        $('#nombre_producto').val(null);
        document.getElementById("icoterm_producto").value ="1";
        document.getElementById("leadtime_producto").value ="";
        document.getElementById("costo_producto").value = "";
        document.getElementById("cantidad_producto").value = "";
        document.getElementById("subtotal_producto").value = "";

        $("#myModal2").modal('hide');//oculto el modal

    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        //cuando da click obtenemos el id del boton
        $('#row' + button_id).remove(); //borra la fila
        $('#rowD' + button_id).remove(); //borra la fila
        //limpia el para que vuelva a contar las filas de la tabla
        $("#adicionados").text("");
        var nFilas = $(".productos tr").length;
        $("#adicionados").append(nFilas - 1);
    });
});
// Llenado de Gasto origen
$(document).ready(function() {
    var countGastosO = 0;
    //obtenemos el valor de los input
    $('#adicionarGastoOrigen').click(function() {
        var tipo_gasto_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_gasto_origen" name="gastosOr['+ countGastosO +'][tipo_gasto_origen]" value="'+ document.getElementById("tipo_gasto_origen").value +'"></div>';
        var costo_gastos_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="costo_gastos_origen" name="gastosOr['+ countGastosO +'][costo_gastos_origen]" value="'+ document.getElementById("costo_gastos_origen").value +'"></div>';
        var nota_gastos_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="nota_gastos_origen" name="gastosOr['+ countGastosO +'][nota_gastos_origen]" value="'+ document.getElementById("nota_gastos_origen").value +'"></div>';
        var arcivo_gastos_origen = '<label class="input-group-btn"><span class="btn btn-primary"><i class="fa fa-file"></i> Buscar&hellip; <input type="file" style="display: none;" multiple name="gastosOr['+ countGastosO +'][comprobante_gastos_origen]"></span></label>';

        var i = 1; //contador para asignar id al boton que borrara la fila

        var fila = '<tr id="rowGatsoOrigen'+ i +'">' +
            '<td>'+ tipo_gasto_origen +' '+ document.getElementById("tipo_gasto_origen").value +'</td>' +
            '<td>'+ costo_gastos_origen +' '+ document.getElementById("costo_gastos_origen").value +'</td>' +
            '<td>'+ nota_gastos_origen +' '+ document.getElementById("nota_gastos_origen").value +'</td>' +
            '<td>'+ arcivo_gastos_origen +'</td>' +
            '<td><button type="button" name="remove" id="'+ i +'" class="btn btn-danger remove_gastos_origen"><i class="fa fa-trash  "></i></button></td>' +
            '</tr>'; //esto seria lo que contendria la fila

        i++;
        countGastosO++;
        $('.gastosOrigen tr:first').after(fila);

        var nFilas = $(".gastosOrigen tr").length;
        //le resto 1 para no contar la fila del header
        document.getElementById("tipo_gasto_origen").value ="a";
        document.getElementById("costo_gastos_origen").value = "";
        document.getElementById("nota_gastos_origen").value = "";

        $("#myModal3").modal('hide');//oculto el modal
    });

    $(document).on('click', '.remove_gastos_origen', function() {
        var button_id = $(this).attr("id");
        //cuando da click obtenemos el id del boton
        $('#rowGatsoOrigen' + button_id).remove(); //borra la fila
        //limpia el para que vuelva a contar las filas de la tabla
        var nFilas = $(".gastosOrigen tr").length;
    });
});

// Llenado de Gasto destino
$(document).ready(function() {
    var countGD = 0;
    //obtenemos el valor de los input
    $('#adicionarGastoDestino').click(function() {

        var tipo_gasto_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_gasto_gastos_destino" name="gastosDe['+ countGD +'][tipo_gasto_gastos_destino]" value="'+ document.getElementById("tipo_gasto_gastos_destino").value +'"></div>';
        var costo_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="costo_gastos_destino" name="gastosDe['+ countGD +'][costo_gastos_destino]" value="'+ document.getElementById("costo_gastos_destino").value +'"></div>';
        var moneda_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="moneda_gastos_destino" name="gastosDe['+ countGD +'][moneda_gastos_destino]" value="'+ document.getElementById("moneda_gastos_destino").value +'"></div>';
        var nota_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="nota_gastos_destino" name="gastosDe['+ countGD +'][nota_gastos_destino]" value="'+ document.getElementById("nota_gastos_destino").value +'"></div>';
        var comporbante_gastos_destino = '<label class="input-group-btn"><span class="btn btn-primary"><i class="fa fa-file"></i> Buscar&hellip; <input type="file" style="display: none;" name="gastosDe['+ countGD +'][comporbante_gastos_destino]" multiple></span></label>';

        var i = 1; //contador para asignar id al boton que borrara la fila

        var fila = '<tr id="rowGastosDestino' + i + '">' +
            '<td>' + tipo_gasto_gastos_destino +' '+ document.getElementById("tipo_gasto_gastos_destino").value +'</td>' +
            '<td>' + costo_gastos_destino +' '+ document.getElementById("costo_gastos_destino").value +'</td>' +
            '<td>' + moneda_gastos_destino +' '+ document.getElementById("moneda_gastos_destino").value +'</td>' +
            '<td>' + nota_gastos_destino +' '+ document.getElementById("nota_gastos_destino").value +'</td>' +
            '<td>' + comporbante_gastos_destino + '</td>' +
            '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger remove_gastos_destino"><i class="fa fa-trash  "></i></button></td>' +
            '</tr>'; //esto seria lo que contendria la fila

        i++;

        $('.gastosDestino tr:first').after(fila);
        countGD++;

        var nFilas = $(".gastosDestino tr").length;
        //le resto 1 para no contar la fila del header
        document.getElementById("tipo_gasto_gastos_destino").value ="1";
        document.getElementById("costo_gastos_destino").value = "";
        document.getElementById("moneda_gastos_destino").value ="a";
        document.getElementById("nota_gastos_destino").value = "";

        $("#myModal4").modal('hide');//oculto el modal
    });

    $(document).on('click', '.remove_gastos_destino', function() {
        var button_id = $(this).attr("id");
        //cuando da click obtenemos el id del boton
        $('#rowGastosDestino' + button_id).remove(); //borra la fila
        //limpia el para que vuelva a contar las filas de la tabla
        var nFilas = $(".gastosDestino tr").length;
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
            'tipo_cambio_monto_pagos': 'Tipo de cambio es requerido',
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            document.getElementById("table-monto-default").style.height = "0px";
            document.getElementById("table-monto-default").style.lineHeight = "0px";
            document.getElementById("table-monto-default").style.visibility = "hidden";
            document.getElementById("table-monto-default").style.marginTop = "-14px";

            var monto_pagos = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="monto_pagos" name="montos['+ contadorDiv +'][monto_pagos]" value="'+ document.getElementById("monto_pagos").value +'"></div>';
            var buscaComprobante = '<input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" id="comprobante_monto" name="montos['+ contadorDiv +'][comprobanteMonto]" >';

            var monto = '<div class="row" id="remove-div-monto'+contadorDiv+'" class="remove-div-monto">\n' +
                '           <div class="panel panel-default">\n' +
                '               <div class="panel-heading">\n' +
                '                   <div class="row">\n' +
                '                       <div class="col-md-6 line">\n' +
                '                           <div class="form-group">\n' +
                '                               <h4>Monto USD</h4>\n' +
                '                               <h4>$ '+ monto_pagos +' '+ document.getElementById("monto_pagos").value +'</h4>\n' +
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
                '                               <button type="button" name="remove-monto" id="'+ contadorDiv +'" class="btn btn-danger remove-monto"><i class="fa fa-trash  "></i></button>\n' +
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
            contadorDiv++;

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
                    pagoHTML = '<td><input type="text" class="form-control pull-right " id="pago-pagos" name="pagos['+ cuentaPago +'][pago]" value="'+ e +'"></td>' +
                        '<td><input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" id="comprobante_pago['+cuentaPago+']" name="pagos['+ cuentaPago +'][comprobantePago]" ></td>';

                    fila = fila.concat(pagoHTML);
                    cuentaPago++;
                });
                var cuentaTipoCam = 0;
                element.tipoCambioInput.forEach(function(f) {
                    cambioHTML = '<input type="hidden" class="form-control pull-right " id="pago-pagos" name="pagos['+ cuentaTipoCam +'][tipo_cambio_pago]" value="'+ f +'">'
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


            var pagosIn = [{
                'pagosInput': pagos,
                'tipoCambioInput': tipoCambioPago
            }];
            var pagoHTML = null;
            var cambioHTML = null;
            var fila = [];
            pagosIn.forEach(logArrayElements);

            // recargo el filestyle
            $.ajax({
                url: '/dist/js/filestyle.js',
                dataType: 'script'
            });

            $("#pagos").modal('hide');//oculto el modal
        }
    });
});


$(document).ready(function() {
    var contador = 1;
    $('#otropago').click(function() {
        var pago = '<div id="remove-pago'+contador+'"><div class="col-md-6 line pagos-inputs"><div class="form-group"><label>Pago</label><input type="text" class="form-control" placeholder="Pago" id="pago_pagos-'+contador+'" name="pago_pagos" onkeypress="return filterFloat(event,this);"></div></div>' +
            '<div class="col-md-5 line pagos-inputs"><div class="form-group"><label>Tipo de cambio de pago</label><input type="text" class="form-control" placeholder="Tipo cambio de pago" id="tipo_cambio_pago_pagos-'+contador+'" name="tipo_cambio_pago_pagos"></div></div>' +
            '<div class="col-md-1 line pagos-inputs"><div class="form-group"><label><br><br></label><button type="button" name="remove-p" id="' + contador + '" class="btn btn-danger remove-p" style="margin-top: 18px;"><i class="fa fa-trash  "></i></button></div></div></div>';
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


