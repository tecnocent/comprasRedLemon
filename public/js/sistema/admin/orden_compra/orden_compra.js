// Muestra imagen seleccionada
$("#input-preproduccion-crea").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#foto-preproduccion-seleccionada-crea').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
$("#input-produccion-crea").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#foto-produccion-seleccionada-crea').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
$("#input-oem_uno-crea").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#foto-oem_uno-seleccionada-crea').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
$("#input-oem_dos-crea").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#foto-oem_dos-seleccionada-crea').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
$("#input-oem_tres-crea").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#foto-oem_tres-seleccionada-crea').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
$("#input-empaquetado-crea").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#foto-empaquetado-seleccionada-crea').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});

// Solo numeros
function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
}

function filestyle() {
    // recargo el filestyle
    $.ajax({
        url: 'http://198.199.117.190/comprasRedLemon/public/dist/js/filestyle.js',
        dataType: 'script'
    });

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

// Valuda valor unico para #OC
function checkUniq(name, valor) {
    $.ajax({
        type: 'GET',
        url: "http://198.199.117.190/comprasRedLemon/public/api/ordenes",
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
            console.log(data);
            var error = '<label for="identificador" generated="true" class="error">EL #OC esta en uso</label>';
            $('#id_orden').after(error);
        }
    });
}
// Ajax trae descrupcion y id de productos
$('#productosSelect').on('select2:select', function (evt) {
    var producto_sku = $("#productosSelect").val();
    $.ajax({
        type: 'GET',
        url: "http://198.199.117.190/comprasRedLemon/public/api/productos",
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
            console.log(resultados[0].id);
            document.getElementById('producto_id').value = resultados[0].id;
            document.getElementById('producto_descripcion').value = resultados[0].id;
        }
    });
});

$('#productosSelect').change(function () {
    var selector = $('#product_variant_id');
    $('#product_variant_id option').remove();
    $('#new_variant_product_id').val($(this).val());
    getVariants($(this).val(), selector)

});

function getVariants(id, selector, defaultValue){
    if(id){
        $.ajax({
            type: 'GET',
            url: '../api/productos/' + id + '/variantes',
            success: function (data) {
                selector.append('<option value="">Selecciona</option>');
                $.each(data, function (key, data) {
                    selector.append('<option value=' + data.id + '>' + data.variant + '</option>');
                });

                if(defaultValue){
                    selector.val(defaultValue);
                    selector.select2().trigger('change');
                }
            }
        });
    }
}

