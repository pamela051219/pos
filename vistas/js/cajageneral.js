

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarCajaGeneral", function(){

	var idCajaGeneral = $(this).attr("idCajaGeneral");
	
	
	var datos = new FormData();
	datos.append("idCajaGeneral", idCajaGeneral);

	$.ajax({

		url:"ajax/caja-general.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarCodigo").val(respuesta["codigo"]);
			$("#editarValora").val(respuesta["valor_a"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarValorc").val(respuesta["valor_c"]);
			$("#editarObservacion").val(respuesta["observaciones"]);


		}

	});

})



/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCajaGeneral", function(){

	var idCajaGeneral = $(this).attr("idCajaGeneral");
	
	swal({
        title: '¿Está seguro de borrar caja general?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar caja general!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=caja-general&idCajaGeneral="+idCajaGeneral;
        }

  })

})

