<?php 
if ($_SESSION['privilegio_sdu']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
				exit();
}
?>

<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO DEPARTAMENTO
	</h3>

</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>dep-new"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO DEPARTAMENTO</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>almacen-new"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO ALMACEN</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>dep-new"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-search"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR USUARIO</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>Ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="far fa-address-card"></i> Registro de Departamento</legend>
			<div class="container-fluid">
				<div class="row">
									
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_nombre_reg" id="usuario_nombre" maxlength="35" required="" >
						</div>
					</div>
					
				</div>
			</div>
		</fieldset>

		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>