// Llenado de tabla productos
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
            var id_producto = '<input type="hidden" class="form-control pull-right " name="productos['+ cont +'][producto_id]" value="'+ document.getElementById('producto_id').value +'">',
                descripcion_producto = '<input type="hidden" class="form-control pull-right" name="productos['+ cont +'][producto_descripcion]" value="'+ document.getElementById("producto_descripcion").value +'">',
                sku = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="sku" name="productos['+ cont +'][sku]" value="'+$("select[name='nombre_productoM'] option:selected").val()+'"></div>',
                skuDis = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="skuDis" name="productos['+ cont +'][skuDis]" value="'+ $("select[name='nombre_productoM'] option:selected").val() +'"></div>',
                nombre_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="nombre_productoDis" name="productos['+ cont +'][nombre_productoDis]" value="'+ $("select[name='nombre_productoM'] option:selected").text() +'"></div>',
                nombre_productoDis = '<div><input type="hidden" class="form-control pull-right" value="'+ $("select[name='nombre_productoM'] option:selected").text() +'"></div>',
                variante_producto = '<div><input type="hidden" class="form-control pull-right" id="variante_producto" name="productos['+ cont +'][variante_producto]" value="'+ $("select[name='product_variant_id'] option:selected").val() +'"></div>',
                icoterm_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="icoterm_producto" name="productos['+ cont +'][icoterm_producto]" value="'+ document.getElementById("icoterm_producto").value +'"></div>',
                leadtime_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="leadtime_producto" name="productos['+ cont +'][leadtime_producto]" value="'+ document.getElementById("leadtime_producto").value +'"></div>',
                costo_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="costo_producto" name="productos['+ cont +'][costo_producto]" value="'+ document.getElementById("costo_producto").value +'"></div>',
                cantidad_producto = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="cantidad_producto" name="productos['+ cont +'][cantidad_producto]" value="'+ document.getElementById("cantidad_producto").value +'"></div>',
                total = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right" id="subtotal_producto" name="productos['+ cont +'][subtotal_producto]" value="'+ document.getElementById("subtotal_producto").value +'"></div>',
                logo = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="productos['+ cont +'][logo]" id="logo"/> <span></span></label></div>',
                oem = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="productos['+ cont +'][oem]" id="oem"/> <span></span></label></div>',
                instructivo = '<div class="form-group col-sm-12"><label class="checkbox-inline checbox-switch switch-primary"> <input type="checkbox" name="productos['+ cont +'][instructivo]", id="instructivo"/> <span></span></label></div>',
                archivosFrbricante = '<div class="form-group col-sm-12"><input type="file" class="filestyle" data-badge="true" data-input="false" data-text="Buscar..." data-btnClass="btn-primary" name="productos['+ cont +'][archivosFabricante]" id="archivosFrbricante" class="file-input"></div>',
                archivosDiseno = '<div class="form-group col-sm-12"><input type="file" class="filestyle" data-badge="true" data-input="false" data-dragdrop="true" data-text="Buscar..." data-btnClass="btn-primary" name="productos['+ cont +'][archivosDiseno]" id="archivosDiseno"></div>',
                tipo = '<div class="form-group col-sm-12"><select class="form-control select-tipo" name="productos['+ cont +'][tipo]"><option value="">Selecciona</option><option value="normal"> Normal</option><option value="urgente">Urgente</option></select></div>',
                fechaRequerida = '<div class="form-group col-sm-12"><input type="date" class="form-control pull-right fecha-requerida" id="fechaRequerida" name="productos['+ cont +'][fechaRequerida]"></div>',
                optionProducto = '<option id="opcionP'+ i +'" value="'+ document.getElementById('producto_id').value +'">'+ $("select[name='nombre_productoM'] option:selected").text() +'</option>',
                optionProductoSeg = '<option id="opcionS'+ i +'" value="'+ document.getElementById('producto_id').value +'">'+ $("select[name='nombre_productoM'] option:selected").text() +'</option>',
                optionProductoCla = '<option id="opcionC'+ i +'" value="'+ document.getElementById('producto_id').value +'">'+ $("select[name='nombre_productoM'] option:selected").text() +'</option>',
                optionProductoDis = '<option id="opcionD'+ i +'" value="'+ document.getElementById('producto_id').value +'">'+ $("select[name='nombre_productoM'] option:selected").text() +'</option>';

            var fila = '<tr id="row'+ i +'">' +
                '<td>' + sku +' '+ $("select[name='nombre_productoM'] option:selected").val() +' '+ id_producto +' '+descripcion_producto+'</td>' +
                '<td>' + nombre_producto +' ' + variante_producto +' '+ $("select[name='nombre_productoM'] option:selected").text() +'-'+ $("select[name='product_variant_id'] option:selected").text() +'</td>' +
                '<td>' + cantidad_producto +' '+ document.getElementById("cantidad_producto").value +'</td>' +
                '<td>' + costo_producto +' '+ document.getElementById("costo_producto").value +'</td>' +
                '<td>' + total +' '+ document.getElementById("subtotal_producto").value +'</td>' +
                '<td>' + icoterm_producto +' '+ document.getElementById("icoterm_producto").value +'</td>' +
                '<td>' + leadtime_producto +' '+ document.getElementById("leadtime_producto").value +'</td>' +
                '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fa fa-trash  "></i></button></td>' +
                '</tr>'; //esto seria lo que contendria la fila

            $('.productos tr:first').after(fila);
            //Select producto en caracteristica de producto modal
            $('#option_producto_caracteristica').after(optionProducto);
            $('#option_producto_seguimiento_id').after(optionProductoSeg);
            $('#option_producto_clasificacion').after(optionProductoCla);
            $('#option_producto_diseno').after(optionProductoDis);

            $("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
            var nFilas = $(".productos tr").length;
            $("#adicionados").append(nFilas - 1);

            // Limpia formulario
            $("#productos-form")[0].reset();
            var subtotal = '<input type="text" class="form-control" id="subtotal_producto" name="subtotal_productoM" placeholder="Subtotal" disabled>';
            $('#subtotal_producto').remove();
            $('#subtotalProducto').after(subtotal);
            $('#producto_id').remove();
            var prod = '<input type="hidden" class="form-control pull-right " id="producto_id">';
            $('#o').after(prod);
            cont++;
            i++;
            f++;
            // recargo el filestyle
            filestyle();

            $("#myModal2").modal('hide');//oculto el modal

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                //cuando da click obtenemos el id del boton
                $('#row' + button_id).remove(); //borra la fila
                $('#opcionP'+ button_id).remove(); // borra option en modal caracteristica
                $('#opcionS'+ button_id).remove(); // borra option en modal seguimiento
                $('#opcionC'+ button_id).remove(); // borra option en modal clasificacion
                $('#opcionD'+ button_id).remove(); // borra option en modal clasificacion
                //limpia el para que vuelva a contar las filas de la tabla
                $("#adicionados").text("");
                var nFilas = $(".productos tr").length;
                $("#adicionados").append(nFilas - 1);
            });
        }
    });
});



// Llenado de Gasto origen
$(document).ready(function() {
    var countGastosO = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
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
            var file = $('#comprobante_gastos_origen'),
                arcivo_gastos_origen = file.clone();
            var tipo_gasto_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_gasto_origen" name="gastosOr['+ countGastosO +'][tipo_gasto_origen]" value="'+ document.getElementById("tipo_gasto_origen").value +'"></div>',
                costo_gastos_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="costo_gastos_origen" name="gastosOr['+ countGastosO +'][costo_gastos_origen]" value="'+ document.getElementById("costo_gastos_origen").value +'"></div>',
                div = '<div class="form-group col-sm-12" id="file-gastos"></div>',
                nota_gastos_origen = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="nota_gastos_origen" name="gastosOr['+ countGastosO +'][nota_gastos_origen]" value="'+ document.getElementById("nota_gastos_origen").value +'"></div>';
                //arcivo_gastos_origen = '<div class="form-group col-sm-12"><input type="file" class="filestyle" name="gastosOr['+ countGastosO +'][comprobante_gastos_origen]"></div>';

            var fila = '<tr id="rowGatsoOrigen'+ i +'">' +
                '<td>'+ tipo_gasto_origen +' '+ $("select[name='tipo_gasto_origenM'] option:selected").text() +'</td>' +
                '<td>'+ costo_gastos_origen +' '+ document.getElementById("costo_gastos_origen").value +'</td>' +
                '<td>'+ nota_gastos_origen +' '+ document.getElementById("nota_gastos_origen").value +'</td>' +
                '<td>'+ div +'</td>' +
                '<td><button type="button" name="remove" id="'+ i +'" class="btn btn-danger remove_gastos_origen"><i class="fa fa-trash  "></i></button></td>' +
                '</tr>'; //esto seria lo que contendria la fila

            i++;

            $('.gastosOrigen tr:first').after(fila);


            arcivo_gastos_origen.attr('name', 'gastosOr['+ countGastosO +'][comprobante_gastos_origen]');
            arcivo_gastos_origen.attr('id', 'comprobante_gastos_origen['+ countGastosO +']');
            var filename = arcivo_gastos_origen.val();
            $('#file-gastos').after(filename.split('\\').pop());
            arcivo_gastos_origen.removeClass('filestyle');
            $('#file-gastos').after(arcivo_gastos_origen);
            $('#comprobante_gastos_origen').removeClass('filestyle');
            countGastosO++;


            var nFilas = $(".gastosOrigen tr").length;

            // Limpia formulario
            $("#gastos-origen-form")[0].reset();

            // Recargo el filestyle
            filestyle();

            $("#myModal3").modal('hide');//oculto el modal
            $(document).on('click', '.remove_gastos_origen', function() {
                var button_id = $(this).attr("id");
                //cuando da click obtenemos el id del boton
                $('#rowGatsoOrigen' + button_id).remove(); //borra la fila
                //limpia el para que vuelva a contar las filas de la tabla
                var nFilas = $(".gastosOrigen tr").length;
            });
        }
    });
});

