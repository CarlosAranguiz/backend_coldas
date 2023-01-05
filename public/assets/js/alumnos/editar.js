$(document).ready( function () {
    var opciones = jQuery('#universidad').children('option');
    var textoUniversidad = $( "#universidad option:selected" ).text();
    var carreraUser = $("#carreraHidden").val;
    opciones.map((index,universidad) => {
      if(universidad.outerText == textoUniversidad){
        universidad.selected = true;
        jQuery.ajax({
          url:'/api/carrera/'+universidad.value,
          success: (resp) => {
              $('#carrera').empty();
              resp.data.forEach((data)=>{
                  jQuery('#carrera').append("<option value='"+data.id+"'>"+ data.nombre_carrera +"</option>");
              });
              $('#carrera').children('option').map((index,carrera) => {
                  if(carrera.outerText == carreraUser){
                      carrera.selected = true;
                  }
              });
          }
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
    $('#tablaPracticas').DataTable();
});