<?php
class AnularSolicitudCartonesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol

    public function anula_solicitud_cartones(){
    
    	session_start();
    
    	//Creamos el objeto usuario
    	$resultSet="";
    	
    	$usuarios= new UsuariosModel();
    	$resultUsu = $usuarios->getAll("nombre_usuarios");
    	
    	$entidades = new EntidadesModel();
    	$resultEnt = $entidades->getAll("nombre_entidades");
    
    	$tipo_operaciones = new TipoOperacionesModel();
    	$resultTipoOpe = $tipo_operaciones->getAll("nombre_tipo_operaciones");
    
    	
    	$anular_cartones = new AnularSolicitudCartonesModel();
    
    
    	if (isset(  $_SESSION['usuario_usuarios']) )
    	{
    		$permisos_rol = new PermisosRolesModel();
    		$nombre_controladores = "AnularSolicitudCartones";
    		$id_rol= $_SESSION['id_rol'];
    		$resultPer = $anular_cartones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
    
    		if (!empty($resultPer))
    		{
    				
    			if(isset($_POST["buscar"])){
    				$id_usuarios=$_POST['id_usuarios'];
    				$id_entidades=$_POST['id_entidades'];
    				$id_tipo_operaciones=$_POST['id_tipo_operaciones'];
    				$numero_cartones=$_POST['numero_cartones'];
    				$fechadesde=$_POST['fecha_desde'];
    				$fechahasta=$_POST['fecha_hasta'];
    					
    			    	$anular_cartones = new AnularSolicitudCartonesModel();
    
    
    
    				$columnas = "  cartones_solicitudes.id_cartones_solicitudes, 
									  usuarios.nombre_usuarios, 
									  cartones.numero_cartones, 
									  cartones.serie_cartones, 
									  cartones.contenido_cartones, 
									  cartones.year_cartones, 
									  cartones.cantidad_documentos_libros_cartones, 
									  tipo_contenido_cartones.nombre_tipo_contenido_cartones, 
									  cartones.digitalizado_cartones, 
									  entidades.nombre_entidades, 
									  cartones_solicitudes.creado, 
									  bodegas.nombre_bodegas, 
									  tipo_operaciones.nombre_tipo_operaciones";
    
    				$tablas="public.cartones_solicitudes, 
							  public.usuarios, 
							  public.cartones, 
							  public.entidades, 
							  public.tipo_contenido_cartones, 
							  public.bodegas, 
							  public.tipo_operaciones";
    
    				$where="usuarios.id_usuarios = cartones_solicitudes.id_usuarios AND
							  cartones.id_cartones = cartones_solicitudes.id_cartones AND
							  entidades.id_entidades = cartones.id_entidades AND
							  tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND
							  bodegas.id_bodegas = cartones.id_bodegas AND
							  tipo_operaciones.id_tipo_operaciones = cartones.id_tipo_operaciones";
							    
    				$id="cartones_solicitudes.id_cartones_solicitudes";
    
    
    				$where_0 = "";
    				$where_1 = "";
    				$where_2 = "";
    				$where_3 = "";
    				$where_4 = "";
    				
    
    				if($id_usuarios!=0){$where_0=" AND usuarios.id_usuarios='$id_usuarios'";}
    				
    				if($id_entidades!=0){$where_1=" AND entidades.id_entidades='$id_entidades'";}
    
    				if($id_tipo_operaciones!=0){$where_2=" AND tipo_operaciones.id_tipo_operaciones='$id_tipo_operaciones'";}
    
    				if($numero_cartones!=""){$where_3=" AND cartones.numero_cartones='$numero_cartones'";}
    
    				if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  cartones.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
    
    
    				$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4  ;
    
    
    				$resultSet=$anular_cartones->getCondiciones($columnas ,$tablas , $where_to, $id);
    
    
    			}
    
    
    
    
    			$this->view("AnularSolicitudCartones",array(
    					"resultSet"=>$resultSet, "resultEnt"=>$resultEnt, "resultTipoOpe"=>$resultTipoOpe,  "resultUsu"=>$resultUsu
    						
    			));
    
    
    
    		}
    		else
    		{
    			$this->view("Error",array(
    					"resultado"=>"No tiene Permisos de Acceso a Consulta Cartones"
    
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
    
    public function consulta_solicitud_cartones(){
    
    	session_start();
    
    	//Creamos el objeto usuario
    	$resultSet="";
    	 
    	$usuarios= new UsuariosModel();
    	$resultUsu = $usuarios->getAll("nombre_usuarios");
    	 
    	$entidades = new EntidadesModel();
    	$resultEnt = $entidades->getAll("nombre_entidades");
    
    	$tipo_operaciones = new TipoOperacionesModel();
    	$resultTipoOpe = $tipo_operaciones->getAll("nombre_tipo_operaciones");
    
    	 
    	$anular_cartones = new AnularSolicitudCartonesModel();
    
    
    	if (isset(  $_SESSION['usuario_usuarios']) )
    	{
    		$permisos_rol = new PermisosRolesModel();
    		$nombre_controladores = "AnularSolicitudCartones";
    		$id_rol= $_SESSION['id_rol'];
    		$resultPer = $anular_cartones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
    
    		if (!empty($resultPer))
    		{
    
    			if(isset($_POST["buscar"])){
    				$id_usuarios=$_POST['id_usuarios'];
    				$id_entidades=$_POST['id_entidades'];
    				$id_tipo_operaciones=$_POST['id_tipo_operaciones'];
    				$numero_cartones=$_POST['numero_cartones'];
    				$fechadesde=$_POST['fecha_desde'];
    				$fechahasta=$_POST['fecha_hasta'];
    					
    				$anular_cartones = new AnularSolicitudCartonesModel();
    
    
    
    				$columnas = "  cartones_solicitudes.id_cartones_solicitudes,
									  usuarios.nombre_usuarios,
									  cartones.numero_cartones,
									  cartones.serie_cartones,
									  cartones.contenido_cartones,
									  cartones.year_cartones,
									  cartones.cantidad_documentos_libros_cartones,
									  tipo_contenido_cartones.nombre_tipo_contenido_cartones,
									  cartones.digitalizado_cartones,
									  entidades.nombre_entidades,
									  cartones_solicitudes.creado,
									  bodegas.nombre_bodegas,
									  tipo_operaciones.nombre_tipo_operaciones";
    
    				$tablas="public.cartones_solicitudes,
							  public.usuarios,
							  public.cartones,
							  public.entidades,
							  public.tipo_contenido_cartones,
							  public.bodegas,
							  public.tipo_operaciones";
    
    				$where="usuarios.id_usuarios = cartones_solicitudes.id_usuarios AND
							  cartones.id_cartones = cartones_solicitudes.id_cartones AND
							  entidades.id_entidades = cartones.id_entidades AND
							  tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND
							  bodegas.id_bodegas = cartones.id_bodegas AND
							  tipo_operaciones.id_tipo_operaciones = cartones.id_tipo_operaciones";
    					
    				$id="cartones_solicitudes.id_cartones_solicitudes";
    
    
    				$where_0 = "";
    				$where_1 = "";
    				$where_2 = "";
    				$where_3 = "";
    				$where_4 = "";
    
    
    				if($id_usuarios!=0){$where_0=" AND usuarios.id_usuarios='$id_usuarios'";}
    
    				if($id_entidades!=0){$where_1=" AND entidades.id_entidades='$id_entidades'";}
    
    				if($id_tipo_operaciones!=0){$where_2=" AND tipo_operaciones.id_tipo_operaciones='$id_tipo_operaciones'";}
    
    				if($numero_cartones!=""){$where_3=" AND cartones.numero_cartones='$numero_cartones'";}
    
    				if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  cartones.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
    
    
    				$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4  ;
    
    
    				$resultSet=$anular_cartones->getCondiciones($columnas ,$tablas , $where_to, $id);
    
    
    			}
    
    
    
    
    			$this->view("ConsultaSolicitudCartones",array(
    					"resultSet"=>$resultSet, "resultEnt"=>$resultEnt, "resultTipoOpe"=>$resultTipoOpe,  "resultUsu"=>$resultUsu
    
    			));
    
    
    
    		}
    		else
    		{
    			$this->view("Error",array(
    					"resultado"=>"No tiene Permisos de Acceso a Consulta Cartones"
    
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
    
	public function borrarId()
	{
		
		session_start();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Cartones";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		if(isset($_GET["id_cartones_solicitudes"]))
		{
			$id_cartones_solicitudes=(int)$_GET["id_cartones_solicitudes"];
	
			$anular_cartones = new AnularSolicitudCartonesModel();;
				
			$anular_cartones ->deleteBy(" id_cartones_solicitudes",$id_cartones_solicitudes);
		
			$traza=new TrazasModel();
			$_nombre_controlador = "AnularSolicitudCartones";
			$_accion_trazas  = "Borrar";
			$_parametros_trazas = $id_cartones_solicitudes;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
		}
	
		$this->redirect("AnularSolicitudCartones", "consulta_cartones");
	}
	else
	{
		$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Anular Solicitud Cartones"
		
		));
	}
	
	}
	
}
?>