// Llenado de caracteristica producto
$(document).ready(function() {
    var countCaracteristicas = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
    $('#caracteristica-form').validate({
        event: "blur",rules: {
            'producto_caracteristica_id' : "required",
            'caracteristica_especificacion_producto' : "required",
            'caracteristica_especificaion_electrica' : "required",
            'caracteristica_link_amazon' : "url",
            'caracteristica_link_alibaba' : "url"
        },
        messages: {
            'producto_caracteristica_id' : "El producto es requerido",
            'caracteristica_especificacion_producto' : "La especificacion es requerida",
            'caracteristica_especificaion_electrica' : "La especificacion electrica es requerida",
            'caracteristica_link_amazon' : "Debe ser una URL",
            'caracteristica_link_alibaba' : "Debe ser una URL"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){

            var id_producto = '<input type="hidden" class="form-control pull-right " name="caracteristicas['+ countCaracteristicas +'][producto_id]" value="'+ document.getElementById('producto_caracteristica_id').value +'">',
                nombre_producto = '<input type="hidden" class="form-control pull-right" name="caracteristicas['+ countCaracteristicas +'][producto_nombre]" value="'+  $("select[name='producto_caracteristica_id'] option:selected").text() +'">',
                especificacion_producto = '<input type="hidden" class="form-control pull-right" name="caracteristicas['+ countCaracteristicas +'][especificacion_producto]" value="'+  document.getElementById('caracteristica_especificacion_producto').value +'">',
                especificacion_electrica = '<input type="hidden" class="form-control pull-right" name="caracteristicas['+ countCaracteristicas +'][especificacion_electrica]" value="'+  document.getElementById('caracteristica_especificaion_electrica').value +'">',
                link_amazon = '<input type="hidden" class="form-control pull-right" name="caracteristicas['+ countCaracteristicas +'][link_amazon]" value="'+  document.getElementById('caracteristica_link_amazon').value +'">',
                link_alibaba = '<input type="hidden" class="form-control pull-right" name="caracteristicas['+ countCaracteristicas +'][link_alibaba]" value="'+  document.getElementById('caracteristica_link_alibaba').value +'">';
            var link_a_amazon = ($('#caracteristica_link_amazon').length) ? '<a class="btn btn-link" href="'+ document.getElementById('caracteristica_link_amazon').value +'" target="_blank"> Link Amazon</a>' : "No hay link";
            var link_a_alibaba = ($('#caracteristica_link_alibaba').length) ? '<a class="btn btn-link" href="'+ document.getElementById('caracteristica_link_alibaba').value +'" target="_blank"> Link Alibaba</a>' : "No hay link";

            var fila = '<tr id="rowCaracteristica'+ i +'">' +
                '<td>'+ id_producto +' '+ $("select[name='producto_caracteristica_id'] option:selected").text() +'</td>' +
                '<td>'+ especificacion_producto +' '+ document.getElementById('caracteristica_especificacion_producto').value +'</td>' +
                '<td>'+ especificacion_electrica +' '+ document.getElementById('caracteristica_especificaion_electrica').value +'</td>' +
                '<td>'+ link_amazon +''+ link_a_amazon + '</td>' +
                '<td>'+ link_alibaba +''+ link_a_alibaba +'</td>' +
                '</tr>'; //esto seria lo que contendria la fila

            i++;

            $('.caracteristica tr:first').after(fila);
            countCaracteristicas++;
            var nFilas = $(".caracteristica tr").length;

            // Limpia formulario
            $('#caracteristica-form')[0].reset();

            $("#modal-caracteristica").modal('hide');//oculto el modal
        }
    });
});


