<?php
	
	require_once "mainModel.php";

	class usuarioModelo extends mainModel{

		/*--------- Modelo agregar usuario ---------*/
		protected static function agregar_usuario_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO usuario(NombreUsuario,ApellidoUsuario,EmailUsuario,UsuarioClave,UsuarioEstado,UsuarioPrivilegio) VALUES(:Nombre,:Apellido,:Email,:Clave,:Estado,:Privilegio)");

			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Apellido",$datos['Apellido']);
			$sql->bindParam(":Email",$datos['Email']);
			$sql->bindParam(":Clave",$datos['Clave']);
			$sql->bindParam(":Estado",$datos['Estado']);
			$sql->bindParam(":Privilegio",$datos['Privilegio']);
			$sql->execute();

			return $sql;
		}

		protected static function eliminar_usuario_modelo($id){
			$sql=mainModel::conectar()->prepare("DELETE FROM usuario WHERE IdUsuario=:ID");
			$sql->bindParam(":ID", $id);
			$sql->execute();
			return $sql;
		}

		protected static function datos_usuario_modelo($tipo,$id){

			if ($tipo=="Unico"){
				$sql=mainModel::conectar()->prepare("SELECT * FROM usuario WHERE IdUsuario=:ID");
				$sql->bindParam(":ID",$id);
			}elseif($tipo=="Conteo"){
			$sql=mainModel::conectar()->prepare("SELECT IdUsuario FROM usuario");
			}
			$sql->execute();
			return $sql;

		}
		

		protected static function actualizar_usuario_modelo($datos){
			$sql=mainModel::conectar()->prepare("UPDATE usuario SET NombreUsuario=:Nombre, 	ApellidoUsuario=:Apellido, EmailUsuario=:Email, UsuarioClave=:Clave, UsuarioEstado=:Estado, UsuarioPrivilegio=:Privilegio WHERE IdUsuario=:ID");
			$sql->bindParam(":Nombre", $datos['Nombre']);
			$sql->bindParam(":Apellido", $datos['Apellido']);
			$sql->bindParam(":Email", $datos['Email']);
			$sql->bindParam(":Clave", $datos['Clave']);
			$sql->bindParam(":Estado", $datos['Estado']);
			$sql->bindParam(":Privilegio", $datos['Privilegio']);
			$sql->bindParam(":ID", $datos['ID']);
			$sql->execute();
			return $sql;
			
		}

	}