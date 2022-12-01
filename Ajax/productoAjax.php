<?php
	$peticionAjax=true;
	require_once "../Config/APP.php";

	if(isset($_POST['codalmacen_reg'])){

		/*--------- Instancia al controlador ---------*/
		require_once "../Controladores/productoControlador.php";
		$ins_producto = new productoControlador();


		/*--------- Agregar un producto ---------*/
		if(isset($_POST['codalmacen_reg']) && isset($_POST['nombrealmacen_reg'])){
			echo $ins_producto->agregar_producto_controlador();
		}

		
	}else{
		session_start(['name'=>'SDU']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}