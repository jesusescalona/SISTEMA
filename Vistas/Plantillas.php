<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY; ?></title>
	<?php include "Inc/Link.php"; ?>
</head>
<body>
	
<?php 
$peticionAjax=false;
require_once "./Controladores/vistasControlador.php";
$IV =new vistasControlador();
$vistas=$IV->obtener_vistas_controlador();
if ($vistas=="login" || $vistas=="404") {
	require_once "./Vistas/Contenidos/".$vistas."-view.php";
}else{
			session_start(['name'=>'SDU']);
			$pagina=explode("/", $_GET['views']);
			require_once "./Controladores/loginControlador.php";
			$lc = new loginControlador();
			if (!isset($_SESSION['token_sdu']) || !isset($_SESSION['nombre_sdu']) || !isset($_SESSION['privilegio_sdu'])|| !isset($_SESSION['id_sdu'])|| !isset($_SESSION['email_sdu'])) {
				echo $lc->forzar_cierre_sesion_controlador();
				exit();
				
			}

?>
	<!-- Main container -->
	<main class="full-box main-container">
		<!-- Nav lateral -->
		<?php include "Inc/navLateral.php"; ?>
	

		<!-- Page content -->
		<section class="full-box page-content">
			
          <?php 
          include "Inc/navBar.php"; 

          include $vistas;

          ?>	

		</section>
		<!-- Page f -->
		<section class="">        
		
		 <?php include "Inc/PiedePagina.php";?>

		</section>


	</main>
	
		<?php
		include "Inc/loOut.php";
         }
		 include "Inc/Script.php"; 

		 ?>
</body>

</html>