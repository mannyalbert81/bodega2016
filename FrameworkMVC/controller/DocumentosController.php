<?php
class DocumentosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$resultMenu=array(0=>'--Seleccione--',1=>'Area', 2=>'Bodega', 3=>'Numero Carton', 4=>'Serie', 5=>'Contenido');
				
			
			$area_documentos = new AreaDocumentosModel();
			$resultArea = $area_documentos->getAll("nombre_areas_documentos");
			
			$bodegas = new BodegasModel();
			$resultBodegas =$bodegas->getBy("nombre_bodegas='REPOSITORIO PRINCIPAL'");
			
			$tipo_documentos = new TipoDocumentosModel();
			$resultTipDoc = $tipo_documentos->getAll("nombres_tipo_documentos");
	        
			$cartones = new CartonesModel();
			$resultCartones = $cartones->getAll("numero_cartones");
			 
			
			$documentos = new DocumentosModel();

			$nombre_controladores = "Documentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$columnas = "documentos.id_documentos, 
								  area_doumentos.id_areas_documentos, 
								  area_doumentos.nombre_areas_documentos, 
								  bodegas.id_bodegas, 
								  bodegas.nombre_bodegas, 
								  tipo_documentos.id_tipo_documentos, 
								  tipo_documentos.nombres_tipo_documentos, 
								  cartones.id_cartones, 
								  cartones.numero_cartones, 
								  cartones.serie_cartones, 
								  cartones.contenido_cartones, 
								  cartones.cantidad_documentos_libros_cartones,
							      documentos.serie_documentos, 
  								  documentos.contenido_documentos,
							      documentos.id_area_documentos";
					
					$tablas   = "public.documentos, 
								  public.cartones, 
								  public.area_doumentos, 
								  public.bodegas, 
								  public.tipo_documentos";
					$where    = " documentos.id_tipo_documentos = tipo_documentos.id_tipo_documentos AND
								  cartones.id_cartones = documentos.id_cartones AND
								  area_doumentos.id_areas_documentos = documentos.id_area_documentos AND
								  bodegas.id_bodegas = documentos.id_bodegas";
					$id       = "documentos.id_documentos"; 
			
				
					$resultSet=$documentos->getCondiciones($columnas ,$tablas ,$where, $id);
					
					
					$resultEdit = "";
			
					if (isset ($_GET["id_documentos"])   )
					{
						$_id_documentos = $_GET["id_documentos"];
					    $where    = "documentos.id_tipo_documentos = tipo_documentos.id_tipo_documentos AND
								  cartones.id_cartones = documentos.id_cartones AND
								  area_doumentos.id_areas_documentos = documentos.id_area_documentos AND
								  bodegas.id_bodegas = documentos.id_bodegas AND documentos.id_documentos  = '$_id_documentos' "; 
						$resultEdit = $documentos->getCondiciones($columnas ,$tablas ,$where, $id); 
					
						$traza=new TrazasModel();
						$_nombre_controlador = "Documentos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_documentos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					}
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Documentos"
			
				));
			 exit();
			}
			
			
			///si tiene permiso de ver
			//$resultPerVer = $usuarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			$resultPerVer= $documentos->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPerVer))
			{
				if (isset ($_POST["criterio"])  && isset ($_POST["contenido"])  )
				{
				
					$columnas = "documentos.id_documentos,
								  area_doumentos.id_areas_documentos,
								  area_doumentos.nombre_areas_documentos,
								  bodegas.id_bodegas,
								  bodegas.nombre_bodegas,
								  tipo_documentos.id_tipo_documentos,
								  tipo_documentos.nombres_tipo_documentos,
								  cartones.id_cartones,
								  cartones.numero_cartones,
								  cartones.serie_cartones,
								  cartones.contenido_cartones,
								  cartones.cantidad_documentos_libros_cartones,
							      documentos.serie_documentos,
  									documentos.contenido_documentos";
						
					$tablas   = "public.documentos,
								  public.cartones,
								  public.area_doumentos,
								  public.bodegas,
								  public.tipo_documentos";
					$where    = " documentos.id_tipo_documentos = tipo_documentos.id_tipo_documentos AND
								  cartones.id_cartones = documentos.id_cartones AND
								  area_doumentos.id_areas_documentos = documentos.id_area_documentos AND
								  bodegas.id_bodegas = documentos.id_bodegas";
					$id       = "documentos.id_documentos";
						
					
					$criterio = $_POST["criterio"];
					$contenido = $_POST["contenido"];
						
					
					//$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
						
					if ($contenido !="")
					{
							
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
						$where_5 = "";
						
							
						switch ($criterio) {
							case 0:
								$where_0 = " ";
								break;
						   case 1:
								$where_1 = " AND area_doumentos.nombre_areas_documentos LIKE '%$contenido%' ";
							    break;
							case 2:
								//Ruc Cliente/Proveedor
								$where_2 = " AND  bodegas.nombre_bodegas LIKE '%$contenido%'  ";
								break;
							case 3:
								//Nombre Cliente/Proveedor
								$where_3 = " AND cartones.numero_cartones LIKE '%$contenido%'  ";
								break;
						    case 4:
									//Nombre Cliente/Proveedor
								$where_4 = " AND documentos.serie_documentos LIKE '%$contenido%'  ";
								break;
								
							case 5:
									//Nombre Cliente/Proveedor
								$where_5 = " AND documentos.contenido_documentos LIKE '%$contenido%'  ";
								break;
										
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3 . $where_4. $where_5;
							
							
						$resul = $where_to;
						
						//Conseguimos todos los usuarios con filtros
						$resultSet=$documentos->getCondiciones($columnas ,$tablas ,$where_to, $id);
							
								
					}
				}
			}
			
			//"resultMenu"=>$resultMenu
			
			$this->view("Documentos",array(
					"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultMenu"=>$resultMenu, "resultArea"=> $resultArea, "resultBodegas"=> $resultBodegas, "resultTipDoc"=>$resultTipDoc, "resultCartones"=>$resultCartones
			
			));
			
			
		}
		else 
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
			));
			
			
			
		}
		
	}
	
	public function InsertaDocumentos(){
		
		$resultado = null;
		$documentos=new DocumentosModel();
	
		session_start();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Documentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["Guardar"]) )
		{

			$_id_area_documentos = $_POST["id_area_documentos"];
			$_id_bodegas = $_POST["id_bodegas"];
			$_id_tipo_documentos = $_POST["id_tipo_documentos"];
			$_id_cartones = $_POST["id_cartones"];
			$_serie_documentos = $_POST["serie_documentos"];
			$_contenido_documentos = $_POST["contenido_documentos"];
			
			
					
				$funcion = "ins_documentos";
					
				$parametros = " '$_id_area_documentos' ,'$_id_bodegas' , '$_id_tipo_documentos' , '$_id_cartones' , '$_serie_documentos' , '$_contenido_documentos' ";
				$documentos->setFuncion($funcion);
				$documentos->setParametros($parametros);
				$resultado=$documentos->Insert();
				
				
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Documentos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_serie_documentos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}	
				$this->redirect("Documentos", "index");
	
			}
				
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Documentos"
	
		));
	
	
	}

	}
	
	public function borrarId()
	{
		
		session_start();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Documentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		if(isset($_GET["id_documentos"]))
		{
			$id_documentos=(int)$_GET["id_documentos"];
	
			$documentos=new DocumentosModel();
				
			$documentos->deleteBy(" id_documentos",$id_documentos);
		
			$traza=new TrazasModel();
			$_nombre_controlador = "Documentos";
			$_accion_trazas  = "Borrar";
			$_parametros_trazas = $id_documentos;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
		}
	
		$this->redirect("Documentos", "index");
	}
	else
	{
		$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Documentos"
		
		));
	}
	
	}
    
   
		
}
?>
