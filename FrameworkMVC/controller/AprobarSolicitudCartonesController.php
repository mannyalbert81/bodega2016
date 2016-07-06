<?php
class AprobarSolicitudCartonesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol

    public function aprobar_solicitud_cartones(){
    
    	session_start();
    
    	
    	//Creamos el objeto usuario
    	$resultSet="";
    	
    	$usuarios = new UsuariosModel();
		$resultUsu = $usuarios->getAll("nombre_usuarios");
		
		
    	$aprobar_cartones = new AnularSolicitudCartonesModel();
    
    
    	if (isset(  $_SESSION['usuario_usuarios']) )
    	{
    		$notificaciones = new NotificacionesModel();
    		$_id_usuarios= $_SESSION['id_usuarios'];
    			
    		$notificaciones->MostrarNotificaciones($_id_usuarios);
    		
    		
    		$permisos_rol = new PermisosRolesModel();
    		$nombre_controladores = "AprobarSolicitudCartones";
    		$id_rol= $_SESSION['id_rol'];
    		$resultPer = $aprobar_cartones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
    
    		if (!empty($resultPer))
    		{
    				
    			if(isset($_POST["buscar"])){
    				
    				$id_usuarios=$_POST['id_usuarios'];
    				$numero_movimientos_cabeza=$_POST['numero_movimientos_cabeza'];
    				$fechadesde=$_POST['fecha_desde'];
    				$fechahasta=$_POST['fecha_hasta'];
    					
    			    $aprobar_cartones = new MovimientosCabezaModel();
    
    
    			    	
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
    						 AND movimientos_cabeza.estado_movimientos='TRUE' AND  movimientos_cabeza.aprobado_movimientos = 'FALSE'";
														    
					$id="movimientos_cabeza.id_movimientos_cabeza";
    
    
    				$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					
	
	
					if($id_usuarios!=0){$where_0=" AND usuarios.id_usuarios='$id_usuarios'";}
	
					if($numero_movimientos_cabeza!=""){$where_1=" AND movimientos_cabeza.numero_movimientos_cabeza='$numero_movimientos_cabeza'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_2=" AND  movimientos_cabeza.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2;
	
    
    
    				$resultSet=$aprobar_cartones->getCondiciones($columnas ,$tablas , $where_to, $id);
    
    
    			}
    
    
    
    
    			$this->view("AprobarSolicitudCartones",array(
    					"resultSet"=>$resultSet, "resultUsu"=> $resultUsu
							
    			));
    
    
    
    		}
    		else
    		{
    			$this->view("Error",array(
    					"resultado"=>"No tiene Permisos de Acceso Aprobar Solicitud"
    
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
    
    public function actualizarId()
    {
    
    	session_start();
    	$permisos_rol=new PermisosRolesModel();
    	$nombre_controladores = "AprobarSolicitudCartones";
    	$id_rol= $_SESSION['id_rol'];
    	$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
    
    	if (!empty($resultPer))
    	{
    
    		if(isset($_GET["id_movimientos_cabeza"]))
    		{
    
    			$aprobar_solicitud=new MovimientosCabezaModel();
    
    			$_id_movimientos_cabeza = $_GET["id_movimientos_cabeza"];
    
    			$colval = " aprobado_movimientos = 'TRUE'";
    			$tabla = "movimientos_cabeza";
    			$where = "id_movimientos_cabeza = '$_id_movimientos_cabeza' ";
    			$resultado=$aprobar_solicitud->UpdateBy($colval, $tabla, $where);
    
        			//inserta notificaciones
    /*
    			$tipo_notificacion = new TipoNotificacionModel();
    			$asigancion_usuarios = new AsignarUsuarioBodegaModel();
    			$notificaciones = new NotificacionesModel();
    
    			$resultTipoNotificaciones=$tipo_notificacion->getBy("descripcion_notificacion = 'Anular'");
    			$id_tipo_notificacion=$resultTipoNotificaciones[0]->id_tipo_notificacion;
    			$resultAsignacionUsuarios = $asigancion_usuarios->getAll("id_usuarios");
    			$usuarioDestino=$resultAsignacionUsuarios[0]->id_usuarios;
    
    			$descripcion="Solicitud Anulada por ";
    			$numero_movimiento=$_numero_cabeza;
    			$cantidad_cartones=0;
    
    			$resultado=$notificaciones->CrearNotificacion($id_tipo_notificacion, $usuarioDestino, $descripcion, $numero_movimiento, $cantidad_cartones);
    */
    
    		}
    		 
    		 
    		$this->redirect("AprobarSolicitudCartones", "aprobar_solicitud_cartones");
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
