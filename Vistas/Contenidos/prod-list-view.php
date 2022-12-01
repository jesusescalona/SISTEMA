<?php 
if ($_SESSION['privilegio_sdu']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
				exit();
}
?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>prod-new"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO PRODUCTOS</a>
		</li>
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>prod-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>prod-search"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTOS</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
<?php 

require_once "./Controladores/productoControlador.php";
$ins_producto = new productoControlador();

echo $ins_producto->paginador_producto_controlador($pagina[1],15,$_SESSION['privilegio_sdu'],$_SESSION['id_sdu'],$pagina[0],"");
?>
</div>