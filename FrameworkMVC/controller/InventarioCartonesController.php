<?php
class InventarioCartonesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
	public function index(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
		$entidades = new EntidadesModel();
		$resultEnt = $entidades->getAll("nombre_entidades");
		
		$tipo_operaciones = new TipoOperacionesModel(); 
		
		$resultTipoOpe = $tipo_operaciones->getBy("nombre_tipo_operaciones='ENTRADAS' OR nombre_tipo_operaciones='SOLICITUD'");
		
		$tipo_contenido_cartones = new TipoContenidoCartonesModel();
		$resultTipoCont = $tipo_contenido_cartones->getAll("nombre_tipo_contenido_cartones");
	
		$inventario_cartones = new CartonesModel();
		
		//notificaciones 
		$inventario_cartones->MostrarNotificaciones($_SESSION['id_usuarios']);
			
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "InventarioCartones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $inventario_cartones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){
	
					$id_entidades=$_POST['id_entidades'];
					$id_tipo_operaciones=$_POST['id_tipo_operaciones'];
					$id_tipo_contenido_cartones=$_POST['id_tipo_contenido_cartones'];
					$numero_cartones=$_POST['numero_cartones'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
					
					$inventario_cartones = new CartonesModel();
	
	
					$columnas = " cartones.id_cartones,
							      cartones.numero_cartones, 
								  cartones.serie_cartones, 
								  cartones.contenido_cartones, 
								  cartones.year_cartones, 
								  cartones.cantidad_documentos_libros_cartones, 
								  tipo_contenido_cartones.nombre_tipo_contenido_cartones, 
								  cartones.digitalizado_cartones, 
								  entidades.nombre_entidades, 
								  bodegas.nombre_bodegas, 
								  tipo_operaciones.nombre_tipo_operaciones, 
								  cartones.creado";
	
					$tablas="public.cartones, 
							  public.tipo_operaciones, 
							  public.bodegas, 
							  public.entidades, 
							  public.tipo_contenido_cartones";
	
					$where="tipo_operaciones.id_tipo_operaciones = cartones.id_tipo_operaciones AND
							  bodegas.id_bodegas = cartones.id_bodegas AND
							  entidades.id_entidades = cartones.id_entidades AND
							  tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones ";
								
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
	
	
					$resultSet=$inventario_cartones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
				}
	
	
	
	
				$this->view("ConsultaInventarioCartones",array(
						"resultSet"=>$resultSet, "resultTipoCont"=> $resultTipoCont, "resultEnt"=>$resultEnt, "resultTipoOpe"=>$resultTipoOpe
							
				));
	
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consulta Inventario Cartones"
	
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
	
	
		
	
	
}
?>
