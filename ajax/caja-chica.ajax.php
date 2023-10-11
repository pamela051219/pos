<?php

require_once "../controladores/caja_chica.controlador.php";
require_once "../modelos/caja_chica.modelo.php";

class AjaxCajasChicas{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idCajaChica;

	public function ajaxEditarCajaChica(){

		$item = "id";
		$valor = $this->idCajaChica;

		$respuesta = ControladorCajaChica::ctrMostrarCajaChica($item, $valor);

		echo json_encode($respuesta);

	}


	
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idCajaChica"])){

	$editar = new AjaxCajasChicas();
	$editar -> idCajaChica = $_POST["idCajaChica"];
	$editar -> ajaxEditarCajaChica();

}



