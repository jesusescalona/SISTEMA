<?php

if ($peticionAjax) {
	require_once "../Modelos/usuarioModelo.php";
} else {
	require_once "./Modelos/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{

	/*--------- Controlador agregar usuario ---------*/
	public function agregar_usuario_controlador()
	{
		$nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_reg']);
		$apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_reg']);
		$email = mainModel::limpiar_cadena($_POST['usuario_email_reg']);
		$clave1 = mainModel::limpiar_cadena($_POST['usuario_clave_1_reg']);
		$clave2 = mainModel::limpiar_cadena($_POST['usuario_clave_2_reg']);
		$privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_reg']);


		/*== comprobar campos vacios ==*/
		if ($nombre == "" || $apellido == "" || $clave1 == "" || $clave2 == "") {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		}


		/*== Verificando integridad de los datos ==*/


		if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $nombre)) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "El NOMBRE no coincide con el formato solicitado",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $apellido)) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "El APELLIDO no coincide con el formato solicitado",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		}


		if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave1) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave2)) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "Las CLAVES no coinciden con el formato solicitado",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		}


		/*== Comprobando email ==*/
		if ($email != "") {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$check_email = mainModel::ejecutar_consulta_simple("SELECT EmailUsuario FROM usuario WHERE EmailUsuario='$email'");
				if ($check_email->rowCount() > 0) {
					$alerta = [
						"Alerta" => "simple",
						"Titulo" => "Ocurrió un error inesperado",
						"Texto" => "El EMAIL ingresado ya se encuentra registrado en el sistema",
						"Tipo" => "error"
					];
					echo json_encode($alerta);
					exit();
				}
			} else {
				$alerta = [
					"Alerta" => "simple",
					"Titulo" => "Ocurrió un error inesperado",
					"Texto" => "Ha ingresado un correo no valido",
					"Tipo" => "error"
				];
				echo json_encode($alerta);
				exit();
			}
		}


		/*== Comprobando claves ==*/
		if ($clave1 != $clave2) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "Las claves que acaba de ingresar no coinciden",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		} else {
			$clave = mainModel::encryption($clave1);
		}

		/*== Comprobando privilegio ==*/
		if ($privilegio < 1 || $privilegio > 9) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "El privilegio seleccionado no es valido",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		}

		$datos_usuario_reg = [
			"Nombre" => $nombre,
			"Apellido" => $apellido,
			"Email" => $email,
			"Clave" => $clave,
			"Estado" => "Activa",
			"Privilegio" => $privilegio
		];

		$agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);

		if ($agregar_usuario->rowCount() == 1) {
			$alerta = [
				"Alerta" => "limpiar",
				"Titulo" => "usuario registrado",
				"Texto" => "Los datos del usuario han sido registrados con exito",
				"Tipo" => "success"
			];
		} else {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos podido registrar el usuario",
				"Tipo" => "error"
			];
		}
		echo json_encode($alerta);
	} /* Fin agregar usuario controlador */


	public function paginador_usuario_controlador($pagina, $registros, $privilegio, $id, $url, $busqueda)
	{
		$pagina = mainModel::limpiar_cadena($pagina);
		$registros = mainModel::limpiar_cadena($registros);
		$privilegio = mainModel::limpiar_cadena($privilegio);
		$id = mainModel::limpiar_cadena($id);
		$url = mainModel::limpiar_cadena($url);
		$url = SERVERURL . $url . "/";
		$busqueda = mainModel::limpiar_cadena($busqueda);
		$tabla = "";
		$pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
		$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

		if (isset($busqueda) && $busqueda != "") {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario AND (NombreUsuario LIKE '%$busqueda%' OR ApellidoUsuario LIKE '%$busqueda%' OR EmailUsuario LIKE '%$busqueda%')) ORDER BY NombreUsuario ASC LIMIT $inicio, $registros";
		} else {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario ORDER BY NombreUsuario ASC LIMIT $inicio, $registros";
		}

		$conexion = mainModel::conectar();
		$datos = $conexion->query($consulta);
		$datos = $datos->fetchALL();

		$total = $conexion->query("SELECT FOUND_ROWS()");
		$total = (int) $total->fetchColumn();

		$Npaginas = ceil($total / $registros);

		$tabla .= '<div class="table-responsive">
					<table id="listausuario" class="table">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>EMAIL</th>
								<th>ACTUALIZAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>';
		if ($total >= 1 && $pagina <= $Npaginas) {

			$contador = $inicio + 1;
			$reg_inicio = $inicio + 1;
			foreach ($datos as $rows) {
				$tabla .= '<tr class="text-center" >
					<td>' . $contador . '</td>
					<td>' . $rows['NombreUsuario'] . '</td>
					<td>' . $rows['ApellidoUsuario'] . '</td>
					<td>' . $rows['EmailUsuario'] . '</td>
					<td>
						<a href="' . SERVERURL . 'user-update/' . mainModel::encryption($rows['IdUsuario']) . '/" class="btn btn-success">
								<i class="fas fa-sync-alt"></i>	
						</a>
					</td>
					<td>
						<form class="FormularioAjax" action="' . SERVERURL . 'Ajax/usuarioAjax.php" method="POST" data-form="delete" autocomplete="off">
						<input type="hidden" name="IdUsuario_d" value="' . mainModel::encryption($rows['IdUsuario']) . '">
							<button type="submit" class="btn btn-warning">
									<i class="far fa-trash-alt"></i>
							</button>
						</form>
					</td>
				</tr>';
				$contador++;
			}
			$reg_final = $contador - 1;
		} else {
			if ($total >= 1) {
				$tabla .= '<tr class="text-center"><td colspan="9"><a href="' . $url . '" class= "btn btn-raised btn-primary btn-sm">Haga Clic aca para recargar el listado</a></td><tr>';
			} else {

				$tabla .= '<tr class="text-center"><td colspan="9">No hay registro en el Sistema</td><tr>';
			}
		}
		$tabla .= '</tbody></table></div>';

		/*if ($total>=1 && $pagina<=$Npaginas){
		$tabla.='<p class="text-right">Mostrando usuario '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
		$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
		}*/
		return $tabla;
	}

	public function eliminar_usuario_controlador()
	{
		$id = mainModel::decryption($_POST['IdUsuario_d']);
		$id = mainModel::limpiar_cadena($id);

		if ($id == 1) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No podemos eliminar el usuario principal del sistema",
				"Tipo" => "error"
			];

			echo json_encode($alerta);
			exit();
		}

		$chek_usuario = mainModel::ejecutar_consulta_simple("SELECT IdUsuario FROM usuario WHERE IdUsuario='$id'");
		if ($chek_usuario->rowCount() <= 0) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "El Usuario que intenta eliminar no existe en el sistema",
				"Tipo" => "error"
			];

			echo json_encode($alerta);
			exit();
		}


		$eliminar_usuario = usuarioModelo::eliminar_usuario_modelo($id);
		if ($eliminar_usuario->rowCount() == 1) {
			$alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Usuario Eliminado",
				"Texto" => "El Usuario ha sido Eliminado del sistema",
				"Tipo" => "success"
			];
		} else {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos podido eliminar al usuario, por favor intente nuevamente",
				"Tipo" => "error"
			];
		}
		echo json_encode($alerta);


	} /*Fin function eliminar usuario */

	public function datos_usuario_controlador($tipo, $id)
	{
		$tipo = mainModel::limpiar_cadena($tipo);

		$id = mainModel::decryption($id);
		$id = mainModel::limpiar_cadena($id);

		return usuarioModelo::datos_usuario_modelo($tipo, $id);
	}

	public function actualizar_usuario_controlador()
	{

		$id = mainModel::decryption($_POST['usuario_id_up']);
		$id = mainModel::limpiar_cadena($id);

		$chek_usuario = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE IdUsuario='$id'");
		if ($chek_usuario->rowCount() <= 0) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos encontrado el usuario en el sistema",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		} else {
			$campos = $chek_usuario->fetch();
		}
		$nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_up']);
		$apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_up']);
		$email = mainModel::limpiar_cadena($_POST['usuario_email_up']);
		$clave1 = mainModel::limpiar_cadena($_POST['usuario_clave_1_up']);
		$clave2 = mainModel::limpiar_cadena($_POST['usuario_clave_2_up']);
		$privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_up']);

		if (isset($_POST['usuario_estado_up'])) {
			// code...
		}

	}

} /*final del Controlador*/