<?php 
if ($_SESSION['privilegio_sdu']!=5) {
	echo $lc->forzar_cierre_sesion_controlador();
				exit();
}
?>
<div class="full-box page-header">
	<h3 class="text-center">
		LISTA DE USUARIOS
	</h3>

</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>user-new"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO</a>
		</li>
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>user-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-search"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR USUARIO</a>
		</li>
	</ul>	
</div>

 <div class="container-fluid">
<?php 

require_once "./Controladores/usuarioControlador.php";
$ins_usuario = new usuarioControlador();

echo $ins_usuario->paginador_usuario_controlador($pagina[1],15,$_SESSION['privilegio_sdu'],$_SESSION['id_sdu'],$pagina[0],"");
?>
</div>
<script src="<?php echo SERVERURL; ?>Vistas/js/jquery-3.4.1.min.js" ></script>
<script type="text/javascript" src="<?php echo SERVERURL; ?>Vistas/js/listarusuario.js"></script> 