// Llenado de seguimiento producto
$(document).ready(function() {
    var countSeguimiento = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
    $('#seguimiento-form').validate({
        event: "blur",rules: {
            'producto_seguimiento_id' : "required"
        },
        messages: {
            'producto_seguimiento_id' : "El producto es requerido"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            var imagenPreproduccion = $('#input-preproduccion-crea'),
                preproduccion = imagenPreproduccion.clone();
            var imagenProduccion = $('#input-produccion-crea'),
                produccion = imagenProduccion.clone();
            var imagenOemUno = $('#input-oem_uno-crea'),
                oemUno = imagenOemUno.clone();
            var imagenOemDos = $('#input-oem_dos-crea'),
                oemDos = imagenOemDos.clone();
            var imagenOemTres = $('#input-oem_tres-crea'),
                oemTres = imagenOemTres.clone();
            var imagenEmpaquetado = $('#input-empaquetado-crea'),
                empaquetado = imagenEmpaquetado.clone();

            var id_producto = '<input type="hidden" class="form-control pull-right " name="seguimiento['+ countSeguimiento +'][producto_id]" value="'+ document.getElementById('producto_seguimiento_id').value +'">',
                divPreproduccion = '<div class="form-group col-sm-12" id="preproduccion-file"></div>',
                divProduccion = '<div class="form-group col-sm-12" id="produccion-file"></div>',
                divOem1 = '<div class="form-group col-sm-12" id="oem-uno-file"></div>',
                divOem2 = '<div class="form-group col-sm-12" id="oem-dos-file"></div>',
                divOem3 = '<div class="form-group col-sm-12" id="oem-tres-file"></div>',
                divEmpaquetado = '<div class="form-group col-sm-12" id="empaquetado-file"></div>';



            var fila = '<tr id="rowSeguimiento'+ i +'">' +
                '<td>'+ id_producto +' '+ $("select[name='producto_seguimiento_id'] option:selected").text() +'</td>' +
                '<td>'+ divPreproduccion +'</td>' +
                '<td>'+ divProduccion +'</td>' +
                '<td>'+ divOem1 +'</td>' +
                '<td>'+ divOem2 +'</td>' +
                '<td>'+ divOem3 +'</td>' +
                '<td>'+ divEmpaquetado +'</td>' +
                '</tr>'; //esto seria lo que contendria la fila

            i++;

            $('.seguimiento tr:first').after(fila);

            preproduccion.attr('name', 'seguimiento['+ countSeguimiento +'][preproduccion_seguimiento]');
            preproduccion.attr('id', 'preproduccion['+ countSeguimiento +']');
            var namePreroduccion = $('#foto-preproduccion-seleccionada-crea').clone();
            $('#preproduccion-file').after(namePreroduccion);
            preproduccion.removeClass('filestyle');
            $('#preproduccion-file').after(preproduccion);
            $('#input-preproduccion-crea').removeClass('filestyle');

            produccion.attr('name', 'seguimiento['+ countSeguimiento +'][produccion_seguimiento]');
            produccion.attr('id', 'produccion['+ countSeguimiento +']');
            var nameProduccion = $('#foto-produccion-seleccionada-crea').clone();
            $('#produccion-file').after(nameProduccion);
            produccion.removeClass('filestyle');
            $('#produccion-file').after(produccion);
            $('#input-produccion-crea').removeClass('filestyle');

            oemUno.attr('name', 'seguimiento['+ countSeguimiento +'][oem_uno_seguimiento]');
            oemUno.attr('id', 'oemUno['+ countSeguimiento +']');
            var nameoemUno = $('#foto-oem_uno-seleccionada-crea').clone();
            $('#oem-uno-file').after(nameoemUno);
            oemUno.removeClass('filestyle');
            $('#oem-uno-file').after(oemUno);
            $('#input-oem_uno-crea').removeClass('filestyle');

            oemDos.attr('name', 'seguimiento['+ countSeguimiento +'][oem_dos_seguimiento]');
            oemDos.attr('id', 'oemDos['+ countSeguimiento +']');
            var nameoemDos = $('#foto-oem_dos-seleccionada-crea').clone();
            $('#oem-dos-file').after(nameoemDos);
            oemDos.removeClass('filestyle');
            $('#oem-dos-file').after(oemDos);
            $('#input-oem_dos-crea').removeClass('filestyle');

            oemTres.attr('name', 'seguimiento['+ countSeguimiento +'][oem_tres_seguimiento]');
            oemTres.attr('id', 'oemTres['+ countSeguimiento +']');
            var nameoemTres = $('#foto-oem_tres-seleccionada-crea').clone();
            $('#oem-tres-file').after(nameoemTres);
            oemTres.removeClass('filestyle');
            $('#oem-tres-file').after(oemTres);
            $('#input-oem_tres-crea').removeClass('filestyle');

            empaquetado.attr('name', 'seguimiento['+ countSeguimiento +'][empaquetado_seguimiento]');
            empaquetado.attr('id', 'empaquetado['+ countSeguimiento +']');
            var nameempaquetado = $('#foto-empaquetado-seleccionada-crea').clone();
            $('#empaquetado-file').after(nameempaquetado);
            empaquetado.removeClass('filestyle');
            $('#empaquetado-file').after(empaquetado);
            $('#input-empaquetado-crea').removeClass('filestyle');

            countSeguimiento++;
            var nFilas = $(".caracteristica tr").length;

            // Limpia formulario
            $('#seguimiento-form')[0].reset();

            filestyle();

            $("#modal-seguimiento").modal('hide');//oculto el modal
        }
    });
});


// Llenado de Gasto destino
$(document).ready(function() {
    var countGD = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
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
            var file = $('#comporbante_gastos_destino'),
                arcivo_gastos_destino = file.clone();
            var tipo_gasto_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_gasto_gastos_destino" name="gastosDe['+ countGD +'][tipo_gasto_gastos_destino]" value="'+ document.getElementById("tipo_gasto_gastos_destino").value +'"></div>',
                costo_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="costo_gastos_destino" name="gastosDe['+ countGD +'][costo_gastos_destino]" value="'+ document.getElementById("costo_gastos_destino").value +'"></div>',
                moneda_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="moneda_gastos_destino" name="gastosDe['+ countGD +'][moneda_gastos_destino]" value="'+ document.getElementById("moneda_gastos_destino").value +'"></div>',
                div = '<div class="form-group col-sm-12" id="gastos-destino-file"></div>',
                nota_gastos_destino = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="nota_gastos_destino" name="gastosDe['+ countGD +'][nota_gastos_destino]" value="'+ document.getElementById("nota_gastos_destino").value +'"></div>';
                //comporbante_gastos_destino = '<input type="file" class="filestyle" name="gastosDe['+ countGD +'][comporbante_gastos_destino]" >';

            var fila = '<tr id="rowGastosDestino' + i + '">' +
                '<td>' + tipo_gasto_gastos_destino +' '+ $("select[name='tipo_gasto_gastos_destinoM'] option:selected").text() +'</td>' +
                '<td>' + costo_gastos_destino +' '+ document.getElementById("costo_gastos_destino").value +'</td>' +
                '<td>' + moneda_gastos_destino +' '+ document.getElementById("moneda_gastos_destino").value +'</td>' +
                '<td>' + nota_gastos_destino +' '+ document.getElementById("nota_gastos_destino").value +'</td>' +
                '<td>' + div + '</td>' +
                '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger remove_gastos_destino"><i class="fa fa-trash  "></i></button></td>' +
                '</tr>'; //esto seria lo que contendria la fila

            i++;

            $('.gastosDestino tr:first').after(fila);
            arcivo_gastos_destino.attr('name', 'gastosDe['+ countGD +'][comporbante_gastos_destino]');
            arcivo_gastos_destino.attr('id', 'comporbante_gastos_destino['+ countGD +']');
            var filename = arcivo_gastos_destino.val();
            $('#gastos-destino-file').after(filename.split('\\').pop());
            arcivo_gastos_destino.removeClass('filestyle');
            $('#gastos-destino-file').after(arcivo_gastos_destino);
            $('#comporbante_gastos_destino').removeClass('filestyle');
            countGD++;

            var nFilas = $(".gastosDestino tr").length;

            // Limpia formulario
            $("#gastos-destino-form")[0].reset();

            // Recargo filestyle
            filestyle();

            $("#myModal4").modal('hide');//oculto el modal

            $(document).on('click', '.remove_gastos_destino', function() {
                var button_id = $(this).attr("id");
                //cuando da click obtenemos el id del boton
                $('#rowGastosDestino' + button_id).remove(); //borra la fila
                //limpia el para que vuelva a contar las filas de la tabla
                var nFilas = $(".gastosDestino tr").length;
            });
        }
    });
});

