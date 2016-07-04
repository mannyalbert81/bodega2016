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
    	
    	$usuarios = new UsuariosModel();
		$resultUsu = $usuarios->getAll("nombre_usuarios");
		
		
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
    				$numero_movimientos_cabeza=$_POST['numero_movimientos_cabeza'];
    				$fechadesde=$_POST['fecha_desde'];
    				$fechahasta=$_POST['fecha_hasta'];
    					
    			    $anular_cartones = new MovimientosCabezaModel();
    
    
    			    	
    				$columnas = "movimientos_cabeza.id_movimientos_cabeza, 
								  movimientos_cabeza.numero_movimientos_cabeza, 
								  tipo_operaciones.nombre_tipo_operaciones, 
								  usuarios.nombre_usuarios, 
								  movimientos_cabeza.observaciones_movimientos, 
								  movimientos_cabeza.cantidad_cartones_movimientos_cabeza, 
								  movimientos_cabeza.creado";
								    
    				$tablas="public.movimientos_cabeza, 
							  public.tipo_operaciones, 
							  public.usuarios";
    
    				$where="tipo_operaciones.id_tipo_operaciones = movimientos_cabeza.id_tipo_operaciones AND
							  usuarios.id_usuarios = movimientos_cabeza.id_usuario_solicita AND tipo_operaciones.nombre_tipo_operaciones ='SOLICITUD'
    						 AND movimientos_cabeza.estado_movimientos='TRUE'";
														    
					$id="movimientos_cabeza.id_movimientos_cabeza";
    
    
    				$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					
	
	
					if($id_usuarios!=0){$where_0=" AND usuarios.id_usuarios='$id_usuarios'";}
	
					if($numero_movimientos_cabeza!=""){$where_1=" AND movimientos_cabeza.numero_movimientos_cabeza='$numero_movimientos_cabeza'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_2=" AND  movimientos_cabeza.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2;
	
    
    
    				$resultSet=$anular_cartones->getCondiciones($columnas ,$tablas , $where_to, $id);
    
    
    			}
    
    
    
    
    			$this->view("AnularSolicitudCartones",array(
    					"resultSet"=>$resultSet, "resultUsu"=> $resultUsu
							
    			));
    
    
    
    		}
    		else
    		{
    			$this->view("Error",array(
    					"resultado"=>"No tiene Permisos de Acceso A Anular Solicitud"
    
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
    	
    	$entidades = new EntidadesModel();
		$resultEnt = $entidades->getAll("nombre_entidades");
		
		$tipo_operaciones = new TipoOperacionesModel();
		$resultTipoOpe = $tipo_operaciones->getAll("nombre_tipo_operaciones");
		
		$tipo_contenido_cartones = new TipoContenidoCartonesModel();
		$resultTipoCont = $tipo_contenido_cartones->getAll("nombre_tipo_contenido_cartones");
    
    	
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
    				
    				$id_entidades=$_POST['id_entidades'];
    				$id_tipo_operaciones=$_POST['id_tipo_operaciones'];
    				$id_tipo_contenido_cartones=$_POST['id_tipo_contenido_cartones'];
    				$numero_cartones=$_POST['numero_cartones'];
    				$fechadesde=$_POST['fecha_desde'];
    				$fechahasta=$_POST['fecha_hasta'];
    					
    			    $anular_cartones = new MovimientosDetalleModel();
    			   
    
    			    	
    				$columnas = " cartones.id_cartones, 
								  movimientos_detalle.id_movimientos_detalle, 
								  movimientos_detalle.numero_movimientos_detalle, 
								  cartones.numero_cartones, 
								  cartones.serie_cartones, 
								  movimientos_detalle.creado, 
								  cartones.contenido_cartones, 
								  cartones.year_cartones, 
								  cartones.cantidad_documentos_libros_cartones, 
								  tipo_contenido_cartones.nombre_tipo_contenido_cartones, 
								  cartones.digitalizado_cartones, 
								  entidades.nombre_entidades, 
								  bodegas.nombre_bodegas, 
								  tipo_operaciones.nombre_tipo_operaciones";
    
    				$tablas="public.movimientos_detalle, 
							  public.cartones, 
							  public.bodegas, 
							  public.entidades, 
							  public.tipo_operaciones, 
							  public.tipo_contenido_cartones";
    
    				$where="movimientos_detalle.id_cartones = cartones.id_cartones AND
							  bodegas.id_bodegas = cartones.id_bodegas AND
							  entidades.id_entidades = cartones.id_entidades AND
							  tipo_operaciones.id_tipo_operaciones = movimientos_detalle.id_tipo_operaciones AND
							  tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND tipo_operaciones.nombre_tipo_operaciones='SOLICITUD'";
														    
					$id="cartones.id_cartones";
    
    
    				$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	
					if($id_tipo_operaciones!=0){$where_1=" AND tipo_operaciones.id_tipo_operaciones='$id_tipo_operaciones'";}
	
					if($id_tipo_contenido_cartones!=0){$where_2=" AND tipo_contenido_cartones.id_tipo_contenido_cartones='$id_tipo_contenido_cartones'";}
	
					if($numero_cartones!=""){$where_3=" AND cartones.numero_cartones='$numero_cartones'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  cartones.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
    
    
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
    	$nombre_controladores = "AnularSolicitudCartones";
    	$id_rol= $_SESSION['id_rol'];
    	$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
    		
    	if (!empty($resultPer))
    	{
    		
    	if(isset($_GET["id_movimientos_cabeza"]))
    	{
    		
    		$anular_solicitud=new MovimientosCabezaModel();
    		
    		$_id_movimientos_cabeza = $_GET["id_movimientos_cabeza"];
    		
    		$colval = " estado_movimientos = 'FALSE'";
    		$tabla = "movimientos_cabeza";
    		$where = "id_movimientos_cabeza = '$_id_movimientos_cabeza' ";
    		$resultado=$anular_solicitud->UpdateBy($colval, $tabla, $where);
    
    		
    		//ELIMINA CARTONES DEL DETALLE
    		$eliminar=new MovimientosDetalleModel();
    		$_numero_cabeza =  $_GET["numero_movimientos_cabeza"];
    		$where_del = "numero_movimientos_detalle = '$_numero_cabeza'";
    		$eliminar->deleteByWhere($where_del);
    		
    		
    	}
    	
    	
    	$this->redirect("AnularSolicitudCartones", "anula_solicitud_cartones");
    	}
    	
    	else
    	{
    		$this->view("Error",array(
    				"resultado"=>"No tiene Permisos de Anular"
    
    		));
    	}
    
    }
	
	
	
	
	
	
}
?>
