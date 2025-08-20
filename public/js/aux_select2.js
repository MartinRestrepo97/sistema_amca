$(document).ready(function() {
    $('#fincas_agregar').select2();
    $('#animales_agregar').select2();
    $('#vegetales_agregar').select2();
    $('#preparados_agregar').select2();   
});

function cargar_fincas(id_agricultor) {

    $('#id_agricultor_datos').val(id_agricultor);

    var fincas = $("#fincas_agregar");
    fincas.find('option').remove();

    var animales = $("#animales_agregar");
    animales.find('option').remove();

    var vegetales = $("#vegetales_agregar");
    vegetales.find('option').remove();

    var preparados = $("#preparados_agregar");
    preparados.find('option').remove();
    
    $("#listado_fincas").html('');
    $("#listado_animales").html('');
    $("#listado_vegetales").html('');
    $("#listado_preparados").html('');

    $.get( "fincas_agricultor/"+id_agricultor)
    .done(function( data ) {
        $(data.fincas).each(function(i, v){ // indice, valor
            fincas.append('<option value="' + v.id + '">' + v.nombre + ' ('+v.ubicacion+') '+'</option>');            
        })
        var cont = 0;
        $(data.agricultorfincas).each(function(i, v){ // indice, valor
            cont++;
            $("#listado_fincas").append('<tr><td>'+cont+'</td><td>'+v.nombre+'</td><td>'+v.ubicacion+'</td><td><button type="button" class="btn btn-danger" onclick="fincas_agricultor_eliminar('+"'"+v.id+"'"+')">X</button></td></tr>');            
        })
        //console.log(data );
    });

    $.get( "animales_agricultor/"+id_agricultor)
    .done(function( data ) {
        $(data.animales).each(function(i, v){ // indice, valor
            animales.append('<option value="' + v.id + '">' + v.especie + ' - '+v.raza+' '+'</option>');            
        })
        var cont = 0;
        $(data.agricultoranimales).each(function(i, v){ // indice, valor
            cont++;
            $("#listado_animales").append('<tr><td>'+cont+'</td><td>'+v.raza+'</td><td>'+v.especie+'</td><td><button type="button" class="btn btn-danger" onclick="animales_agricultor_eliminar('+"'"+v.id+"'"+')">X</button></td></tr>');            
        })
        //console.log(data );
    });

    $.get( "vegetales_agricultor/"+id_agricultor)
    .done(function( data ) {
        $(data.vegetales).each(function(i, v){ // indice, valor
            vegetales.append('<option value="' + v.id + '">' + v.especie +'</option>');            
        })
        var cont = 0;
        $(data.agricultorvegetales).each(function(i, v){ // indice, valor
            cont++;
            $("#listado_vegetales").append('<tr><td>'+cont+'</td><td>'+v.especie+'</td><td>'+v.observaciones+'</td><td><button type="button" class="btn btn-danger" onclick="vegetales_agricultor_eliminar('+"'"+v.id+"'"+')">X</button></td></tr>');            
        })
        //console.log(data );
    });

    $.get( "preparados_agricultor/"+id_agricultor)
    .done(function( data ) {
        $(data.preparados).each(function(i, v){ // indice, valor
            preparados.append('<option value="' + v.id + '">' + v.nombre +'</option>');            
        })
        var cont = 0;
        $(data.agricultorpreparados).each(function(i, v){ // indice, valor
            cont++;
            $("#listado_preparados").append('<tr><td>'+cont+'</td><td>'+v.nombre+'</td><td>'+v.observaciones+'</td><td><button type="button" class="btn btn-danger" onclick="preparados_agricultor_eliminar('+"'"+v.id+"'"+')">X</button></td></tr>');            
        })
        //console.log(data );
    });

}

function fincas_agricultor_guardar() {
    var fincas_agrega = $("#fincas_agregar").val();
    var id_agricultor = $("#id_agricultor_datos").val();
    var _token = $('#token_id').val();
    if(fincas_agrega.length<=0) {
        alert("Debe seleccionar al menos una finca!!!");
    } else {

        $.post( "fincas_agricultor_guardar", { id_agricultor: id_agricultor, fincas_agrega: fincas_agrega, _token : _token })
        .done(function( data ) {
            cargar_fincas(id_agricultor);
        });
        
        
    }
}

function fincas_agricultor_eliminar(id_registro) {
    
    var _token = $('#token_id').val();
    var id_agricultor = $("#id_agricultor_datos").val();
    if (confirm('Esta seguro de eliminar este registro!!')) {
        $.post( "fincas_agricultor_eliminar", { id_registro: id_registro, _token : _token })
        .done(function( data ) {
            cargar_fincas(id_agricultor);
        });
    }
}


function animales_agricultor_guardar() {
    var animales_agrega = $("#animales_agregar").val();
    var id_agricultor = $("#id_agricultor_datos").val();
    var _token = $('#token_id').val();
    if(animales_agrega.length<=0) {
        alert("Debe seleccionar al menos un animal!!!");
    } else {

        $.post( "animales_agricultor_guardar", { id_agricultor: id_agricultor, animales_agrega: animales_agrega, _token : _token })
        .done(function( data ) {
            cargar_fincas(id_agricultor);
        });
        
        
    }
}

function animales_agricultor_eliminar(id_registro) {
    
    var _token = $('#token_id').val();
    var id_agricultor = $("#id_agricultor_datos").val();
    if (confirm('Esta seguro de eliminar este registro!!')) {
        $.post( "animales_agricultor_eliminar ", { id_registro: id_registro, _token : _token })
        .done(function( data ) {
            cargar_fincas(id_agricultor);
        });
    }
}

function vegetales_agricultor_guardar() {
    var vegetales_agrega = $("#vegetales_agregar").val();
    var id_agricultor = $("#id_agricultor_datos").val();
    var _token = $('#token_id').val();
    if(vegetales_agrega.length<=0) {
        alert("Debe seleccionar al menos un vegetal!!!");
    } else {

        $.post( "vegetales_agricultor_guardar", { id_agricultor: id_agricultor, vegetales_agrega: vegetales_agrega, _token : _token })
        .done(function( data ) {
            cargar_fincas(id_agricultor);
        });
        
        
    }
}

function vegetales_agricultor_eliminar(id_registro) {
    
    var _token = $('#token_id').val();
    var id_agricultor = $("#id_agricultor_datos").val();
    if (confirm('Esta seguro de eliminar este registro!!')) {
        $.post( "vegetales_agricultor_eliminar", { id_registro: id_registro, _token : _token })
        .done(function( data ) {
            cargar_fincas(id_agricultor);
        });
    }
}

function preparados_agricultor_guardar() {
    var preparados_agrega = $("#preparados_agregar").val();
    var id_agricultor = $("#id_agricultor_datos").val();
    var _token = $('#token_id').val();
    if(preparados_agrega.length<=0) {
        alert("Debe seleccionar al menos un prepardo!!!");
    } else {

        $.post( "preparados_agricultor_guardar", { id_agricultor: id_agricultor, preparados_agrega: preparados_agrega, _token : _token })
        .done(function( data ) {
            cargar_fincas(id_agricultor);
        });
        
        
    }
}

function preparados_agricultor_eliminar(id_registro) {
    
    var _token = $('#token_id').val();
    var id_agricultor = $("#id_agricultor_datos").val();
    if (confirm('Esta seguro de eliminar este registro!!')) {
        $.post( "preparados_agricultor_eliminar", { id_registro: id_registro, _token : _token })
        .done(function( data ) {
            cargar_fincas(id_agricultor);
        });
    }
}