// Llenado de Pagos
$(document).ready(function() {
    var countPagos = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
    //obtenemos el valor de los input
    $('#pagos-form').validate({
        event: "blur",rules: {
            'pago_pagos': "required",
            'tipo_cambio_pago_orden': "required",
            'pago_comprobante' : "required"
        },
        messages: {
            'pago_pagos': "El pago es requerido",
            'tipo_cambio_pago_orden': "Tipo de cambio es requerido",
            'pago_comprobante' : "El comprobante es requerido"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            var file = $('#pago_comprobante'),
                pago_comprobante = file.clone();
            var pago_orden = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="pago_orden_table" name="pago['+ countPagos +'][pago_orden]" value="'+ document.getElementById('pago_pagos').value +'"></div>',
                tipo_cambio_pago_orden = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_cambio_pago_orden_table" name="pago['+ countPagos +'][tipo_cambio_pago_orden]" value="'+ document.getElementById('tipo_cambio_pago_orden').value +'"></div>',
                div = '<div class="form-group col-sm-12" id="pago-file"></div>';
            var fila = '<tr id="rowPago' + i + '">' +
                '<td>' + pago_orden +''+ document.getElementById('pago_pagos').value +'</td>' +
                '<td>' + tipo_cambio_pago_orden +''+ document.getElementById('tipo_cambio_pago_orden').value +'</td>' +
                '<td>' + div +'</td>' +
                '<td><button type="button" name="remove_pago" id="' + i + '" class="btn btn-danger remove_pago"><i class="fa fa-trash  "></i></button></td>' +
                '</tr>'; //esto seria lo que contendria la fila
            i++;
            $('.pagos tr:first').after(fila);
            pago_comprobante.attr('name', 'pago['+ countPagos +'][comporbante_pago]');
            pago_comprobante.attr('id', 'pago_copiado['+ countPagos +']');
            var filename = pago_comprobante.val();
            $('#pago-file').after(filename.split('\\').pop());
            pago_comprobante.removeClass('filestyle');
            $('#pago-file').after(pago_comprobante);

            $('#pago_comprobante').removeClass('filestyle');
            countPagos++;
            var nFilas = $(".pagos tr").length;
            // Limpia formulario
            $("#pagos-form")[0].reset();

            // Recargo filestyle
            filestyle();

            $("#pagos-modal").modal('hide');//oculto el modal

            $(document).on('click', '.remove_pago', function() {
                var button_id = $(this).attr("id");
                //cuando da click obtenemos el id del boton
                $('#pago_comprobante' + button_id).remove(); //borra la fila
                //limpia el para que vuelva a contar las filas de la tabla
                var nFilas = $(".pagos tr").length;
            });
        }
    });
});


