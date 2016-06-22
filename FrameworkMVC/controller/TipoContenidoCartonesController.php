<?php

class TipoContenidoCartonesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipo_contenido_cartones= new TipoContenidoCartonesModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_contenido_cartones->getAll("id_tipo_contenido_cartones");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TipoContenidoCartones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_contenido_cartones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_contenido_cartones"])   )
				{

					$nombre_controladores = "TipoContenidoCartones";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_contenido_cartones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_contenido_cartones = $_GET["id_tipo_contenido_cartones"];
						$columnas = " id_tipo_contenido_cartones, nombre_tipo_contenido_cartones";
						$tablas   = "tipo_contenido_cartones";
						$where    = "id_tipo_contenido_cartones = '$_id_tipo_contenido_cartones' "; 
						$id       = "nombre_tipo_contenido_cartones";
							
						$resultEdit = $tipo_contenido_cartones->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo Contenido Cartones";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_contenido_cartones;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos Contenidos Cartones"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoContenidoCartones",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Contenido de Cartones"
				
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
	
	public function InsertaTipoContenidoCartones(){
			
		session_start();

		
		$tipo_contenido_cartones=new TipoContenidoCartonesModel();
		$nombre_controladores = "TipoContenidoCartones";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_contenido_cartones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_contenido_cartones=new TipoContenidoCartonesModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_contenido_cartones"]) )
				
			{
				
				
				
				$_nombre_tipo_contenido_cartones = $_POST["nombre_tipo_contenido_cartones"];
				
				if(isset($_POST["id_tipo_contenido_cartones"])) 
				{
					
					$_id_tipo_contenido_cartones = $_POST["id_tipo_contenido_cartones"];
					$colval = " nombre_tipo_contenido_cartones = '$_nombre_tipo_contenido_cartones'   ";
					$tabla = "tipo_contenido_cartones";
					$where = "id_tipo_contenido_cartones = '$_id_tipo_contenido_cartones'    ";
					
					$resultado=$tipo_contenido_cartones->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_contenido_cartones";
				
				$parametros = " '$_nombre_tipo_contenido_cartones'  ";
					
				$tipo_contenido_cartones->setFuncion($funcion);
		
				$tipo_contenido_cartones->setParametros($parametros);
		
		
				$resultado=$tipo_contenido_cartones->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Contenido Cartones";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_contenido_cartones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("tipo_contenido_cartones", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Contenidos Cartones"
		
			));
		
		
		}
	

		$tipo_contenido_cartones=new TipoContenidoCartonesModel();

		$nombre_controladores = "TipoContenidoCartones";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_contenido_cartones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_contenido_cartones=new TipoContenidoCartonesModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_contenido_cartones"]) )
				
			{
				$_nombre_tipo_contenido_cartones = $_POST["nombre_tipo_contenido_cartones"];
				
				if(isset($_POST["id_tipo_contenido_cartones"]))
				{
				$_id_tipo_contenido_cartones = $_POST["id_tipo_contenido_cartones"];
				$colval = " nombre_tipo_contenido_cartones = '$_nombre_tipo_contenido_cartones'   ";
				$tabla = "tipo_contenido_cartones";
				$where = "id_tipo_contenido_cartones = '$_id_tipo_contenido_cartones'    ";
					
				$resultado=$tipo_contenido_cartones->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_contenido_cartones";
				
				$parametros = " '$_nombre_tipo_contenido_cartones'  ";
					
				$tipo_contenido_cartones->setFuncion($funcion);
		
				$tipo_contenido_cartones->setParametros($parametros);
		
		
				$resultado=$tipo_contenido_cartones->Insert();
			 }
		
			}
			$this->redirect("TipoContenidoCartones", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de contenido de cartones"
		
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
			if(isset($_GET["id_tipo_contenido_cartones"]))
			{
				$id_tipo_contenido_cartones=(int)$_GET["id_tipo_contenido_cartones"];
				
				$tipo_contenido_cartones=new TipoContenidoCartonesModel();
				
				$tipo_contenido_cartones->deleteBy(" id_tipo_contenido_cartones",$id_tipo_contenido_cartones);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Contenido Cartones";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_contenido_cartones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoContenidoCartones", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Contenidos Cartones"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_contenido_cartones=new TipoContenidoCartonesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoContenidoCartones",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>