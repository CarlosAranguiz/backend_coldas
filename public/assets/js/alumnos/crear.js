$(document).ready( function () {
    var opciones = jQuery('#universidad').children('option');
    jQuery.ajax({
        url:'/api/carrera/'+opciones[0].value,
        success: (resp) => {
            $('#carrera').empty();
            resp.data.forEach((data)=>{
                jQuery('#carrera').append("<option value='"+data.id+"'>"+ data.nombre_carrera +"</option>");
                console.log(data);
            });
        }
      });
    $('#universidad').on('change',() => {
        jQuery.ajax({
            url:'/api/carrera/'+jQuery('#universidad').val(),
            success: (resp) => {
                $('#carrera').empty();
                resp.data.forEach((data)=>{
                    jQuery('#carrera').append("<option value='"+data.id+"'>"+ data.nombre_carrera +"</option>");
                });
            }
          });
    });
});