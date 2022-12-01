<?php
if ($lc->encryption($_SESSION['id_sdu'])!=$pagina[1]) {
if ($_SESSION['privilegio_sdu']!=5) {
	echo $lc->forzar_cierre_sesion_controlador();
				exit();
}
}



?>
<div class="full-box page-header">
	<h3 class="text-center">
		ACTUALIZAR USUARIO
	</h3>

</div>
				<?php 
			if ($_SESSION['privilegio_sdu']==5) {
					
				?>
<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="user-new"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO</a>
		</li>
		<li>
			<a href="user-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS</a>
		</li>
		<li>
			<a href="user-search"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR USUARIO</a>
		</li>
	</ul>	
</div>
				<?php 
				}			
				?>
<div class="container-fluid">
	<?php  
	require_once "./Controladores/usuarioControlador.php";
	$ins_usuario= new usuarioControlador();

	$datos_usuario=$ins_usuario->datos_usuario_controlador("Unico", $pagina[1]);

	if ($datos_usuario->rowCount()==1) {
		$campos=$datos_usuario->fetch();
	

	 ?>
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>Ajax/usuarioAjax.php" method="POST" data-form="update" autocomplete="off">
		<input type="hidden" name="usuario_id_up" value="<?php echo $pagina[1];?>">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
			<div class="container-fluid">
				<div class="row">
									
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_nombre" class="bmd-label-floating">Nombres</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_nombre_up" id="usuario_nombre" maxlength="35"  value="<?php echo $campos['NombreUsuario'];?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_apellido" class="bmd-label-floating">Apellidos</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_apellido_up" id="usuario_apellido" maxlength="35" value="<?php echo $campos['ApellidoUsuario'];?>">
						</div>
					</div>		
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<fieldset>
			<legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
			<div class="container-fluid">
				<div class="row">
					
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_email" class="bmd-label-floating">Email</label>
					<input type="email" class="form-control" name="usuario_email_up" id="usuario_email" maxlength="70" value="<?php echo $campos['EmailUsuario'];?>">
						</div>
					</div>
				</div>
			</div>
					<div class="container-fluid">
						<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_clave_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="usuario_clave_1_up" id="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" value="<?php echo $campos['UsuarioClave'];?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_clave_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="usuario_clave_2_up" id="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" value="<?php echo $campos['UsuarioClave'];?>">
						</div>
					</div>
				</div>
			</div>
		</fieldset>
	
		<fieldset>
			<legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						
						<div class="form-group" name="usuario_privilegio_up">
							<select class="form-control" name="usuario_privilegio_up">
								<option value="1"<?php if ($campos['UsuarioPrivilegio']==1) {
								echo 'selected=""';	
								}?>>Gerencia General<?php if ($campos['UsuarioPrivilegio']==1) {
								echo '(Actual)';	
								}?></option>
								<option value="2"<?php if ($campos['UsuarioPrivilegio']==2) {
								echo 'selected=""';	
								}?>>Ventas<?php if ($campos['UsuarioPrivilegio']==2) {
								echo '(Actual)';	
								}?></option>
								<option value="3"<?php if ($campos['UsuarioPrivilegio']==3) {
								echo 'selected=""';	
								}?>>Administracion<?php if ($campos['UsuarioPrivilegio']==3) {
								echo '(Actual)';	
								}?></option>
								<option value="4"<?php if ($campos['UsuarioPrivilegio']==4) {
								echo 'selected=""';	
								}?>>Recursos Humanos<?php if ($campos['UsuarioPrivilegio']==4) {
								echo '(Actual)';	
								}?></option>
									<option value="5"<?php if ($campos['UsuarioPrivilegio']==5) {
								echo 'selected=""';	
								}?>>Informática<?php if ($campos['UsuarioPrivilegio']==5) {
								echo '(Actual)';	
								}?></option>
								</option>
									<option value="6"<?php if ($campos['UsuarioPrivilegio']==6) {
								echo 'selected=""';	
								}?>>Produccion<?php if ($campos['UsuarioPrivilegio']==6) {
								echo '(Actual)';	
								}?></option>

								</option>
									<option value="7"<?php if ($campos['UsuarioPrivilegio']==7) {
								echo 'selected=""';	
								}?>>Almacen<?php if ($campos['UsuarioPrivilegio']==7) {
								echo '(Actual)';	
								}?></option>

								</option>
									<option value="8"<?php if ($campos['UsuarioPrivilegio']==8) {
								echo 'selected=""';	
								}?>>Calidad<?php if ($campos['UsuarioPrivilegio']==8) {
								echo '(Actual)';	
								}?></option>
								</option>
									<option value="9"<?php if ($campos['UsuarioPrivilegio']==9) {
								echo 'selected=""';	
								}?>>Seguridad Laboral<?php if ($campos['UsuarioPrivilegio']==9) {
								echo '(Actual)';	
								}?></option>
							</select>
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
<?php 
}else{
?>
<div class="alert alert-danger text-center" role="alert">
	<p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
	<h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
	<p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
</div>
<?php }?>
</div>