// Llenado de Transito
$(document).ready(function() {
    var countTransito = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
    $('#transito-form').validate({
        event: "blur",rules: {
            'metodo_transito' : "required",
            // 'guia_transito' : "required",
            // 'forwarder_transito' : "required",
            // 'fecha_embarque_transito' : "required",
            'fecha_tentativa_llegada_transito' : "required",
            // 'comercial_invoce_transito' : "required",
            // 'cbm_transito' : "required",
            // 'peso_transito' : "required"
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
            var file = $('#archivo_comercial_invoce_file'),
                archivo_comercial_invoce_transito = file.clone();
            var metodo_transito = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="metodo_transito" name="transito['+ countTransito +'][metodo_transito]" value="'+ $('#metodo_transito').val() +'"></div>',
                guia_transito = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="metodo_transito" name="transito['+ countTransito +'][guia_transito]" value="'+ document.getElementById("guia_transito").value +'"></div>',
                forwarder_transito = '<div class="form-group col-sm-12" id="transito-file"><input type="hidden" class="form-control pull-right " id="forwarder_transito" name="transito['+ countTransito +'][forwarder_transito]" value="'+ $('#forwarder_transito').val() +'"></div>',
                fecha_embarque_transito = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="metodo_transito" name="transito['+ countTransito +'][fecha_embarque_transito]" value="'+ document.getElementById("fecha_embarque_transito").value +'"></div>',
                fecha_tentativa_llegada_transito = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="fecha_tentativa_llegada_transito" name="transito['+ countTransito +'][fecha_tentativa_llegada_transito]" value="'+ document.getElementById("fecha_tentativa_llegada_transito").value +'"></div>',
                comercial_invoce_transito = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="comercial_invoce_transito" name="transito['+ countTransito +'][comercial_invoce_transito]" value="'+ document.getElementById("comercial_invoce_transito").value +'"></div>',
                cajas_transito = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="cajas_transito" name="transito['+ countTransito +'][cajas_transito]" value="'+ document.getElementById("cajas_transito").value +'"></div>',
                cbm_transito = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="cbm_transito" name="transito['+ countTransito +'][cbm_transito]" value="'+ document.getElementById("cbm_transito").value +'"></div>',
                peso_transito = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="cbm_transito" name="transito['+ countTransito +'][peso_transito]" value="'+ document.getElementById("peso_transito").value +'"></div>';
            var fila = '<tr id="rowTransito' + i + '">' +
                '<td>' + metodo_transito +''+cajas_transito+''+ $("select[name='metodo_transito'] option:selected").text() +'</td>' +
                '<td>' + guia_transito +''+cbm_transito+''+ document.getElementById("guia_transito").value +'</td>' +
                '<td>' + comercial_invoce_transito +''+peso_transito+''+ document.getElementById("comercial_invoce_transito").value +'</td>' +
                '<td>' + forwarder_transito +'</td>' +
                '<td>' + fecha_embarque_transito +' '+ document.getElementById("fecha_embarque_transito").value +'</td>' +
                '<td>' + fecha_tentativa_llegada_transito +' '+ document.getElementById("fecha_tentativa_llegada_transito").value +'</td>' +
                '<td><button type="button" name="remove_transito" id="' + i + '" class="btn btn-danger remove_transito"><i class="fa fa-trash  "></i></button></td>' +
                '</tr>'; //esto seria lo que contendria la fila
            i++;
            $('.transito tr:first').after(fila);

            archivo_comercial_invoce_transito.attr('name', 'transito['+ countTransito +'][archivo_comercial_invoce_file]');
            archivo_comercial_invoce_transito.attr('id', 'archivo_comercial_invoce_file['+ countTransito +']');
            var filename = archivo_comercial_invoce_transito.val();
            $('#transito-file').after(filename.split('\\').pop());
            archivo_comercial_invoce_transito.removeClass('filestyle');
            $('#transito-file').after(archivo_comercial_invoce_transito);
            $('#archivo_comercial_invoce_file').removeClass('filestyle');
            countTransito++;
            var nFilas = $(".transito tr").length;
            // Limpia formulario
            $("#transito-form")[0].reset();
            // Recargo el filestyle
            filestyle();
            // Oculta modal
            $("#transito-modal").modal('hide');
            $(document).on('click', '.remove_transito', function() {
                var button_id = $(this).attr("id");
                //cuando da click obtenemos el id del boton
                $('#rowTransito' + button_id).remove(); //borra la fila
                //limpia el para que vuelva a contar las filas de la tabla
                var nFilas = $(".transito tr").length;
            });
        }
    });
});

// Llenado de Pedimento
$(document).ready(function() {
    var countPedimento = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
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
            var file = $('#pedimento_digital'),
                pedimento_digital = file.clone();
            var numero_pedimento = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="numero_pedimento" name="pedimento['+ countPedimento +'][numero_pedimento]" value="'+ document.getElementById("numero_pedimento").value +'"></div>',
                aduana_pedimento = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="aduana_pedimento" name="pedimento['+ countPedimento +'][aduana_pedimento]" value="'+ $('#aduana_pedimento').val() +'"></div>',
                agente_aduanal_pedimento = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="agente_aduanal_pedimento" name="pedimento['+ countPedimento +'][agente_aduanal_pedimento]" value="'+ $('#agente_aduanal_pedimento').val() +'"></div>',
                tipo_cambio_pedimento_pedimento = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="tipo_cambio_pedimento_pedimento" name="pedimento['+ countPedimento +'][tipo_cambio_pedimento_pedimento]" value="'+ document.getElementById("tipo_cambio_pedimento_pedimento").value +'"></div>',
                dta_pedimento = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="dta_pedimento" name="pedimento['+ countPedimento +'][dta_pedimento]" value="'+ document.getElementById("dta_pedimento").value +'"></div>',
                cnt_pedimento = '<div class="form-group col-sm-12" id="pedimento-file"><input type="hidden" class="form-control pull-right " id="cnt_pedimento" name="pedimento['+ countPedimento +'][cnt_pedimento]" value="'+ document.getElementById("cnt_pedimento").value +'"></div>',
                igi_pedimento = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="igi_pedimento" name="pedimento['+ countPedimento +'][igi_pedimento]" value="'+ document.getElementById("igi_pedimento").value +'"></div>',
                prv_pedimento = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="prv_pedimento" name="pedimento['+ countPedimento +'][prv_pedimento]" value="'+ document.getElementById("prv_pedimento").value +'"></div>',
                iva_pedimento = '<div class="form-group col-sm-12"><input type="hidden" class="form-control pull-right " id="iva_pedimento" name="pedimento['+ countPedimento +'][iva_pedimento]" value="'+ document.getElementById("iva_pedimento").value +'"></div>';
            //le resto 1 para no contar la fila del header
            var fila = '<tr id="rowPedimento' + i + '">' +
                '<td>' + numero_pedimento +''+dta_pedimento+''+ document.getElementById("numero_pedimento").value +'</td>' +
                '<td >'+ cnt_pedimento +'</td>' +
                '<td>' + aduana_pedimento +''+igi_pedimento+''+ $("select[name='aduana_pedimento'] option:selected").text() +'</td>' +
                '<td>' + agente_aduanal_pedimento +''+prv_pedimento+''+ $("select[name='agente_aduanal_pedimento'] option:selected").text() +'</td>' +
                '<td>' + tipo_cambio_pedimento_pedimento +''+iva_pedimento+ ''+ document.getElementById("tipo_cambio_pedimento_pedimento").value +'</td>' +
                '<td><button type="button" name="remove_pedimento" id="' + i + '" class="btn btn-danger remove_pedimento"><i class="fa fa-trash  "></i></button></td>' +
                '</tr>'; //esto seria lo que contendria la fila
            i++;
            $('.pedimento tr:first').after(fila);
            pedimento_digital.attr('name', 'pedimento['+ countPedimento +'][pedimento_digital]');
            pedimento_digital.attr('id', 'pedimento_digital['+ countPedimento +']');
            var filename = pedimento_digital.val();
            $('#pedimento-file').after(filename.split('\\').pop());
            pedimento_digital.removeClass('filestyle');
            $('#pedimento-file').after(pedimento_digital);
            $('#pedimento_digital').removeClass('filestyle');
            countPedimento++;
            var nFilas = $(".pedimento tr").length;
            // Limpia formulario
            $("#pedimento-form")[0].reset();
            // recargo el filestyle
            filestyle();
            //Oculta  modal
            $("#pedimento-modal").modal('hide');
            // Reueve ultima fila
            $(document).on('click', '.remove_pedimento', function() {
                var button_id = $(this).attr("id");
                //cuando da click obtenemos el id del boton
                $('#rowPedimento' + button_id).remove(); //borra la fila
                //limpia el para que vuelva a contar las filas de la tabla
                var nFilas = $(".pedimento tr").length;
            });
        }
    });
});

