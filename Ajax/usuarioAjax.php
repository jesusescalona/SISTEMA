<?php
$peticionAjax = true;
require_once "../Config/APP.php";

if (isset($_POST['usuario_email_reg']) || isset($_POST['IdUsuario_d']) || isset($_POST['usuario_id_up'])) {

	/*--------- Instancia al controlador ---------*/
	require_once "../Controladores/usuarioControlador.php";
	$ins_usuario = new usuarioControlador();


	/*--------- Agregar un usuario ---------*/
	if (isset($_POST['usuario_email_reg']) && isset($_POST['usuario_nombre_reg'])) {
		echo $ins_usuario->agregar_usuario_controlador();
	}
	/*--------- Eliminar un usuario ---------*/
	if (isset($_POST['IdUsuario_d'])) {
		echo $ins_usuario->eliminar_usuario_controlador();
	}

	/*--------- Actualizar un usuario ---------*/
	if (isset($_POST['usuario_id_up'])) {
		echo $ins_usuario->actualizar_usuario_controlador();
	}

} else {
	session_start(['name' => 'SDU']);
	session_unset();
	session_destroy();
	header("Location: " . SERVERURL . "login/");
	exit();
}