<?php
	$peticionAjax=true;
	require_once "../Config/APP.php";

	if(isset($_POST['codalmacen_reg'])){

		/*--------- Instancia al controlador ---------*/
		require_once "../Controladores/almacenControlador.php";
		$ins_almacen = new almacenControlador();


		/*--------- Agregar un almacen ---------*/
		if(isset($_POST['codalmacen_reg']) && isset($_POST['nombrealmacen_reg'])){
			echo $ins_almacen->agregar_almacen_controlador();
		}

		
	}else{
		session_start(['name'=>'SDU']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}