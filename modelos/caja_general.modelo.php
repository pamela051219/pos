<?php

require_once "conexion.php";

class ModeloCajaGeneral{

	/*=============================================
	CREAR CAJA GENERAL
	=============================================*/

	static public function mdlIngresarCajaGeneral($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, valor_a, usuario, valor_c, observaciones) 
        VALUES (:codigo,  :valor_a, :usuario, :valor_c, :observaciones)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":valor_a", $datos["valor_a"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);	
		$stmt->bindParam(":valor_c", $datos["valor_c"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CAJA GENERAL
	=============================================*/

	static public function mdlMostrarCajaGeneral($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarCajaGeneral($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  valor_a = :valor_a,  usuario = :usuario, valor_c = :valor_c, observaciones = :observaciones   WHERE codigo = :codigo");

		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt -> bindParam(":valor_a", $datos["valor_a"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
		$stmt -> bindParam(":valor_c", $datos["valor_c"], PDO::PARAM_STR);
		$stmt -> bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);



		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlBorrarCajaGeneral($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}




}
