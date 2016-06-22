<?php

class MovimientosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$movimientos = new MovimientosModel();
		
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Movimientos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
					$rol = new RolesModel();
					$resultRol=$rol->getAll("nombre_rol");
					
					$controladores=new ControladoresModel();
					$resultCon=$controladores->getAll("nombre_controladores");
					
					$cartones = new CartonesModel();					
					$resultCartones=$cartones->getAll("id_cartones");
			
			
					
					$resultEdit = "";
					
			
					if (isset ($_GET["id_movimientos"])   )
					{
						$nombre_controladores = "Movimientos";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
							
							
							
							$traza=new TrazasModel();
							$_nombre_controlador = "Movimientos";
							$_accion_trazas  = "Editar";
							$_parametros_trazas = $_id_asignacion_secretarios;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Movimientos"
						
									
							));
						
							exit();
						}
						
						
						
					}
					
					if(isset($_POST["buscar"])){
					
						$criterio_busqueda=$_POST["criterio_busqueda"];
						$contenido_busqueda=$_POST["contenido_busqueda"];
					
						$cartones = new CartonesModel();
						$tipo_contenido_cartones = new TipoContenidoCartonesModel();
							
						$columnas = " cartones.id_cartones,
						  cartones.numero_cartones,
						  cartones.serie_cartones,
						  cartones.contenido_cartones,
						  cartones.year_cartones,
						  cartones.cantidad_documentos_libros_cartones,
						  tipo_contenido_cartones.nombre_contenido_cartones,
						  cartones.digitalizado_cartones,
						  entidades.nombre_entidades,
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
								$where_6 = " AND tipo_contenido_cartones.nombre_contenido_cartones LIKE '$contenido_busqueda'  ";
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
						
							
						$resultSet=$cartones->getCondiciones($columnas ,$tablas ,$where_to, $id);
						/*$this->view("Error",array(
								"resultado"=>$columnas.$tablas .$where_to. $id
					
						));
						
						exit();*/
					
							
					}
					
					
			
					
					
					
					
					$this->view("Movimientos",array(
							
							"resultCon"=>$resultCon, "resultEdit"=>$resultEdit, "resultRol"=>$resultRol,"resultCartones"=>$resultCartones
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Movimientos"
			
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
	 
	
	public function InsertaMovimientos(){

		session_start();
		
		$resultado = null;
		$permisos_rol=new PermisosRolesModel();
		$movimientos = new MovimientosModel();
	    $nombre_controladores = "Movimientos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $movimientos->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			

			if (isset ($_POST["Guardar"])   )
			{
				
				$_array_numero_cartones = $_POST['lista_carton'];
				
				$_observaciones = $_POST['observaciones'];
				
				$_numero_movimientos=$_POST['total_cartones'];
				
				$operaciones = new TipoOperacionesModel();
				
				$resultOperaciones = $operaciones->getBy("nombre_tipo_operaciones LIKE 'ENTRADAS%' ");
				
				$id_tipo_operacion=$resultOperaciones[0]->id_tipo_operaciones;
				$consecutivo=$resultOperaciones[0]->consecutivo;
				
				
				foreach($_array_numero_cartones as $id  )
				{					
					
						if (!empty($id) )
					    {
					    		
						//busco si existe este nuevo id
						try 
						{
							//parametrso _numero_movimientos integer, _id_tipo_operaciones integer, _id_cartones integer, _id_usuario_creador integer, _id_usuario_solicita integer, _observaciones_movimientos character varying
							$_id_cartones = $id;
							$_id_usuario_creador=$_SESSION['id_usuarios'];
							$_id_usuario_solicita=$_id_usuario_creador;
							
							$movimientos = new MovimientosModel();
							
							$funcion = "ins_movimientos";
							$parametros = "'$_numero_movimientos','$id_tipo_operacion', '$_id_cartones','$_id_usuario_creador','$_id_usuario_solicita','$_observaciones'";
							
							
							$movimientos->setFuncion($funcion);
							$movimientos->setParametros($parametros);
							$resultado=$movimientos->Insert();
							
							$resultConsecutivo=$operaciones->UpdateBy("consecutivo=consecutivo+1", "tipo_operaciones", "id_tipo_operaciones='$id_tipo_operacion'");
							
							/*if(empty($resultado)){
								
								$this->view("Error",array(
										"resultado"=>"no hay datso ->". $id
								));
							}*/
							
							
							/*
							$controlador="AprobacionAutoPago";
							$tipo_notificacion = new TipoNotificacionModel();
							$resul_tipo_notificacion=$tipo_notificacion->getBy("controlador_tipo_notificacion='$controlador'");
							
							
							//inserta las notificacion
							$notificaciones = new NotificacionesModel();							
							$id_tipo_notificacion=$resul_tipo_notificacion[0]->id_tipo_notificacion;
							
							//dirigir notificacion
							$id_impulsor=$_SESSION['id_usuarios'];
							$asignacion_secreatario= new AsignacionSecretariosModel();
							$result_asg_secretario=$asignacion_secreatario->getBy("id_abogado_asignacion_secretarios='$id_impulsor'");
							$id_usuarios_dirigido_notificacion=$result_asg_secretario[0]->id_secretario_asignacion_secretarios;
							
							//descripcion de notificacion
							$descripcion_notificaciones="Auto Pago Pendiente del titulo de credito (".$_id_titulo_credito.") ";
							
							$result_notificaciones=$notificaciones->InsertaNotificaciones($id_tipo_notificacion, $id_usuarios_dirigido_notificacion, $descripcion_notificaciones);
							*/
										
						} catch (Exception $e) 
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Asignar ->". $id
							));
						}
							
					}
					 
				}
				$traza=new TrazasModel();
				$_nombre_controlador = "Movimientos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_cartones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
		
				
			}
			

			$this->redirect("Movimientos", "index");
				
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Guardar Movimientos"
		
			));
		
		
		}
		
		
		
	}
	
	public function borrarId()
	{
		$permisos_rol = new PermisosRolesModel();

		session_start();
		
		$nombre_controladores = "AsignacionTituloCredito";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosBorrar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			if(isset($_GET["id_asignacion_secretarios"]))
			{
				$id_asigancionSecretarios=(int)$_GET["id_asignacion_secretarios"];
		
				$asignacionSecretario=new AsignacionSecretariosModel();
			
				$asignacionSecretario->deleteBy(" id_asignacion_secretarios",$id_asigancionSecretarios);
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Movimientos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_asigancionSecretarios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			
			$this->redirect("Movimientos", "index");
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Borrar Movimientos"
		
			));
		
		
		}
		
	}
	
	
}
?>      