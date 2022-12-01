<?php

	if($peticionAjax){
		require_once "../Modelos/almacenModelo.php";
	}else{
		require_once "./Modelos/almacenModelo.php";
	}

	class almacenControlador extends almacenModelo{

		/*--------- Controlador agregar almacen ---------*/
		public function agregar_almacen_controlador(){
			$codalmacen=mainModel::limpiar_cadena($_POST['codalmacen_reg']);
			$codubicacion=mainModel::limpiar_cadena($_POST['codubicacion_reg']);
			$nombrealmacen=mainModel::limpiar_cadena($_POST['nombrealmacen_reg']);
			


			/*== comprobar campos vacios ==*/
			if($codalmacen=="" || $codubicacion=="" || $nombrealmacen==""){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No has llenado todos los campos que son obligatorios",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}


			/*== Verificando integridad de los datos ==*/
		

			if(mainModel::verificar_datos("^[a-zA-Z0-9_ ]*$",$codalmacen)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El CODIGO no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

			if(mainModel::verificar_datos("^[a-zA-Z0-9_ ]*$",$codubicacion)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"LA UBICACION no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

		


			if(mainModel::verificar_datos("^[a-zA-Z0-9_ ]*$",$nombrealmacen)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"EL NOMBRE no coinciden con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

		
					

			/*== Comprobando codigo de Almacen ==*/
			if($codalmacen!=""){
				
					$check_codalmacen=mainModel::ejecutar_consulta_simple("SELECT CodAlmacen FROM almacen WHERE CodAlmacen='$codalmacen'");
					if($check_codalmacen->rowCount()>0){
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"El CODIGO DE ALMACEN ingresado ya se encuentra registrado en el sistema",
							"Tipo"=>"error"
						];
						echo json_encode($alerta);
						exit();
					}
				
			}


			/*== Comprobando codigo de Ubicacion ==*/

			if($codubicacion!=""){
				
					$check_codubicacion=mainModel::ejecutar_consulta_simple("SELECT 	CodUbicacion FROM almacen WHERE CodUbicacion='$codubicacion'");
					if($check_codubicacion->rowCount()>0){
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"El CODIGO DE UBICACION ingresado ya se encuentra registrado en el sistema",
							"Tipo"=>"error"
						];
						echo json_encode($alerta);
						exit();
					}
			
			}

				/*== Comprobando Nombre del Almacen ==*/

			if($nombrealmacen!=""){
				
					$check_nombrealmacen=mainModel::ejecutar_consulta_simple("SELECT 	NombreAlmacen FROM almacen WHERE NombreAlmacen='$nombrealmacen'");
					if($check_nombrealmacen->rowCount()>0){
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"El NOMBRE ingresado ya se encuentra registrado en el sistema",
							"Tipo"=>"error"
						];
						echo json_encode($alerta);
						exit();
					}
			
			}

				$datos_almacen_reg=[
				"CodAlmacen"=>$codalmacen,
				"CodUbicacion"=>$codubicacion,
				"NombreAlmacen"=>$nombrealmacen
			];
			
			

			$agregar_almacen=almacenModelo::agregar_almacen_modelo($datos_almacen_reg);

			if($agregar_almacen->rowCount()==1){
				$alerta=[
					"Alerta"=>"limpiar",
					"Titulo"=>"Almacen registrado",
					"Texto"=>"Los datos del Almacen han sido registrados con exito",
					"Tipo"=>"success"
				];
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos podido registrar el Almacen",
					"Tipo"=>"error"
				];
			}
			echo json_encode($alerta);
		} /* Fin controlador */


		public function paginador_almacen_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda){
			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$privilegio=mainModel::limpiar_cadena($privilegio);
			$id=mainModel::limpiar_cadena($id);
			$url=mainModel::limpiar_cadena($url);
			$url=SERVERURL.$url."/";
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";
			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

			if (isset($busqueda) && $busqueda!="") {
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM almacen AND (CodAlmacen LIKE '%$busqueda%' OR CodUbicacion LIKE '%$busqueda%' OR NombreAlmacen LIKE '%$busqueda%')) ORDER BY NombreAlmacen ASC LIMIT $inicio, $registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM almacen ORDER BY NombreAlmacen ASC LIMIT $inicio, $registros";
			}
				
			$conexion = mainModel::conectar();
			$datos=$conexion->query($consulta);
			$datos=$datos->fetchALL();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

			$Npaginas=ceil($total/$registros);

			$tabla.='<div class="table-responsive">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
								<th>#</th>
								<th>CODIGO DE ALMACEN</th>
								<th>CODIGO DE UBICACION</th>
								<th>NOMBRE DEL ALMACEN</th>
								<th>ACTUALIZAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>
						<tbody>';
			if ($total>=1 && $pagina<=$Npaginas) {

				$contador=$inicio+1;
				$reg_inicio=$inicio+1;
				foreach ($datos as $rows) {
					$tabla.='<tr class="text-center" >
					<td>'.$contador.'</td>
					<td>'.$rows['CodAlmacen'].'</td>
					<td>'.$rows['CodUbicacion'].'</td>
					<td>'.$rows['NombreAlmacen'].'</td>
					<td>
						<a href="'.SERVERURL.'user-update/'.mainModel::encryption($rows['IdAlmacen']).'/" class="btn btn-success">
								<i class="fas fa-sync-alt"></i>	
						</a>
					</td>
					<td>
						<form class="FormularioAjax" action="'.SERVERURL.'Ajax/almacenAjax.php" method="POST" data-form="delete" autocomplete="off">
						<input type="hidden" name="IdAlmacen_d" value="'.mainModel::encryption($rows['IdAlmacen']).'">
							<button type="submit" class="btn btn-warning">
									<i class="far fa-trash-alt"></i>
							</button>
						</form>
					</td>
				</tr>';
				$contador++;
				}
				$reg_final=$contador-1;
			}else{
				if ($total>=1) {
					$tabla.='<tr class="text-center"><td colspan="9"><a href="'.$url.'" class= "btn btn-raised btn-primary btn-sm">Haga Clic aca para recargar el listado</a></td><tr>';
				}else{
				$tabla.='<tr class="text-center"><td colspan="9">No hay registro en el Sistema</td><tr>';
			}
		}
						$tabla.='</tbody></table></div>';

			if ($total>=1) {
				$tabla.='<p class="text-right">Mostrando usuario '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
			}

				if ($total>=1 && $pagina<=$Npaginas) {
					$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
				}
						return $tabla;

								}


	}