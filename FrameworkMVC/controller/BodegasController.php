<?php

class BodegasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$bodegas= new BodegasModel(); 
		
	   //Conseguimos todos los usuarios
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$entidades = new EntidadesModel();
			$resultEnt = $entidades->getAll("nombre_entidades");
			
			$bodegas= new BodegasModel();
			$columnas = " bodegas.id_bodegas, 
						  bodegas.nombre_bodegas, 
						  entidades.nombre_entidades, 
						  bodegas.creado";
			$tablas   = "public.bodegas, 
  					     public.entidades";
			$where    = "entidades.id_entidades = bodegas.id_entidades";
			$id       = "bodegas.nombre_bodegas";
			
			$resultSet=$bodegas->getCondiciones($columnas ,$tablas ,$where, $id);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Bodegas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $bodegas->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_bodegas"])   )
				{

					$nombre_controladores = "Bodegas";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $bodegas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						
						$bodegas= new BodegasModel();
						
						$_id_bodegas = $_GET["id_bodegas"];
						$columnas_edit= " bodegas.id_bodegas, 
						  bodegas.nombre_bodegas, 
						  entidades.id_entidades";
						$tablas_edit   = "public.bodegas, 
  					    				 public.entidades";
						$where_edit    = "entidades.id_entidades = bodegas.id_entidades AND bodegas.id_bodegas = '$_id_bodegas'";
						$id_edit      = "bodegas.id_bodegas";
						
						$resultEdit = $bodegas->getCondiciones($columnas_edit ,$tablas_edit ,$where_edit, $id_edit);
						
					

						$traza=new TrazasModel();
						$_nombre_controlador = "Bodegas";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_bodegas;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Bodegas"
					
						));
					
					
					}
					
				}
		
				
				$this->view("Bodegas",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEnt"=>$resultEnt
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Bodegas"
				
				));
				
				exit();	
			}
				
		}
		else 
		{
				$this->view("ErrorSesion",array(
						"resultSet"=>""
			
				));
		
		}
	
	}
	
	public function InsertaBodegas(){
			
		session_start();

		
		$bodegas=new BodegasModel();
		$nombre_controladores = "Bodegas";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $bodegas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$bodegas=new BodegasModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_bodegas"]) )
				
			{
				
				
				
				$_nombre_bodegas = $_POST["nombre_bodegas"];
				$_id_entidades = $_POST["id_entidades"];
				
				if(isset($_POST["id_bodegas"])) 
				{
					
					$_id_bodegas = $_POST["id_bodegas"];
					$colval = " nombre_bodegas = '$_nombre_bodegas', id_entidades='$_id_entidades'   ";
					$tabla = "bodegas";
					$where = "id_bodegas = '$_id_bodegas'";
					
					$resultado=$bodegas->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_bodegas";
				
				$parametros = " '$_nombre_bodegas', '$_id_entidades'";
					
				$bodegas->setFuncion($funcion);
		
				$bodegas->setParametros($parametros);
		
		
				$resultado=$bodegas->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Bodegas";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_bodegas;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("Bodegas", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Bodegas"
		
			));
		
		
		}
	
	}




	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Roles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_bodegas"]))
			{
				$id_bodegas=(int)$_GET["id_bodegas"];
				
				$bodegas=new BodegasModel();
				
				$bodegas->deleteBy(" id_bodegas",$id_bodegas);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Bodegas";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_bodegas;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("Bodegas", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Bodegas"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$bodegas=new BodegasModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("Bodegas",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>