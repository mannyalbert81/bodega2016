<?php

class GenerarSolicitudController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$_id_usuarios= $_SESSION['id_usuarios'];
				
			
		
			$cartones = new CartonesModel();
			$cartones_solicitudes = new CartonesSolicitudesModel();
			
				
			$columnas = " cartones.id_cartones,
					      cartones.numero_cartones,
						  cartones.serie_cartones,
						  cartones.contenido_cartones,
						  cartones.year_cartones,
						  cartones.cantidad_documentos_libros_cartones,
					      tipo_contenido_cartones.id_tipo_contenido_cartones,
						  tipo_contenido_cartones.nombre_tipo_contenido_cartones,
						  cartones.digitalizado_cartones,
					      entidades.id_entidades,
						  entidades.nombre_entidades,
					      bodegas.id_bodegas,
						  bodegas.nombre_bodegas";
			$tablas   = "public.cartones,
						  public.bodegas,
						  public.entidades,
						  public.tipo_contenido_cartones";
			$where    = "bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones";
			$id       = "cartones.numero_cartones";
				
			$resultDatos=$cartones->getCondiciones($columnas ,$tablas ,$where, $id);
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "GenerarSolicitud";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
					$rol = new RolesModel();
					$resultRol=$rol->getAll("nombre_rol");
					
					$controladores=new ControladoresModel();
					$resultCon=$controladores->getAll("nombre_controladores");
					
					$cartones = new CartonesModel();				
					//MOSTRAR SOLO LOS CARTINES AFUERA O POR INGRESAR
					$where = "id_tipo_operaciones = '2' OR id_tipo_operaciones = '6' ";
					$resultCartones=$cartones->getBy($where);
			
					$resultEdit = "";
					
			
					if (isset ($_GET["id_movimientos"])   )
					{
						$nombre_controladores = "GenerarSolicitud";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
							
							
							
							$traza=new TrazasModel();
							$_nombre_controlador = "GenerarSolicitud";
							$_accion_trazas  = "Editar";
							$_parametros_trazas = $_id_asignacion_secretarios;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Generar Solicitud"
						
									
							));
						
							exit();
						}
						
						
						
					}
					
				
					if(isset($_POST["buscar"])){
							
						$criterio_busqueda=$_POST["criterio_busqueda"];
						$contenido_busqueda=$_POST["contenido_busqueda"];
							
						$cartones = new CartonesModel();
							
							
						$columnas = " cartones.id_cartones,
					      cartones.numero_cartones,
						  cartones.serie_cartones,
						  cartones.contenido_cartones,
						  cartones.year_cartones,
						  cartones.cantidad_documentos_libros_cartones,
					      tipo_contenido_cartones.id_tipo_contenido_cartones,
						  tipo_contenido_cartones.nombre_tipo_contenido_cartones,
						  cartones.digitalizado_cartones,
					      entidades.id_entidades,
						  entidades.nombre_entidades,
					      bodegas.id_bodegas,
						  bodegas.nombre_bodegas";
						$tablas   = "public.cartones,
						  public.bodegas,
						  public.entidades,
						  public.tipo_contenido_cartones";
						$where    = "bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones";
						$id       = "cartones.numero_cartones";
							
							
							
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
						$where_5 = "";
						$where_6 = "";
						$where_7 = "";
						$where_8 = "";
						$where_9 = "";
							
						switch ($criterio_busqueda) {
							case 0:
								$where_0 = " ";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  cartones.numero_cartones LIKE '$contenido_busqueda'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND cartones.serie_cartones LIKE '$contenido_busqueda'  ";
								break;
					
							case 3:
								//Nombre Cliente/Proveedor
								$where_3 = " AND cartones.contenido_cartones LIKE '$contenido_busqueda'  ";
								break;
					
							case 4:
								//Nombre Cliente/Proveedor
								$where_4 = " AND cartones.year_cartones LIKE '$contenido_busqueda'  ";
								break;
					
							case 5:
								//Nombre Cliente/Proveedor
								$where_5 = " AND cartones.cantidad_documentos_libros_cartones LIKE '$contenido_busqueda'  ";
								break;
					
					
							case 6:
								//Nombre Cliente/Proveedor
								$where_6 = " AND tipo_contenido_cartones.nombre_tipo_contenido_cartones LIKE '$contenido_busqueda'  ";
								break;
					
							case 7:
								//Nombre Cliente/Proveedor
								$where_7 = " AND cartones.digitalizado_cartones = '$contenido_busqueda'  ";
								break;
					
					
							case 8:
								//Nombre Cliente/Proveedor
								$where_8 = " AND entidades.nombre_entidades LIKE '$contenido_busqueda'  ";
								break;
					
							case 9:
								//Nombre Cliente/Proveedor
								$where_9 = " AND bodegas.nombre_bodegas LIKE '$contenido_busqueda'  ";
								break;
									
									
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3 . $where_4 . $where_5 . $where_6 . $where_7 . $where_8 . $where_9;
					
					
						$resultDatos=$cartones->getCondiciones($columnas ,$tablas ,$where_to, $id);
							
					
							
					}
					
					
					
					///botones agregar y guardar
					
					if (isset ($_GET["id_cartones_agregar"])   )
					{
						$_id_cartones= $_GET["id_cartones_agregar"];
						
						$funcion = "ins_cartones_solicitudes";
						$parametros = "'$_id_usuarios','$_id_cartones'      ";
						$cartones_solicitudes->setFuncion($funcion);
						$cartones_solicitudes->setParametros($parametros);
						$resultado=$cartones_solicitudes->Insert();
								
					}
					if (isset ($_GET["id_cartones_eliminar"])   )
					{
						$_id_usuarios= $_SESSION['id_usuarios'];
						$_id_cartones= $_GET["id_cartones_eliminar"];
					
						$where = "id_usuarios = '$_id_usuarios' AND id_cartones = '$_id_cartones'  ";
						$resultado = $cartones_solicitudes->deleteByWhere($where);
					}
					
					
					////lo solicitdo
					
					$columnas_sol = " cartones.id_cartones,
					      cartones.numero_cartones,
						  cartones.serie_cartones,
						  cartones.contenido_cartones,
						  cartones.year_cartones,
						  cartones.cantidad_documentos_libros_cartones,
					      tipo_contenido_cartones.id_tipo_contenido_cartones,
						  tipo_contenido_cartones.nombre_tipo_contenido_cartones,
						  cartones.digitalizado_cartones,
					      entidades.id_entidades,
						  entidades.nombre_entidades,
					      bodegas.id_bodegas,
						  bodegas.nombre_bodegas";
					$tablas_sol   = "public.cartones, public.cartones_solicitudes ,
						  public.bodegas,
						  public.entidades,
						  public.tipo_contenido_cartones";
					$where_sol    = "bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND cartones.id_cartones = cartones_solicitudes.id_cartones AND cartones_solicitudes.id_usuarios = '$_id_usuarios'  ";
					$id_sol       = "cartones.numero_cartones";
					
					
					$resultSol = $cartones_solicitudes->getCondiciones($columnas_sol, $tablas_sol, $where_sol, $id_sol);
					
					
					$this->view("GenerarSolicitud",array(
							
							"resultSol"=>$resultSol, "resultDatos"=>$resultDatos
					));
			
			
			}
			
			
		}
		else
		{
	
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
						));
		}
	
	}
	 
	
	public function InsertaGenerarSolicitud(){

		session_start();
		
		$resultado = null;
		$permisos_rol=new PermisosRolesModel();
		$operaciones = new TipoOperacionesModel();
		$movimientos_cabeza = new MovimientosCabezaModel();
		$movimientos_detalle = new MovimientosDetalleModel();
		$cartones = new CartonesModel();
		
		
		$nombre_controladores = "GenerarSolicitud";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $movimientos_cabeza->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		
		
		
		if (!empty($resultPer))
		{
			

			if (isset ($_POST["Guardar"])   )
			{
				
				$_array_numero_cartones = $_POST['destino'];
				
				$resultOperaciones = $operaciones->getBy("nombre_tipo_operaciones LIKE '%ENTRADAS%' ");
				
				$_id_tipo_operaciones=$resultOperaciones[0]->id_tipo_operaciones;
				$_numero_movimientos=$resultOperaciones[0]->consecutivo;
				$_cantidad_cartones_movimientos_cabeza = $_POST['total_cartones'];
				$_id_usuario_creador=$_SESSION['id_usuarios'];
				$_id_usuario_solicita=$_id_usuario_creador;
				$_observaciones_movimientos_cabeza = $_POST['observaciones'];
				
				
				///PRIMERO INSERTAMOS LA CABEZA DEL MOVIMIENTO
				try 
				{
					
					$funcion = "ins_movimientos_cabeza";
					$parametros = "'$_numero_movimientos','$_id_tipo_operaciones', '$_id_usuario_creador','$_id_usuario_solicita','$_observaciones_movimientos_cabeza' ,'$_cantidad_cartones_movimientos_cabeza'        ";
					$movimientos_cabeza->setFuncion($funcion);
					$movimientos_cabeza->setParametros($parametros);
					$resultado=$movimientos_cabeza->Insert();
					$resultConsecutivo=$operaciones->UpdateBy("consecutivo=consecutivo+1", "tipo_operaciones", "id_tipo_operaciones='$_id_tipo_operaciones'");
				
					

					///INSERTAMOS DETALLE  DEL MOVIMIENTO
					foreach($_array_numero_cartones as $id  )
					{
							
						//busco si existe este nuevo id
						try
						{
							$_id_cartones = $id;
							$funcion = "ins_movimientos_detalle";
							$parametros = "'$_numero_movimientos','$_id_tipo_operaciones', '$_id_cartones' ";
							$movimientos_detalle->setFuncion($funcion);
							$movimientos_detalle->setParametros($parametros);
							$resultado=$movimientos_detalle->Insert();
								
							
							 ///TRABAJAMOS EL estado DEL CQRTON
							 $colval="id_tipo_operaciones = '$_id_tipo_operaciones'";
							 $tabla="cartones";
							 $where="id_cartones = '$_id_cartones' ";
							 $resultado=$cartones->UpdateBy($colval, $tabla, $where);
									
							
							///LAS TRAZAS
							$traza=new TrazasModel();
							$_nombre_controlador = "GenerarSolicitud";
							$_accion_trazas  = "Guardar";
							$_parametros_trazas = $_id_cartones;
							$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
								
								
						} catch (Exception $e)
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Insertar Generar Solicitud ->". $id
							));
							exit();
						}
							
					}
					
				} 
				catch (Exception $e) 
				{
				
					
		
				}
				
				
				
				
				$this->redirect("GenerarSolicitud", "index");
				
			}
			

			
				
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Guardar GenerarSolicitud"
		
			));
		
		
		}
		
		
		
	}
	
	public function AutocompleteMovimientos(){
		
		$cartones = new CartonesModel();
		
		$numero_cartones = $_GET['term'];
		
		$resultSet=$cartones->getBy("numero_cartones LIKE '$numero_cartones%'");
		
		
		if(!empty($resultSet)){
			
			foreach ($resultSet as $res){
				
				$_numero_cartones[] = $res->numero_cartones;
			}
			echo json_encode($_numero_cartones);
		}
		
	}
	
	

	
	public function AutocompleteMovimientosId(){
	
		$cartones = new CartonesModel();
	
		$numero_carton = $_POST['numero_carton'];
	
		$resultSet=$cartones->getBy("numero_cartones='$numero_carton'");
		
		$respuesta = new stdClass();
	
		if(!empty($resultSet)){
			
				$respuesta->id_cartones = $resultSet[0]->id_cartones;
			
			echo json_encode($respuesta);
		}
	
	}
	
	public function buscarCartones()
	{
		$dato = $_POST['dato'];
		
		$cartones = new CartonesModel();
		
		$columnas = " cartones.id_cartones,
					      cartones.numero_cartones,
						  cartones.serie_cartones,
						  cartones.contenido_cartones,
						  cartones.year_cartones,
						  cartones.cantidad_documentos_libros_cartones,
					      tipo_contenido_cartones.id_tipo_contenido_cartones,
						  tipo_contenido_cartones.nombre_tipo_contenido_cartones,
						  cartones.digitalizado_cartones,
					      entidades.id_entidades,
						  entidades.nombre_entidades,
					      bodegas.id_bodegas,
						  bodegas.nombre_bodegas";
		$tablas   = "public.cartones,
						  public.bodegas,
						  public.entidades,
						  public.tipo_contenido_cartones";
		$where    = "bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones 
				      AND numero_cartones LIKE '%$dato%' ";
		
		$id       = "cartones.numero_cartones";
		
		$resultCartones=$cartones->getCondiciones($columnas ,$tablas ,$where, $id);
		

		
		echo '<section   class="col-lg-5 usuario"   style="height:300px; overflow-y:scroll;     ">
				<table  class="tablaBBDD" >
	         <tr  class="fila">
	        	<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Numero de Cartones</th>
	    		<th style="color:#456789;font-size:80%;">Serie de Cartones</th>
	    		<th style="color:#456789;font-size:80%;">Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Años</th>
	    		<th style="color:#456789;font-size:80%;">Cantidad de Documentos</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Digitalizado</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Entidades</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Bodegas</th>
	    		
	    		
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>';
		
		if(!empty($resultCartones)){
			foreach ($resultCartones as $res){
				echo '<tr class="fila">
	        		
	                   <td style="color:#000000;font-size:80%;">'.$res->id_cartones.'</td>
		               <td style="color:#000000;font-size:80%;">'.$res->numero_cartones.'</td> 
		               <td style="color:#000000;font-size:80%;">'. $res->serie_cartones.'</td>
		               <td style="color:#000000;font-size:80%;">'. $res->contenido_cartones.'</td>
		                <td style="color:#000000;font-size:80%;">'. $res->year_cartones.'</td>
		                 <td style="color:#000000;font-size:80%;">'. $res->cantidad_documentos_libros_cartones  .'</td>
		                 <td style="color:#000000;font-size:80%;">'. $res->nombre_tipo_contenido_cartones  .'</td>
		                  <td style="color:#000000;font-size:80%;">'. $res->digitalizado_cartones  .'</td>
		                    <td style="color:#000000;font-size:80%;">'. $res->nombre_entidades  .'</td>
		                    <td style="color:#000000;font-size:80%;">'. $res->nombre_bodegas  .'</td>
		           	   <td>
			           		
			                <hr/>
		               </td>
		    		</tr>';
			}
		}else{
			echo '<tr>
				<td colspan="6">No existen Resultados</td>
			</tr>';
		}
		echo '</table> </section>';
	}
}
?>      