// Llenado de Clasificación
$(document).ready(function() {
    var countClasificacion = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
    $('#clasificacion-form').validate({
        event: "blur",rules: {
            'producto_clasificacion_id' : "required",
            'clasificacion_arancelaria' : "required"
        },
        messages: {
            'producto_clasificacion_id' : "El Producto es requerido",
            'clasificacion_arancelaria' : "La Clasificción es requerida"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            var id_producto = '<input type="hidden" class="form-control pull-right " name="clasificaciones['+ countClasificacion +'][producto_id]" value="'+ document.getElementById('producto_clasificacion_id').value +'">',
                nombre_producto = '<input type="hidden" class="form-control pull-right" name="clasificaciones['+ countClasificacion +'][producto_nombre]" value="'+  $("select[name='producto_clasificacion_id'] option:selected").text() +'">',
                clasificacion_arancelaria = '<input type="hidden" class="form-control pull-right" name="clasificaciones['+ countClasificacion +'][clasificacion_arancelaria]" value="'+  document.getElementById('clasificacion_arancelaria').value +'">',
                nom_1 = '<input type="hidden" class="form-control pull-right" name="clasificaciones['+ countClasificacion +'][nom_1]" value="'+  document.getElementById('nom_1').value +'">',
                nom_2 = '<input type="hidden" class="form-control pull-right" name="clasificaciones['+ countClasificacion +'][nom_2]" value="'+  document.getElementById('nom_2').value +'">',
                nom_3 = '<input type="hidden" class="form-control pull-right" name="clasificaciones['+ countClasificacion +'][nom_3]" value="'+  document.getElementById('nom_3').value +'">',
                nom_4 = '<input type="hidden" class="form-control pull-right" name="clasificaciones['+ countClasificacion +'][nom_4]" value="'+  document.getElementById('nom_4').value +'">';

            var fila = '<tr id="rowClasificacion'+ i +'">' +
                '<td>'+ id_producto +' '+ $("select[name='producto_clasificacion_id'] option:selected").text() +'</td>' +
                '<td>'+ clasificacion_arancelaria +' '+ document.getElementById('clasificacion_arancelaria').value +'</td>' +
                '<td>'+ nom_1 +' '+ document.getElementById('nom_1').value +'</td>' +
                '<td>'+ nom_2 +' '+ document.getElementById('nom_2').value +'</td>' +
                '<td>'+ nom_3 +' '+ document.getElementById('nom_3').value +'</td>' +
                '<td>'+ nom_4 +' '+ document.getElementById('nom_4').value +'</td>' +
                '</tr>'; //esto seria lo que contendria la fila

            i++;

            $('.clasificacion tr:first').after(fila);
            countClasificacion++;
            var nFilas = $(".clasificacion tr").length;

            // Limpia formulario
            $('#clasificacion-form')[0].reset();

            $("#modal-clasificacion").modal('hide');//oculto el modal
        }
    });
});


