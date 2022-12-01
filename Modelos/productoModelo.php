<?php
	
	require_once "mainModel.php";

	class productoModelo extends mainModel{

		/*--------- Modelo agregar insumo ---------*/
		protected static function agregar_producto_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO producto(NombreUsuario,ApellidoUsuario,EmailUsuario,UsuarioClave,UsuarioEstado,UsuarioPrivilegio) VALUES(:Nombre,:Apellido,:Email,:Clave,:Estado,:Privilegio)");

			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Apellido",$datos['Apellido']);
			$sql->bindParam(":Email",$datos['Email']);
			$sql->bindParam(":Clave",$datos['Clave']);
			$sql->bindParam(":Estado",$datos['Estado']);
			$sql->bindParam(":Privilegio",$datos['Privilegio']);
			$sql->execute();

			return $sql;
		}

	}