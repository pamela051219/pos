<?php

require_once "../controladores/caja_general.controlador.php";
require_once "../modelos/caja_general.modelo.php";

class AjaxCajasGenerales{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idCajaGeneral;

	public function ajaxEditarCajaGeneral(){

		$item = "id";
		$valor = $this->idCajaGeneral;

		$respuesta = ControladorCajaGeneral::ctrMostrarCajaGeneral($item, $valor);

		echo json_encode($respuesta);

	}


	
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idCajaGeneral"])){

	$editar = new AjaxCajasGenerales();
	$editar -> idCajaGeneral = $_POST["idCajaGeneral"];
	$editar -> ajaxEditarCajaGeneral();

}



