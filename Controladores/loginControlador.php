<?php

	if($peticionAjax){
		require_once "../Modelos/loginModelo.php";
	}else{
		require_once "./Modelos/loginModelo.php";
	}

	class loginControlador extends loginModelo{
		public function iniciar_sesion_controlador(){
			$email=mainModel::limpiar_cadena($_POST['LoginN']);
			$clave=mainModel::limpiar_cadena($_POST['PasswordD']);

			if ($email=="" || $clave=="") {
			echo '<script>
			Swal.fire({
			title:"Ocurrio un error Inesperado",
			text: "No ha llenado los Campos Requeridos",
			type: "error",
			confirmButtonText: "Aceptar"
		});

				</script>';
				exit();
			}
		
			if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$email)){
			echo '<script>
			Swal.fire({
			title:"Ocurrio un error Inesperado",
			text: "EL USUARIO no coincide con el formato",
			type: "error",
			confirmButtonText: "Aceptar"
		});

				</script>';
				exit();
			}

			if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
			echo '<script>
			Swal.fire({
			title:"Ocurrio un error Inesperado",
			text: "LA CLAVE no coincide con el formato",
			type: "error",
			confirmButtonText: "Aceptar"
		});

				</script>';
				exit();
			}


			$clave=mainModel::encryption($clave);
			$datos_login=[
				"Email"=>$email,
				"Clave"=>$clave,
			];
	$datos_cuenta=loginModelo::iniciar_sesion_modelo($datos_login);

	if ($datos_cuenta->rowCount()==1) {
	$row=$datos_cuenta->fetch();
	session_start(['name'=>'SDU']);
	$_SESSION['id_sdu']=$row['IdUsuario'];
	$_SESSION['nombre_sdu']=$row['NombreUsuario'];
	$_SESSION['apellido_sdu']=$row['ApellidoUsuario'];
	$_SESSION['email_sdu']=$row['EmailUsuario'];
	$_SESSION['privilegio_sdu']=$row['UsuarioPrivilegio'];
	$_SESSION['token_sdu']=md5(uniqid(mt_rand(),true));
	return header("Location: ".SERVERURL."home/");
	} else{
			echo '<script>
			Swal.fire({
			title:"Ocurrio un error Inesperado",
			text: "EL USUARIO O CLAVE SON INCORRECTOS",
			type: "error",
			confirmButtonText: "Aceptar"
		});

				</script>';
	}
	}
	public function forzar_cierre_sesion_controlador(){
		session_unset();
		session_destroy();
		if (headers_sent()) {
			return "<script> window.location.href='".SERVERURL."login/';</script>";
		}else{
			return header("Location: ".SERVERURL."login/");
		}
	}
		public function cerrar_sesion_controlador(){
			session_start(['name'=>'SDU']);
			$token=mainModel::decryption($_POST['token']);
			$email=mainModel::decryption($_POST['email']);

			if($token==$_SESSION['token_sdu'] && $email==$_SESSION['email_sdu']){
				session_unset();
				session_destroy();
				$alerta=[
					"Alerta"=>"redireccionar",
					"URL"=>SERVERURL."login/"
				];
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se pudo Cerar Sesion del Sistema",
					"Tipo"=>"error"
				];
			}
			echo json_encode($alerta);
		}
}
