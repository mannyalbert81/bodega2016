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
					
				
					
					$this->view("Movimientos",array(
							
							"resultCon"=>$resultCon, "resultEdit"=>$resultEdit, "resultRol"=>$resultRol,"resultCartones"=>$resultCartones
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
				
				$_array_numero_cartones = $_POST['destino'];
				
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
					"resultado"=>"No tiene Permisos de Guardar Entradas"
		
			));
		
		
		}
		
		
		
	}
	
	public function AutocompleteMovimientos(){
		
		$cartones = new CartonesModel();
		
		$numero_cartones = $_GET['term'];
		
		$resultSet=$cartones->getAll("numero_cartones");
		
		
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
}
?>      