// Llenado de Diseño
$(document).ready(function() {
    var countDis = 0;
    var i = 1; //contador para asignar id al boton que borrara la fila
    $('#diseno-form').validate({
        event: "blur",rules: {
            'producto_diseno_id' : "required",
            'fecha_aviso_diseno' : "required"
        },
        messages: {
            'producto_diseno_id' : "El Producto es requerido",
            'fecha_aviso_diseno' : "La Fecha de aviso de diseño es requerida es requerida"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){
            var producto_diseno = $('#producto_diseno'),
                producto_diseno_file = producto_diseno.clone();
            var empaque_diseno = $('#empaque_diseno'),
                empaque_diseno_file = empaque_diseno.clone();
            var instructivo_diseno = $('#instructivo_diseno'),
                instructivo_diseno_file = instructivo_diseno.clone();
            var oem_autorizado_trafico = $('#oem_autorizado_trafico'),
                oem_autorizado_trafico_file = oem_autorizado_trafico.clone();
            var archivos_fabricante = $('#archivos_fabricante'),
                archivos_fabricante_file = archivos_fabricante.clone();
            var archivos_diseno = $('#archivos_diseno'),
                archivos_diseno_file = archivos_diseno.clone();

            var id_producto = '<input type="hidden" class="form-control pull-right " name="diseno['+ countDis +'][producto_id]" value="'+ document.getElementById('producto_diseno_id').value +'">',
                nombre_producto = '<input type="hidden" class="form-control pull-right" name="diseno['+ countDis +'][producto_nombre]" value="'+  $("select[name='producto_diseno_id'] option:selected").text() +'">',
                oem = '<input type="hidden" class="form-control pull-right" name="diseno['+ countDis +'][oem]" value="'+  document.getElementById('oem').value +'">',
                empaque = '<input type="hidden" class="form-control pull-right" name="diseno['+ countDis +'][empaque]" value="'+  document.getElementById('empaque').value +'">',
                instructivo = '<input type="hidden" class="form-control pull-right" name="diseno['+ countDis +'][instructivo]" value="'+  document.getElementById('instructivo').value +'">',
                fecha_aviso_disneo = '</div><input type="hidden" class="form-control pull-right" name="diseno['+ countDis +'][fecha_aviso_diseno]" value="'+  document.getElementById('fecha_aviso_diseno').value +'">',
                div_producto_diseno = '<div id="producto-diseno-div"></div>',
                div_empaque_diseno = '<div id="empaque_diseno-div"></div>',
                div_instructivo_diseno = '<div id="instructivo_diseno-div"></div>',
                div_oem_autorizado_trafico = '<div id="oem_autorizado_trafico-div"></div>',
                fecha_autorizacion_trafico = '<input type="hidden" class="form-control pull-right" name="diseno['+ countDis +'][fecha_autorizacion_trafico]" value="'+  document.getElementById('fecha_autorizacion_trafico').value +'">',
                div_archivos_fabricante = '<div id="archivos_fabricante-div"></div>',
                div_archivos_diseno = '<div id="archivos_diseno-div"></div>';

            if(document.getElementById("oem").value ==="true"){ var oemText = "SI"} else { var oemText = "NO"}
            if(document.getElementById("empaque").value ==="true"){ var empaqueText = "SI"} else { var empaqueText = "NO"}
            if(document.getElementById("instructivo").value ==="true"){ var instructivoText = "SI"} else { var instructivoText = "NO"}

            var fila = '<tr id="rowDiseno'+ i +'">' +
                '<td>'+ id_producto +' '+ $("select[name='producto_diseno_id'] option:selected").text() +'</td>' +
                '<td>'+ oem +' '+  oemText +'</td>' +
                '<td>'+ empaque +' '+ empaqueText +'</td>' +
                '<td>'+ instructivo +' '+ instructivoText +'</td>' +
                '<td>'+ fecha_aviso_disneo +' '+ document.getElementById('fecha_aviso_diseno').value +'</td>' +
                '<td>'+ div_producto_diseno +'</td>' +
                '<td>'+ div_empaque_diseno +'</td>' +
                '<td>'+ div_instructivo_diseno +'</td>' +
                '<td>'+ div_oem_autorizado_trafico +'</td>' +
                '<td>'+ fecha_autorizacion_trafico +''+ document.getElementById('fecha_autorizacion_trafico').value +'</td>' +
                '<td>'+ div_archivos_diseno +'</td>' +
                '<td>'+ div_archivos_fabricante +'</td>' +
                '</tr>'; //esto seria lo que contendria la fila

            i++;

            $('.diseno-table tr:first').after(fila);

            producto_diseno_file.attr('name', 'diseno['+ countDis +'][producto_diseno]');
            producto_diseno_file.attr('id', 'disenoP['+ countDis +']');
            var filenamePD = producto_diseno_file.val();
            $('#producto-diseno-div').after(filenamePD.split('\\').pop());
            $('#producto-diseno-div').after(producto_diseno_file);
            producto_diseno_file.removeClass('filestyle');

            empaque_diseno_file.attr('name', 'diseno['+ countDis +'][empaque_diseno]');
            empaque_diseno_file.attr('id', 'disenoE['+ countDis +']');
            var filenameED = empaque_diseno_file.val();
            $('#empaque_diseno-div').after(filenameED.split('\\').pop());
            $('#empaque_diseno-div').after(empaque_diseno_file);
            empaque_diseno_file.removeClass('filestyle');

            instructivo_diseno_file.attr('name', 'diseno['+ countDis +'][instructivo_diseno]');
            instructivo_diseno_file.attr('id', 'disenoI['+ countDis +']');
            var filenameID = instructivo_diseno_file.val();
            $('#instructivo_diseno-div').after(filenameID.split('\\').pop());
            $('#instructivo_diseno-div').after(instructivo_diseno_file);
            instructivo_diseno_file.removeClass('filestyle');

            oem_autorizado_trafico_file.attr('name', 'diseno['+ countDis +'][oem_autorizado_trafico]');
            oem_autorizado_trafico_file.attr('id', 'disenoO['+ countDis +']');
            var filenameOE = oem_autorizado_trafico_file.val();
            $('#oem_autorizado_trafico-div').after(filenameOE.split('\\').pop());
            $('#oem_autorizado_trafico-div').after(oem_autorizado_trafico_file);
            oem_autorizado_trafico_file.removeClass('filestyle');

            archivos_fabricante_file.attr('name', 'diseno['+ countDis +'][archivos_fabricante][]');
            archivos_fabricante_file.attr('id', 'disenoFA['+ countDis +']');
            var filenameAF = archivos_fabricante_file.val();
            $('#archivos_fabricante-div').after('...');
            $('#archivos_fabricante-div').after(archivos_fabricante_file);
            archivos_fabricante_file.removeClass('filestyle');

            archivos_diseno_file.attr('name', 'diseno['+ countDis +'][archivos_diseno][]');
            archivos_diseno_file.attr('id', 'disenoDis['+ countDis +']');
            var filenameAD = archivos_fabricante_file.val();
            $('#archivos_diseno-div').after('...');
            $('#archivos_diseno-div').after(archivos_diseno_file);
            archivos_diseno_file.removeClass('filestyle');

            countDis++;
            var nFilas = $(".diseno tr").length;

            // Limpia formulario
            $('#diseno-form')[0].reset();

            $("#modal-diseno").modal('hide');//oculto el modal
        }
    });
});

$("#oem").on('change', function() {
    if ($(this).is(':checked')) {
        $(this).attr('value', 'true');
    } else {
        $(this).attr('value', 'false');
    }
});
$("#empaque").on('change', function() {
    if ($(this).is(':checked')) {
        $(this).attr('value', 'true');
    } else {
        $(this).attr('value', 'false');
    }
});
$("#instructivo").on('change', function() {
    if ($(this).is(':checked')) {
        $(this).attr('value', 'true');
    } else {
        $(this).attr('value', 'false');
    }
});