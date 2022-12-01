<?php
	
	require_once "mainModel.php";

	class loginModelo extends mainModel{

		protected static function iniciar_sesion_modelo($datos){
			$sql= mainModel::conectar()->prepare("SELECT * FROM usuario WHERE EmailUsuario=:Email AND UsuarioClave=:Clave AND UsuarioEstado='Activa'");
			$sql->bindParam(":Email", $datos['Email']);
			$sql->bindParam(":Clave", $datos['Clave']);
			$sql->execute();
			return $sql;
		}

	}