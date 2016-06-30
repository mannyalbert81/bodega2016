<?php

class MovimientosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$movimientos_cabeza = new MovimientosCabezaModel();
		
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
					//MOSTRAR SOLO LOS CARTINES AFUERA O POR INGRESAR
					$where = "id_tipo_operaciones = '8' OR id_tipo_operaciones = '1'  ";
					$resultCartones=$cartones->getBy($where);
			
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
		$operaciones = new TipoOperacionesModel();
		$movimientos_cabeza = new MovimientosCabezaModel();
		$movimientos_detalle = new MovimientosDetalleModel();
		$cartones = new CartonesModel();
		
		
		$nombre_controladores = "Movimientos";
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
							$_nombre_controlador = "Movimientos";
							$_accion_trazas  = "Guardar";
							$_parametros_trazas = $_id_cartones;
							$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
								
								
						} catch (Exception $e)
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Insertar Carton en movimietno ->". $id
							));
							exit();
						}
							
					}
					
				} 
				catch (Exception $e) 
				{
				
					
		
				}
				
				
				
				
				$this->redirect("Movimientos", "index");
				
			}
			

			
				
			
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
	
		
}
?>      