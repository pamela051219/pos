<?php

class ControladorCajaGeneral{

    /*=============================================
	CREAR CATEGORIAS
	=============================================*/
	static public function ctrCrearCajaGeneral(){

		if(isset($_POST["nuevoCodigo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigo"])){

				$tabla = "cajageneral";

			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
					           "valor_a"=>$_POST["nuevoValora"],
					           "usuario"=>$_POST["nuevoResponsable"],
					           "valor_c"=>$_POST["nuevoValorc"],
					           "observaciones"=>$_POST["nuevoObservacion"]);

			   	$respuesta = ModeloCajaGeneral::mdlIngresarCajaGeneral($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La caja ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "caja-general";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La caja no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "caja-general";

							}
						})

			  	</script>';

			}

		}

	}
	
	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarCajaGeneral($item, $valor){

		$tabla = "cajageneral";

		$respuesta = ModeloCajaGeneral::mdlMostrarCajaGeneral($tabla, $item, $valor);

		return $respuesta;
	
    }

    /*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCajaGeneral(){

		if(isset($_POST["editarCodigo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigo"])){

				$tabla = "cajageneral";

				$datos = array("codigo" => $_POST["editarCodigo"],
							   "valor_a" => $_POST["editarValora"],
							   "usuario" => $_POST["nuevoResponsable"],
							   "valor_c" => $_POST["editarValorc"],
							   "observaciones" => $_POST["editarObservacion"]);


				$respuesta = ModeloCajaGeneral::mdlEditarCajaGeneral($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La caja ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "caja-general";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La caja no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "caja-general";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR CAJA CHICA
	=============================================*/

	static public function ctrBorrarCajaGeneral(){

		if(isset($_GET["idCajaGeneral"])){

			$tabla ="cajageneral";
			$datos = $_GET["idCajaGeneral"];

			$respuesta = ModeloCajaGeneral::mdlBorrarCajaGeneral($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La caja ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "caja-general";

								}
							})

				</script>';

			}		

		}

	}
}

