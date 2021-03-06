<?php
class CartonesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//creacion menu busqueda
			//$resultMenu=array("1"=>Nombre,"2"=>Usuario,"3"=>Correo,"4"=>Rol);
			$resultMenu=array(0=>'--Seleccione--',1=>'Numero', 2=>'Serie', 3=>'Contenido', 4=>'Año', 5=>'Cantidad Documentos', 6=>'Nombre Contenido', 7=>'Digitalizado', 8=>'Nombre Entidades', 9=>'Nombre Bodega', 10=>'Sección');
			//Creamos el objeto usuario
			
			$bodegas = new BodegasModel();
			$resultBodegas = $bodegas->getAll("nombre_bodegas");
			
			//notificaciones
			$bodegas->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$tipo_contenido_cartones = new TipoContenidoCartonesModel();
			$resultTipoConCar =$tipo_contenido_cartones->getAll("nombre_tipo_contenido_cartones");
			
			$entidades = new EntidadesModel();
			$resultEnt = $entidades->getAll("nombre_entidades");
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
	        
			$cartones = new CartonesModel();
			$columnas = " cartones.id_cartones,
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
					      bodegas.id_bodegas,
						  bodegas.nombre_bodegas,
							ciudad.id_ciudad,
							ciudad.nombre_ciudad,
					cartones.seccion_cartones";
			$tablas   = "public.cartones, 
						  public.bodegas, 
						  public.entidades, 
						  public.tipo_contenido_cartones,
							public.ciudad";
			$where    = "bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND cartones.id_ciudad = ciudad.id_ciudad";
			$id       = "cartones.numero_cartones";
				
			$resultSet=$cartones->getCondiciones($columnas ,$tablas ,$where, $id);
			
			$nombre_controladores = "Cartones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $cartones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					
					$resultEdit = "";
			
					if (isset ($_GET["id_cartones"])   )
					{
						$_id_cartones = $_GET["id_cartones"];
					    $where    = " bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND cartones.id_ciudad = ciudad.id_ciudad AND cartones.id_cartones = '$_id_cartones' "; 
						$resultEdit = $cartones->getCondiciones($columnas ,$tablas ,$where, $id); 
					
						$traza=new TrazasModel();
						$_nombre_controlador = "Cartones";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_cartones;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					}
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Cartones"
			
				));
			
				exit();
				
			}
			
		
			$resultPerVer= $cartones->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPerVer))
			{
				if (isset ($_POST["criterio"])  && isset ($_POST["contenido"])  )
				{
				
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
						  cartones.seccion_cartones,
						ciudad.nombre_ciudad";
					$tablas   = "public.cartones,
						  public.bodegas,
						  public.entidades,
						  public.tipo_contenido_cartones,
						  public.ciudad";
					
					$where    = "bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND cartones.id_ciudad = ciudad.id_ciudad";
					$id       = "cartones.numero_cartones";
					
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
						$where_6 = "";
						$where_7 = "";
						$where_8 = "";
						$where_9 = "";
						$where_10 ="";
						
							
						switch ($criterio) {
							case 0:
								$where_0 = " ";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  cartones.numero_cartones LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND cartones.serie_cartones LIKE '$contenido'  ";
								break;
								
							case 3:
									//Nombre Cliente/Proveedor
								$where_3 = " AND cartones.contenido_cartones LIKE '$contenido'  ";
								break;
								
							case 4:
									//Nombre Cliente/Proveedor
								$where_4 = " AND cartones.year_cartones LIKE '$contenido'  ";
								break;
								
							case 5:
						     		//Nombre Cliente/Proveedor
								$where_5 = " AND cartones.cantidad_documentos_libros_cartones LIKE '$contenido'  ";
								break;
								
								
							case 6:
									//Nombre Cliente/Proveedor
								$where_6 = " AND tipo_contenido_cartones.nombre_tipo_contenido_cartones LIKE '$contenido'  ";
								break;
								
							case 7:
									//Nombre Cliente/Proveedor
								$where_7 = " AND cartones.digitalizado_cartones = '$contenido'  ";
								break;
								
								
							case 8:
									//Nombre Cliente/Proveedor
								$where_8 = " AND entidades.nombre_entidades LIKE '$contenido'  ";
								break;
								
							case 9:
									//Nombre Cliente/Proveedor
								$where_9 = " AND bodegas.nombre_bodegas LIKE '$contenido'  ";
								break;
								
							case 10:
									//Nombre Cliente/Proveedor
								$where_10 = " AND cartones.seccion_cartones LIKE '$contenido'  ";
								break;
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3 . $where_4 . $where_5 . $where_6 . $where_7 . $where_8 . $where_9. $where_10;
							
							
						$resul = $where_to;
						
						//Conseguimos todos los usuarios con filtros
						$resultSet=$cartones->getCondiciones($columnas ,$tablas ,$where_to, $id);
							
								
					}
				}
			}
			
			//"resultMenu"=>$resultMenu
			
			$this->view("Cartones",array(
					"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultMenu"=>$resultMenu, "resultBodegas"=> $resultBodegas, "resultTipoConCar"=> $resultTipoConCar, "resultEnt"=>$resultEnt,"resultCiu"=>$resultCiu
			
			));
			
			
		}
		else 
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
			));
			
			
			
		}
		
	}
	
	public function InsertaCartones(){
		
		$resultado = null;
		$cartones=new CartonesModel();
		$tipo_operaciones = new TipoOperacionesModel();
		$resultTipoOperaciones= $tipo_operaciones->getBy("nombre_tipo_operaciones LIKE 'ENTRADAS%'");
	
	
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["id_entidades"]) )
		{
			
			$_numero_cartones     = $_POST["numero_cartones"];
			$_serie_cartones      = $_POST["serie_cartones"];
			$_contenido_cartones   = $_POST["contenido_cartones"];
			$_year_cartones   = $_POST["year_cartones"];
			$_cantidad_documentos_libros_cartones   = $_POST["cantidad_documentos_libros_cartones"];
			$_id_tipo_contenido_cartones   = $_POST["id_tipo_contenido_cartones"];
			$_digitalizado_cartones   = $_POST["digitalizado_cartones"];
			$_id_entidades   = $_POST["id_entidades"];
			$_id_bodegas   = $_POST["id_bodegas"];
			$tipo_operaciones=$resultTipoOperaciones[0]->id_tipo_operaciones;
			$_id_ciudad=$_POST["id_ciudad"];
			
		
			
			
			
			if(isset($_POST["id_cartones"]))
			{
	
				$_id_cartones = $_POST["id_cartones"];
					
				$colval = " numero_cartones = '$_numero_cartones',  serie_cartones = '$_serie_cartones', contenido_cartones = '$_contenido_cartones', year_cartones = '$_year_cartones', cantidad_documentos_libros_cartones = '$_cantidad_documentos_libros_cartones', id_tipo_contenido_cartones = '$_id_tipo_contenido_cartones', digitalizado_cartones = '$_digitalizado_cartones', id_entidades = '$_id_entidades', id_bodegas = '$_id_bodegas',id_tipo_operaciones = '$tipo_operaciones', id_ciudad = '$_id_ciudad'  ";
				$tabla = "cartones";
				$where = "id_cartones = '$_id_cartones'    ";
					
				$resultado=$cartones->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				$funcion = "ins_cartones";
					
				$parametros = " '$_numero_cartones' ,'$_serie_cartones' , '$_contenido_cartones' , '$_year_cartones' , '$_cantidad_documentos_libros_cartones' , '$_id_tipo_contenido_cartones' , '$_digitalizado_cartones' , '$_id_entidades' , '$_id_bodegas','$tipo_operaciones','$_id_ciudad'";
				$cartones->setFuncion($funcion);
				$cartones->setParametros($parametros);
				$resultado=$cartones->Insert();
				
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Cartones";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombres_clientes;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				$this->redirect("Cartones", "index");
	
			}
				
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Cartones"
	
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
		
		if(isset($_GET["id_cartones"]))
		{
			$id_cartones=(int)$_GET["id_cartones"];
	
			$cartones=new CartonesModel();
				
			$cartones->deleteBy(" id_cartones",$id_cartones);
		
			$traza=new TrazasModel();
			$_nombre_controlador = "Cartones";
			$_accion_trazas  = "Borrar";
			$_parametros_trazas = $id_cartones;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
		}
	
		$this->redirect("Cartones", "index");
	}
	else
	{
		$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Cartones"
		
		));
	}
	
	}
    
   
	
	
	public function consulta_cartones(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
		
		$registrosTotales = 0;
		$arraySel = "";
		
		$entidades = new EntidadesModel();
		$resultEnt = $entidades->getAll("nombre_entidades");
		
		$tipo_operaciones = new TipoOperacionesModel();
		$resultTipoOpe = $tipo_operaciones->getAll("nombre_tipo_operaciones");
		
		$tipo_contenido_cartones = new TipoContenidoCartonesModel();
		$resultTipoCont = $tipo_contenido_cartones->getAll("nombre_tipo_contenido_cartones");
	
		$cartones = new CartonesModel();
		
		//notificaciones 
		$cartones->MostrarNotificaciones($_SESSION['id_usuarios']);
			
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Cartones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $cartones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"])){
	
					$id_entidades=$_POST['id_entidades'];
					$id_tipo_operaciones=$_POST['id_tipo_operaciones'];
					$id_tipo_contenido_cartones=$_POST['id_tipo_contenido_cartones'];
					$numero_cartones=$_POST['numero_cartones'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
					
					$cartones = new CartonesModel();
	
	
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
							  tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones";
								
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
	
	
					$resultSet=$cartones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
					
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
				
					$resultSet=$cartones->getCondicionesPag($columnas ,$tablas ,$where_to,  $id, $limit );
				
				
				
				}
	
	
	
	
				$this->view("ConsultaCartones",array(
						"resultSet"=>$resultSet, "resultTipoCont"=> $resultTipoCont, "resultEnt"=>$resultEnt, "resultTipoOpe"=>$resultTipoOpe,
						"arraySel"=>$arraySel, "paginasTotales"=>$paginasTotales,
						"registrosTotales"=> $registrosTotales,"pagina_actual"=>$paginaActual, "ultima_pagina"=>$ultima_pagina
							
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
	
	
	public function busqueda_cartones(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//creacion menu busqueda
			//$resultMenu=array("1"=>Nombre,"2"=>Usuario,"3"=>Correo,"4"=>Rol);
			$resultMenu=array(0=>'--Seleccione--',1=>'Numero', 2=>'Serie', 3=>'Contenido', 4=>'Año', 5=>'Cantidad Documentos', 6=>'Nombre Contenido', 7=>'Digitalizado', 8=>'Nombre Entidades', 9=>'Nombre Bodega');
			//Creamos el objeto usuario
			$arraySel = "";
			$resultSet = "";
			$registrosTotales = 0;
				
			$bodegas = new BodegasModel();
			$resultBodegas = $bodegas->getAll("nombre_bodegas");
				
			//notificaciones
			$bodegas->MostrarNotificaciones($_SESSION['id_usuarios']);
				
			$tipo_contenido_cartones = new TipoContenidoCartonesModel();
			$resultTipoConCar =$tipo_contenido_cartones->getAll("nombre_tipo_contenido_cartones");
				
			$entidades = new EntidadesModel();
			$resultEnt = $entidades->getAll("nombre_entidades");
			 
			$cartones = new CartonesModel();
			
			/*
			$columnas = " cartones.id_cartones,
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
					      bodegas.id_bodegas,
						  bodegas.nombre_bodegas,
					cartones.seccion_cartones";
			$tablas   = "public.cartones,
						  public.bodegas,
						  public.entidades,
						  public.tipo_contenido_cartones";
			$where    = "bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones";
			$id       = "cartones.numero_cartones";
	
			$resultSet=$cartones->getCondiciones($columnas ,$tablas ,$where, $id);
		*/	
			$nombre_controladores = "Cartones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $cartones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
					
				$resultEdit = "";
					
				if (isset ($_GET["id_cartones"])   )
				{
					$_id_cartones = $_GET["id_cartones"];
					$where    = " bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones AND cartones.id_cartones = '$_id_cartones' ";
					$resultEdit = $cartones->getCondiciones($columnas ,$tablas ,$where, $id);
						
					$traza=new TrazasModel();
					$_nombre_controlador = "Cartones";
					$_accion_trazas  = "Editar";
					$_parametros_trazas = $_id_cartones;
					$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
	
				}
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Busqueda Cartones"
		
				));
				exit();
					
			}
				
	
			$resultPerVer= $cartones->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPerVer))
			{
				if (isset ($_POST["Buscar"]) )
				{
	
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
							cartones.seccion_cartones";
					$tablas   = "public.cartones,
						  public.bodegas,
						  public.entidades,
						  public.tipo_contenido_cartones";
					$where    = "bodegas.id_bodegas = cartones.id_bodegas AND entidades.id_entidades = cartones.id_entidades AND tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones";
					$id       = "cartones.numero_cartones";
						
					$criterio = $_POST["criterio"];
					$contenido = $_POST["contenido"];
	
					$where_to=$where;
					//$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
	
					if ($contenido !="")
					{
							
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
						$where_5 = "";
						$where_6 = "";
						$where_7 = "";
						$where_8 = "";
						$where_9 = "";
	
							
						switch ($criterio) {
							case 0:
								$where_0 = "";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  cartones.numero_cartones LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND cartones.serie_cartones LIKE '$contenido'  ";
								break;
	
							case 3:
								//Nombre Cliente/Proveedor
								$where_3 = " AND cartones.contenido_cartones LIKE '$contenido'  ";
								break;
	
							case 4:
								//Nombre Cliente/Proveedor
								$where_4 = " AND cartones.year_cartones LIKE '$contenido'  ";
								break;
	
							case 5:
								//Nombre Cliente/Proveedor
								$where_5 = " AND cartones.cantidad_documentos_libros_cartones LIKE '$contenido'  ";
								break;
	
	
							case 6:
								//Nombre Cliente/Proveedor
								$where_6 = " AND tipo_contenido_cartones.nombre_tipo_contenido_cartones LIKE '$contenido'  ";
								break;
	
							case 7:
								//Nombre Cliente/Proveedor
								$where_7 = " AND cartones.digitalizado_cartones = '$contenido'  ";
								break;
	
	
							case 8:
								//Nombre Cliente/Proveedor
								$where_8 = " AND entidades.nombre_entidades LIKE '$contenido'  ";
								break;
	
							case 9:
								//Nombre Cliente/Proveedor
								$where_9 = " AND bodegas.nombre_bodegas LIKE '$contenido'  ";
								break;
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3 . $where_4 . $where_5 . $where_6 . $where_7 . $where_8 . $where_9;
							
							
						
					}
					
					$resultSet=$cartones->getCondiciones($columnas ,$tablas ,$where_to, $id);
						
					
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
				
					$resultSet=$cartones->getCondicionesPag($columnas ,$tablas ,$where_to,  $id, $limit );
					
				
				
				}
				$this->view("BusquedaCartones",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultMenu"=>$resultMenu, "resultBodegas"=> $resultBodegas, "resultTipoConCar"=> $resultTipoConCar, "resultEnt"=>$resultEnt,
						"arraySel"=>$arraySel, "paginasTotales"=>$paginasTotales,
						"registrosTotales"=> $registrosTotales,"pagina_actual"=>$paginaActual, "ultima_pagina"=>$ultima_pagina
				
				));
				
				
				
				
			}else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consulta Documentos Cartones"
	
				));
	
				exit();
			}
				
			//"resultMenu"=>$resultMenu
				
			
				
				
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
