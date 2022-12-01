<?php
	
	require_once "mainModel.php";

	class almacenModelo extends mainModel{

		/*--------- Modelo agregar almacen ---------*/
		protected static function agregar_almacen_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO almacen(CodAlmacen,CodUbicacion,NombreAlmacen) VALUES(:CodAlmacen,:CodUbicacion,:NombreAlmacen)");

			$sql->bindParam(":CodAlmacen",$datos['CodAlmacen']);
			$sql->bindParam(":CodUbicacion",$datos['CodUbicacion']);
			$sql->bindParam(":NombreAlmacen",$datos['NombreAlmacen']);
			$sql->execute();

			return $sql;
		}

	}