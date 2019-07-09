//Status de la orden
$("#borrador").click(function () {
    $("#status").val('borrador');
});
$("#po_creada").click(function () {
    $("#status").val('po creada');
});

// Llenado de select proveedores
$(document).ready(function() {
    $.ajax({
        url: "{{route('proveedores.index')}}",
        dataType: "json",
        success: function(data){
            $("#proveedor").append('<option value="">Selecciona</option>');
            $.each(data,function(key, registro) {
                $("#proveedor").append('<option value='+registro.id+'>'+registro.name+'</option>');
            });
        },
        error: function(data) {
            alert('error');
        }
    });

});

// Guardado de nuevo proveedor
$(document).ready(function(){
    $("#proveedor-form").validate({
        event: "blur",rules: {
            'nombreProveedor': "required",
            'correoProveedor': "required email",
            'tlefonoProveedor': "required",
            'nombreContactoProveedor': "required"
        },
        messages: {
            'nombreProveedor': "El nombre es requerido",
            'correoProveedor': "Indica una direcci&oacute;n de e-mail v&aacute;lida",
            'tlefonoProveedor': "El telefono es reuerido",
            'nombreContactoProveedor': "El nombre de contacto es requerido"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            $.ajax({
                type: "POST",
                url: '{{route("proveedor.save")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    nombreProveedor: $('#nombreProveedor').val(),
                    nombreContactoProveedor: $('#nombreContactoProveedor').val(),
                    taxProveedor: $('#taxProveedor').val(),
                    direccionProveedor: $('#direccionProveedor').val(),
                    paisProveedor: $('#paisProveedor').val(),
                    tlefonoProveedor: $('#tlefonoProveedor').val(),
                    correoProveedor: $('#correoProveedor').val(),
                },
                success: function(msg){
                    document.getElementById("nombreProveedor").value="";
                    document.getElementById("nombreContactoProveedor").value="";
                    document.getElementById("taxProveedor").value="";
                    document.getElementById("direccionProveedor").value="";
                    document.getElementById("paisProveedor").value="";
                    document.getElementById("tlefonoProveedor").value="";
                    document.getElementById("correoProveedor").value="";
                    $("#nuevo-proveedor-modal").modal('hide');
                    $('#proveedor option').remove();
                    $.ajax({
                        url: "{{route('proveedores.index')}}",
                        dataType: "json",
                        success: function(data){
                            $("#proveedor").append('<option value="">Selecciona</option>');
                            $.each(data,function(key, registro) {
                                $("#proveedor").append('<option value='+registro.id+'>'+registro.name+'</option>');
                            });
                        },
                        error: function(data) {
                            alert('error');
                        }
                    });
                }
            });
        }
    });
});

// Select tipo de compra
$(document).ready(function() {
    $.ajax({
        url: "{{route('tipo_compra.index')}}",
        dataType: "json",
        type:"GET",
        success: function(data){
            $("#tipoCompraSelect").append('<option value="">Selecciona</option>');
            $.each(data,function(key, registro) {
                $("#tipoCompraSelect").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
            });
        },
        error: function(data) {
            alert('error');
        }
    });
});

