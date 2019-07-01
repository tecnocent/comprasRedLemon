
// Funcion para select2 dentro de modal
$(document).ready(function() {
    $('#select').select2({
        dropdownParent: $('#myModal2')
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

// Llenado de tabla productos
$(document).ready(function() {
    //obtenemos el valor de los input
    $('#adicionar').click(function() {
        var sku = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="sku" name="sku[]" value="'+ $("select[name='nombre_producto'] option:selected").val() +'"></div>';
        var skuDis = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="skuDis" name="skuDis[]" value="'+ $("select[name='nombre_producto'] option:selected").val() +'"></div>';
        var nombre_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="nombre_productoDis" name="nombre_productoDis[]" value="'+ $("select[name='nombre_producto'] option:selected").text() +'"></div>';
        var nombre_productoDis = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" value="'+ $("select[name='nombre_producto'] option:selected").text() +'"></div>';
        var icoterm_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="icoterm_producto" name="icoterm_producto[]" value="'+ document.getElementById("icoterm_producto").value +'"></div>';
        var leadtime_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="leadtime_producto" name="leadtime_producto[]" value="'+ document.getElementById("leadtime_producto").value +'"></div>';
        var costo_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="costo_producto" name="costo_producto[]" value="'+ document.getElementById("costo_producto").value +'"></div>';
        var cantidad_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="cantidad_producto" name="cantidad_producto[]" value="'+ document.getElementById("cantidad_producto").value +'"></div>';
        var total = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="subtotal_producto" name="subtotal_producto[]" value="'+ document.getElementById("subtotal_producto").value +'"></div>';
        var descripcion = "resolver";
        var logo = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="logo[]" id="logo"/> <span></span></label></div>';
        var oem = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="oem[]" id="oem"/> <span></span></label></div>';
        var instructivo = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="instructivo[]", id="instructivo"/> <span></span></label></div>';
        var archivosFrbricante = '<div class="form-group col-sm-12"><label class="input-group-btn"><span class="btn btn-primary"><i class="fa fa-file"></i> Buscar&hellip; <input type="file" style="display: none;" multiple name="archivosFrbricante[]" id="archivosFrbricante"></span></label></div>';
        var archivosDiseno = '<div class="form-group col-sm-12"><label class="input-group-btn"><span class="btn btn-primary"><i class="fa fa-file"></i> Buscar&hellip; <input type="file" style="display: none;" multiple name="archivosDiseno[]" id="archivosDiseno"></span></label></div>';
        var tipo = '<div class="form-group col-sm-12"><select class="form-control" name="tipo[]"><option>Selecciona</option><option value="normal"> Normal</option><option value="urgente">Urgente</option></select></div>';
        var fechaRequerida = '<div class="form-group col-sm-12"><input type="date" class="form-control pull-right datepicker" id="fechaRequerida" name="fechaRequerida[]"></div>';

        var i = 1; //contador para asignar id al boton que borrara la fila
        var f = 1; //contador para asignar id al boton que borrara la fila

        var fila = '<tr id="row'+ i +'">' +
            '<td>' + sku +' '+ $("select[name='nombre_producto'] option:selected").val() +'</td>' +
            '<td>' + nombre_producto +' '+ $("select[name='nombre_producto'] option:selected").text() +'</td>' +
            '<td>' + cantidad_producto +' '+ document.getElementById("cantidad_producto").value +'</td>' +
            '<td>' + costo_producto +' '+ document.getElementById("costo_producto").value +'</td>' +
            '<td>' + total +' '+ document.getElementById("subtotal_producto").value +'</td>' +
            '<td>' + icoterm_producto +' '+ document.getElementById("icoterm_producto").value +'</td>' +
            '<td>' + leadtime_producto +' '+ document.getElementById("leadtime_producto").value +'</td>' +
            '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fa fa-trash  "></i></button></td>' +
            '</tr>'; //esto seria lo que contendria la fila
        var filaD = '<tr id="rowD' + f + '">' +
            '<td>' + skuDis +' '+ $("select[name='nombre_producto'] option:selected").val() +'</td>' +
            '<td>' + nombre_productoDis +' '+ $("select[name='nombre_producto'] option:selected").text() +'</td>' +
            '<td>' + descripcion + '</td>' +
            '<td>' + logo + '</td>' +
            '<td>' + oem + '</td>' +
            '<td>' + instructivo + '</td>' +
            '<td>' + archivosFrbricante + '</td>' +
            '<td>' + archivosDiseno + '</td>' +
            '<td>' + tipo + '</td>' +
            '<td>' + fechaRequerida + '</td>' +
            '</tr>'; //esto seria lo que contendria la fila

        i++;
        f++;

        $('.productos tr:first').after(fila);
        $('.diseno tr:first').after(filaD);

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
    //obtenemos el valor de los input
    $('#adicionarGastoOrigen').click(function() {
        var tipo_gasto_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_gasto_origen" name="tipo_gasto_origen[]" value="'+ document.getElementById("tipo_gasto_origen").value +'"></div>';
        var costo_gastos_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="costo_gastos_origen" name="costo_gastos_origen[]" value="'+ document.getElementById("costo_gastos_origen").value +'"></div>';
        var nota_gastos_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="nota_gastos_origen" name="nota_gastos_origen[]" value="'+ document.getElementById("nota_gastos_origen").value +'"></div>';
        var arcivo_gastos_origen = '<label class="input-group-btn"><span class="btn btn-primary"><i class="fa fa-file"></i> Buscar&hellip; <input type="file" style="display: none;" multiple></span></label>';

        var i = 1; //contador para asignar id al boton que borrara la fila

        var fila = '<tr id="rowGatsoOrigen'+ i +'">' +
            '<td>'+ tipo_gasto_origen +' '+ document.getElementById("tipo_gasto_origen").value +'</td>' +
            '<td>'+ costo_gastos_origen +' '+ document.getElementById("costo_gastos_origen").value +'</td>' +
            '<td>'+ nota_gastos_origen +' '+ document.getElementById("nota_gastos_origen").value +'</td>' +
            '<td>'+ arcivo_gastos_origen +'</td>' +
            '<td><button type="button" name="remove" id="'+ i +'" class="btn btn-danger remove_gastos_origen"><i class="fa fa-trash  "></i></button></td>' +
            '</tr>'; //esto seria lo que contendria la fila

        i++;

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
    //obtenemos el valor de los input
    $('#adicionarGastoDestino').click(function() {

        var tipo_gasto_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_gasto_gastos_destino" name="tipo_gasto_gastos_destino[]" value="'+ document.getElementById("tipo_gasto_gastos_destino").value +'"></div>';
        var costo_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="costo_gastos_destino" name="costo_gastos_destino[]" value="'+ document.getElementById("costo_gastos_destino").value +'"></div>';
        var moneda_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="moneda_gastos_destino" name="moneda_gastos_destino[]" value="'+ document.getElementById("moneda_gastos_destino").value +'"></div>';
        var nota_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="nota_gastos_destino" name="nota_gastos_destino[]" value="'+ document.getElementById("nota_gastos_destino").value +'"></div>';
        var comporbante_gastos_destino = '<label class="input-group-btn"><span class="btn btn-primary"><i class="fa fa-file"></i> Buscar&hellip; <input type="file" style="display: none;" multiple></span></label>';

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
