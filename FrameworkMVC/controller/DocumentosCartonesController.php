<?php
class DocumentosCartonesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
	public function index(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		
		$area_documentos = new AreaDocumentosModel();
		$resultArea = $area_documentos->getAll("nombre_areas_documentos");
		
		$bodegas = new BodegasModel();
		$resultBodegas =$bodegas->getAll("nombre_bodegas");
		
		$tipo_documentos = new TipoDocumentosModel();
		$resultTipDoc = $tipo_documentos->getAll("nombres_tipo_documentos");
		
		
		$tipo_contenido_cartones = new TipoContenidoCartonesModel();
		$resultTipoCont = $tipo_contenido_cartones->getAll("nombre_tipo_contenido_cartones");
	
		$seccion = new CartonesModel();
		$resultSecc = $seccion->getGrupBy("seccion_cartones", "cartones", "seccion_cartones");
		
		
		$documentos_cartones = new DocumentosModel();
		$documentos_cartones->MostrarNotificaciones($_SESSION['id_usuarios']);
			
         	
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "DocumentosCartones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos_cartones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_areas_documentos"])){
	
					$id_areas_documentos=$_POST['id_areas_documentos'];
					$id_bodegas=$_POST['id_bodegas'];
					$id_tipo_documentos=$_POST['id_tipo_documentos'];
					$id_tipo_contenido_cartones=$_POST['id_tipo_contenido_cartones'];
					$numero_cartones=$_POST['numero_cartones'];
					$seccion_cartones=$_POST['seccion_cartones'];
					
					
					$documentos_cartones = new DocumentosModel();
	
	
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
							  cartones.year_cartones, 
							  cartones.cantidad_documentos_libros_cartones, 
							  tipo_contenido_cartones.id_tipo_contenido_cartones, 
							  tipo_contenido_cartones.nombre_tipo_contenido_cartones, 
							  cartones.digitalizado_cartones, 
							  entidades.id_entidades, 
							  entidades.nombre_entidades, 
							  tipo_operaciones.id_tipo_operaciones, 
							  tipo_operaciones.nombre_tipo_operaciones, 
							  ciudad.id_ciudad, 
							  ciudad.nombre_ciudad, 
							  cartones.serie_desde_cartones, 
							  cartones.serie_hasta_cartones, 
							  cartones.seccion_cartones, 
							  documentos.creado, 
							  documentos.contenido_documentos, 
							  documentos.serie_documentos";
								
					$tablas="public.area_doumentos, 
							  public.documentos, 
							  public.bodegas, 
							  public.tipo_documentos, 
							  public.cartones, 
							  public.entidades, 
							  public.ciudad, 
							  public.tipo_contenido_cartones, 
							  public.tipo_operaciones";
	
					$where="  documentos.id_area_documentos = area_doumentos.id_areas_documentos AND
							  documentos.id_bodegas = bodegas.id_bodegas AND
							  documentos.id_tipo_documentos = tipo_documentos.id_tipo_documentos AND
							  cartones.id_cartones = documentos.id_cartones AND
							  cartones.id_entidades = entidades.id_entidades AND
							  cartones.id_ciudad = ciudad.id_ciudad AND
							  cartones.id_tipo_contenido_cartones = tipo_contenido_cartones.id_tipo_contenido_cartones AND
  					          cartones.id_tipo_operaciones = tipo_operaciones.id_tipo_operaciones";
								
					$id="documentos.id_documentos";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_5 = "";
					
	
	
					if($id_areas_documentos!=0){$where_0=" AND area_doumentos.id_areas_documentos='$id_areas_documentos'";}
	             
					if($id_bodegas!=0){$where_1=" AND bodegas.id_bodegas='$id_bodegas'";}
	
					if($id_tipo_documentos!=0){$where_2=" AND tipo_documentos.id_tipo_documentos='$id_tipo_documentos'";}
					
					if($id_tipo_contenido_cartones!=0){$where_3=" AND tipo_contenido_cartones.id_tipo_contenido_cartones='$id_tipo_contenido_cartones'";}
						
					if($numero_cartones!=""){$where_4=" AND cartones.numero_cartones='$numero_cartones'";}
	
					if($seccion_cartones!=""){$where_5=" AND cartones.seccion_cartones ='$seccion_cartones'";}
					
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3. $where_4. $where_5;
	
	
					$resultSet=$documentos_cartones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
					
					foreach($resultSet as $res)
					{
						$registrosTotales = $registrosTotales + 1 ;
					}
	
				}else{
					
					
					$registrosTotales = 0;
					$hojasTotales = 0;
						
						
					$arraySel = "";
					$resultSet = "";
					
				}
				
				///aqui va la paginacion  ///
				$articulosTotales = 0;
				$paginasTotales = 0;
				$paginaActual = 0;
				$ultima_pagina = 1;
					
				if(isset($_POST["pagina"])){
				
					// en caso que haya datos, los casteamos a int
					$paginaActual = (int)$_POST["pagina"];
					$ultima_pagina = (int)$_POST["ultima_pagina"] - 5;
				}
				
				if(isset($_POST["siguiente_pagina"])){
				
					// en caso que haya datos, los casteamos a int
					$ultima_pagina = (int)$_POST["ultima_pagina"];
				}
				
					
				if(isset($_POST["anterior_pagina"])){
				
				
					$ultima_pagina = (int)$_POST["ultima_pagina"] - 10;
				
				
				}
				
				
				if ($resultSet != "")
				{
				
					foreach($resultSet as $res)
					{
						$articulosTotales = $articulosTotales + 1;
					}
				
				
					$articulosPorPagina = 50;
				
					$paginasTotales = ceil($articulosTotales / $articulosPorPagina);
				
				
					// el número de la página actual no puede ser menor a 0
					if($paginaActual < 1){
						$paginaActual = 1;
					}
					else if($paginaActual > $paginasTotales){ // tampoco mayor la cantidad de páginas totales
						$paginaActual = $paginasTotales;
					}
				
					// obtenemos cuál es el artículo inicial para la consulta
					$articuloInicial = ($paginaActual - 1) * $articulosPorPagina;
				
					//agregamos el limit
					$limit = " LIMIT   '$articulosPorPagina' OFFSET '$articuloInicial'";
				
					//volvemos a pedir el resultset con la pginacion
				
					$resultSet=$documentos_cartones->getCondicionesPag($columnas ,$tablas ,$where_to,  $id, $limit );
				
				
				
				}
	
	
	
	
				$this->view("ConsultaDocumentosCartones",array(
						"resultSet"=>$resultSet, "resultTipoCont"=> $resultTipoCont, "resultBodegas"=>$resultBodegas, "resultTipDoc"=>$resultTipDoc, "resultArea"=>$resultArea, "resultSecc"=>$resultSecc,
						"arraySel"=>$arraySel, "paginasTotales"=>$paginasTotales,
						"registrosTotales"=> $registrosTotales,"pagina_actual"=>$paginaActual, "ultima_pagina"=>$ultima_pagina
						
							
				));
	
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consulta Documentos Cartones"
	
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