// Guardado de tipo de compra
$(document).ready(function(){
    $("#tipo-compra-form").validate({
        event: "blur",rules: {
            'tipoCompraNombre': "required",
        },
        messages: {
            'tipoCompraNombre': "El tipo de compra es requerido",
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            $.ajax({
                type: "POST",
                url: '{{route("tipo_compra.save")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    tipoCompraNombre: $('#tipoCompraNombre').val(),
                },
                success: function(msg){
                    document.getElementById("tipoCompraNombre").value="";
                    $("#nuevo-tipo-compra").modal('hide');
                    $('#tipoCompraSelect option').remove();
                    $.ajax({
                        url: "{{route('tipo_compra.index')}}",
                        dataType: "json",
                        type:"GET",
                        success: function(data){
                            $("#tipoCompraSelect").append('<option value="">Selecciona</option>');
                            $.each(data,function(key, registro) {
                                $("#tipoCompraSelect").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
                            });
                        },
                        error: function(data) {
                            alert('error');
                        }
                    });
                }
            });
        }
    });
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
    var countPago = 0;
    //obtenemos el valor de los input
    $('#pagos-form').validate({
        event: "blur",rules: {
            'monto_pagos': "required",
            'tipo_cambio_monto_pagos': 'required',
            'bfcvu_pagos': 'required',
            'pago_pagos-0': 'required',
            'tipo_cambio_pago_pagos-0': 'required'
        },
        messages: {
            'monto_pagos': "El monto es requerido"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
        var monto_pagos = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="monto_pago_table" name="pagos['+ countPago +'][monto_pago]" value="'+ document.getElementById("monto_pagos").value +'"></div>';
        var comprobante_monto_pago = '<div class="form-group col-sm-12"><input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="pagos['+ countPago +'][comprobante_monto_pago]"></div>';
        var tipo_cambio_monto_pagos = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_cambio_monto_pagos_table" name="pagos['+ countPago +'][tipo_cambio_monto_pagos]" value="'+ document.getElementById("tipo_cambio_monto_pagos").value +'"></div>';
        var bfcvu_pagos = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="bfcvu_pago_table" name="pagos['+ countPago +'][bfcvu_pago]" value="'+ document.getElementById("bfcvu_pagos").value +'"></div>';
        var pago_pagos = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="pago_pagos_table" name="pagos['+ countPago +'][pago_pagos]" value="'+ document.getElementById("pago_pagos-0").value +'"></div>';
        var comprobante_pago_pagos = '<div class="form-group col-sm-12"><input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="comprobante_pago_pagos" name="pagos['+ countPago +'][comprobante_pago_pagos]"></div>';
        var tipo_cambio_pago_pagos = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_cambio_pago_pagos_table" name="pagos['+ countPago +'][tipo_cambio_pago_pagos]" value="'+ document.getElementById("tipo_cambio_pago_pagos-0").value +'"></div>';

        var i = 1; //contador para asignar id al boton que borrara la fila

        var fila = '<tr id="pagos' + i + '">' +
            '<td>' + monto_pagos +' '+ document.getElementById("monto_pagos").value +'</td>' +
            '<td>' + comprobante_monto_pago +'</td>' +
            '<td>' + pago_pagos +' '+ document.getElementById("pago_pagos-0").value +'</td>' +
            '<td>' + comprobante_pago_pagos +'</td>' +
            '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger remove_pagos"><i class="fa fa-trash  "></i></button></td>' +
            '</tr>'; //esto seria lo que contendria la fila

        i++;

        // recargo el filestyle
        $.ajax({
            url: '/dist/js/filestyle.js',
            dataType: 'script'
        });

        $('.pagos tr:first').after(fila);
        countPago++;

        var nFilas = $(".pagos tr").length;
        //le resto 1 para no contar la fila del header
        document.getElementById("monto_pagos").value ="";
        document.getElementById("tipo_cambio_monto_pagos").value ="";
        document.getElementById("bfcvu_pagos").value ="";
        document.getElementById("pago_pagos-0").value ="";
        document.getElementById("tipo_cambio_pago_pagos-0").value ="";

        $("#pagos").modal('hide');//oculto el modal
        }
    });

    $(document).on('click', '.remove_pagos', function() {
        var button_id = $(this).attr("id");
        //cuando da click obtenemos el id del boton
        $('#pagos' + button_id).remove(); //borra la fila
        //limpia el para que vuelva a contar las filas de la tabla
        var nFilas = $(".pagos tr").length;
    });
});


$(document).ready(function() {
    var contador = 1;
    $('#otropago').click(function() {
        var pago = '<div id="remove-pago'+contador+'"><div class="col-md-6 line pagos-inputs"><div class="form-group"><label>Pago</label><input type="text" class="form-control" placeholder="Pago" id="pago_pagos-'+contador+'" name="pago_pagos-'+contador+'" onkeypress="return filterFloat(event,this);"></div></div>' +
            '<div class="col-md-5 line pagos-inputs"><div class="form-group"><label>Tipo de cambio de pago</label><input type="text" class="form-control" placeholder="Tipo cambio de pago" id="tipo_cambio_pago_pagos-'+contador+'" name="tipo_cambio_pago_pagos-'+contador+'"></div></div>' +
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
