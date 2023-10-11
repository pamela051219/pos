/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarCajaChica", function(){

	var idCajaChica = $(this).attr("idCajaChica");
	
	
	var datos = new FormData();
	datos.append("idCajaChica", idCajaChica);

	$.ajax({

		url:"ajax/caja-chica.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarFecha").val(respuesta["fecha"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarComprobante").val(respuesta["comprobante"]);
			$("#editarDetalle").val(respuesta["detalle"]);
			$("#editarValor").val(respuesta["valor"]);
			$("#fotoActual").val(respuesta["foto"]);


			if(respuesta["foto"] != ""){

				$(".previsualizarEditar").attr("src", respuesta["foto"]);

			}else{

				$(".previsualizarEditar").attr("src", "vistas/img/recibos/default/anonymous.png");

			}

		}

	});

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCajaChica", function(){

	var idCajaChica = $(this).attr("idCajaChica");
	
	swal({
        title: '¿Está seguro de borrar caja chica?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar caja chica!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=caja-chica&idCajaChica="+idCajaChica;
        }

  })

})



