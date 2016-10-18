<?php
class InventarioCartonesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
	public function index(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
			
	
		$bodegas = new BodegasModel();
		$resultBod = $bodegas->getAll("nombre_bodegas");
		
		
		$seccion = new CartonesModel();
		$resultSecc = $seccion->getGrupBy("seccion_cartones", "cartones", "seccion_cartones");
		
		//SELECT seccion_cartones FROM cartones GROUP BY seccion_cartones;
		
		
		
		
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
					
				if(isset($_POST["id_bodegas"])){
	
						
						$id_bodegas=$_POST['id_bodegas'];
						$id_tipo_contenido_cartones=$_POST['id_tipo_contenido_cartones'];
						$numero_cartones=$_POST['numero_cartones'];
						$seccion_cartones=$_POST['seccion_cartones'];
						$fechadesde=$_POST['fecha_desde'];
						$fechahasta=$_POST['fecha_hasta'];
							
						$inventario_cartones = new CartonesModel();
						
					
						$columnas = "cartones.id_cartones,
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
								  cartones.creado,
							      cartones.seccion_cartones";
						
						
						
						$tablas="public.cartones,
							  public.tipo_operaciones,
							  public.bodegas,
							  public.entidades,
							  public.tipo_contenido_cartones";
						
						$where="tipo_operaciones.id_tipo_operaciones = cartones.id_tipo_operaciones AND
							  bodegas.id_bodegas = cartones.id_bodegas AND
							  entidades.id_entidades = cartones.id_entidades AND
							  tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND (tipo_operaciones.nombre_tipo_operaciones ='SOLICITUD' OR tipo_operaciones.nombre_tipo_operaciones ='ENTRADAS')";
						
						$id="cartones.id_cartones";
						
						
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
							
						
						
						if($id_bodegas!=0){$where_0=" AND bodegas.id_bodegas='$id_bodegas'";}
						
						if($id_tipo_contenido_cartones!=0){$where_1=" AND tipo_contenido_cartones.id_tipo_contenido_cartones='$id_tipo_contenido_cartones'";}
						
						if($numero_cartones!=""){$where_2=" AND cartones.numero_cartones='$numero_cartones'";}
							
						if($seccion_cartones!=""){$where_3=" AND cartones.seccion_cartones ='$seccion_cartones'";}
						
						if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  cartones.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
						
						
						$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3. $where_4;
						
						
						$resultSet=$inventario_cartones->getCondiciones($columnas ,$tablas , $where_to, $id);
						
						
						foreach($resultSet as $res)
						{
							$registrosTotales = $registrosTotales + 1 ;
						}
						
	
				}
				else{
					
					
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
				
					$resultSet=$inventario_cartones->getCondicionesPag($columnas ,$tablas ,$where_to,  $id, $limit );
				
						
						
				}
				
	
	
	
	
				$this->view("ConsultaInventarioCartones",array(
						"resultSet"=>$resultSet, "resultTipoCont"=> $resultTipoCont, 
						"resultBod"=>$resultBod, "resultSecc"=>$resultSecc, 
						"arraySel"=>$arraySel, "paginasTotales"=>$paginasTotales, 
						"registrosTotales"=> $registrosTotales,"pagina_actual"=>$paginaActual, "ultima_pagina"=>$ultima_pagina
							
							
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
