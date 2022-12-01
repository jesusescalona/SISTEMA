<div class="full-box page-header">
				<h2 class="text-center">
					SISTEMA DE INVENTARIO
				</h2>
			</div>
		
			<div class="full-box tile-container">
			<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=7 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=7 ? 'true' : 'false'); ?>"


				>

						<div class="tile-tittle">Almacen</div>
						<div class="tile-icon">
							<i class="fas fa-warehouse fa-fw"></i>
							<span></span>
						</div>
					</a>
				</div>
					<?php 
					
						?>

				<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=6 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=6 ? 'true' : 'false'); ?>"


				>

						<div class="tile-tittle">Producción</div>
						<div class="tile-icon">
							<i class="fas fa-briefcase fa-fw"></i>
							<span></span>
						</div>
					</a>
				</div>
				<?php 
					
						?>
			<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=2 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=2 ? 'true' : 'false'); ?>"


				>

						<div class="tile-tittle">Ventas</div>
						<div class="tile-icon">
							<i class="fas fa-cart-arrow-down fa-fw"></i>
						<span></span>	
						</div>
					</a>
				</div>
				<?php 
					
						?>

					<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=3 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=3 ? 'true' : 'false'); ?>"


				>

						<div class="tile-tittle">Administración</div>
						<div class="tile-icon">
							<i class="fas fa-tasks fa-fw"></i>
						<span></span>
						</div>
					</a>
				</div>
					<?php 
					
						?>
				<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=4 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=4 ? 'true' : 'false'); ?>"


				>

						<div class="tile-tittle">Recursos Humanos</div>
						<div class="tile-icon">
							<i class="fas fa-users fa-fw"></i>
							<span></span>
						</div>
					</a>
				</div>
				<?php 
					
						?>
    
			<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=5 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=5 ? 'true' : 'false'); ?>"


				>
					<div class="tile-tittle">Informática</div>
					<div class="tile-icon">
						<i class="fas fa-laptop fa-fw"></i>
						<span></span>
					</div>
				</a>
			</div>
			<?php 
					
						?>

						
				<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=8 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=8 ? 'true' : 'false'); ?>"


				>
					
					<div class="tile-tittle">Calidad</div>
					<div class="tile-icon">
						<i class="fas fa-tools fa-fw"></i>
						<span></span>
					</div>
				</a>
			</div>
				<?php 
					
						?>

		<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=9 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=9 ? 'true' : 'false'); ?>"


				>

					<div class="tile-tittle">Seguridad Industrial</div>
					<div class="tile-icon">
						<i class="fas fa-user-secret fa-fw"></i>
					<span></span>	
					</div>
				</a>
				</div>
				<?php 
					
						?>


		<?php 
			
				require_once "./Controladores/usuarioControlador.php";
				$ins_usuario= new usuarioControlador();
				$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
					
						?>
				<div class="item" >
				<a href="<?php echo SERVERURL; ?>user-list/" class="tile"  <?php  echo "style='" . ($_SESSION['privilegio_sdu']!=9 ? 'cursor:not-allowed' : '')  ."'" ; ?> 
				data-bloquear="<?php  echo ($_SESSION['privilegio_sdu']!=9 ? 'true' : 'false'); ?>"


				>

					<div class="tile-tittle">Gerencia General</div>
					<div class="tile-icon">
						<i class="fas fa-user-tie fa-fw"></i>
					<span></span>	
					</div>
				</a>
				</div>
				<?php 
					
						?>	
				
