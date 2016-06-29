<?php
class AsignarUsuarioBodegaController extends ControladorBase{
    
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
			$resultMenu=array(0=>'--Seleccione--',1=>'Nombre Usuario', 2=>'Rol', 3=>'Nombre Bodega', 4=>'Fecha Asignacion');
			//Creamos el objeto usuario
			
			$bodegas = new BodegasModel();
			$resultBodegas = $bodegas->getAll("nombre_bodegas");
		
			$usuarios = new UsuariosModel();
			$resultUsu = $usuarios->getAll("nombre_usuarios");
	        
			$asignar_usuario_bodega = new AsignarUsuarioBodegaModel();
			$columnas = " asignacion_usuarios_bodegas.id_asignacion_usuarios_bodegas, 
					     usuarios.id_usuarios, 
						  usuarios.nombre_usuarios, 
						  rol.nombre_rol, 
					      bodegas.id_bodegas,
						  bodegas.nombre_bodegas, 
						  asignacion_usuarios_bodegas.creado";
			$tablas   = "public.asignacion_usuarios_bodegas, 
						  public.bodegas, 
						  public.usuarios, 
						  public.rol";
			$where    = "asignacion_usuarios_bodegas.id_usuarios = usuarios.id_usuarios AND
						  bodegas.id_bodegas = asignacion_usuarios_bodegas.id_bodegas AND
						  rol.id_rol = usuarios.id_rol";
			$id       = "usuarios.nombre_usuarios";
				
			$resultSet=$asignar_usuario_bodega->getCondiciones($columnas ,$tablas ,$where, $id);
			
			$nombre_controladores = "AsignarUsuarioBodega";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $asignar_usuario_bodega->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					
					$resultEdit = "";
			
					if (isset ($_GET["id_asignacion_usuarios_bodegas"])   )
					{
						$asignar_usuario_bodega = new AsignarUsuarioBodegaModel();
						$_id_asignacion_usuarios_bodegas = $_GET["id_asignacion_usuarios_bodegas"];
						$columnas_edit= " asignacion_usuarios_bodegas.id_asignacion_usuarios_bodegas,
					     usuarios.id_usuarios,
						 bodegas.id_bodegas";
						$tablas_edit   = "public.asignacion_usuarios_bodegas,
						  public.bodegas,
						  public.usuarios";
						$where_edit    = "asignacion_usuarios_bodegas.id_usuarios = usuarios.id_usuarios AND
						  bodegas.id_bodegas = asignacion_usuarios_bodegas.id_bodegas AND asignacion_usuarios_bodegas.id_asignacion_usuarios_bodegas = '$_id_asignacion_usuarios_bodegas'";
						$id_edit      = "usuarios.id_usuarios";
						
						 $_id_asignacion_usuarios_bodegas = $_GET["id_asignacion_usuarios_bodegas"];
						 $where    = "asignacion_usuarios_bodegas.id_usuarios = usuarios.id_usuarios AND
						  bodegas.id_bodegas = asignacion_usuarios_bodegas.id_bodegas AND asignacion_usuarios_bodegas.id_asignacion_usuarios_bodegas = '$_id_asignacion_usuarios_bodegas' "; 
						 $resultEdit = $asignar_usuario_bodega->getCondiciones($columnas_edit ,$tablas_edit ,$where_edit, $id_edit); 
						
						
					
						$traza=new TrazasModel();
						$_nombre_controlador = "AsignarUsuarioBodega";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_asignacion_usuarios_bodegas;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					}
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Asignar Usuario Bodega"
			
				));
			exit();
			}
			
		
			$resultPerVer= $asignar_usuario_bodega->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPerVer))
			{
				if (isset ($_POST["criterio"])  && isset ($_POST["contenido"])  )
				{
				
					$columnas = " asignacion_usuarios_bodegas.id_asignacion_usuarios_bodegas, 
						  usuarios.nombre_usuarios, 
						  rol.nombre_rol, 
						  bodegas.nombre_bodegas, 
						  asignacion_usuarios_bodegas.creado";
					$tablas   = "public.asignacion_usuarios_bodegas, 
						  public.bodegas, 
						  public.usuarios, 
						  public.rol";
					$where    = "asignacion_usuarios_bodegas.id_usuarios = usuarios.id_usuarios AND
						  bodegas.id_bodegas = asignacion_usuarios_bodegas.id_bodegas AND
						  rol.id_rol = usuarios.id_rol";
					$id       = "usuarios.nombre_usuarios";
					
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
						
						
							
						switch ($criterio) {
							case 0:
								$where_0 = " ";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  usuarios.nombre_usuarios LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND rol.nombre_rol LIKE '$contenido'  ";
								break;
								
							case 3:
									//Nombre Cliente/Proveedor
								$where_3 = " AND bodegas.nombre_bodegas LIKE '$contenido'  ";
								break;
								
							case 4:
									//Nombre Cliente/Proveedor
								$where_4 = " AND asignacion_usuarios_bodegas.creado LIKE '$contenido'  ";
								break;
								
							
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3 . $where_4;
							
							
						$resul = $where_to;
						
						//Conseguimos todos los usuarios con filtros
						$resultSet=$asignar_usuario_bodega->getCondiciones($columnas ,$tablas ,$where_to, $id);
							
								
					}
				}
			}
			
			//"resultMenu"=>$resultMenu
			
			$this->view("AsignarUsuarioBodega",array(
					"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultMenu"=>$resultMenu, "resultBodegas"=> $resultBodegas, "resultUsu"=>$resultUsu
			
			));
			
			
		}
		else 
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
			));
			
			
			
		}
		
	}
	
	public function InsertaAsignarUsuarioBodega(){
		
		$resultado = null;
		$asignar_usuario_bodega = new AsignarUsuarioBodegaModel();
	
	
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["id_usuarios"]) )
		{

			
			$_id_usuarios   = $_POST["id_usuarios"];
			$_id_bodegas   = $_POST["id_bodegas"];
			
		
			
			
			
			if(isset($_POST["id_asignacion_usuarios_bodegas"]))
			{
	
				$_id_asignacion_usuarios_bodegas = $_POST["id_asignacion_usuarios_bodegas"];
					
				$colval = "id_usuarios = '$_id_usuarios', id_bodegas = '$_id_bodegas'  ";
				$tabla = "asignacion_usuarios_bodegas";
				$where = "id_asignacion_usuarios_bodegas = '$_id_asignacion_usuarios_bodegas'    ";
					
				$resultado=$asignar_usuario_bodega->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				$funcion = "ins_asignacion_usuarios_bodegas";
					
				$parametros = "'$_id_usuarios' , '$_id_bodegas'";
				$asignar_usuario_bodega->setFuncion($funcion);
				$asignar_usuario_bodega->setParametros($parametros);
				$resultado=$asignar_usuario_bodega->Insert();
				
				
				$traza=new TrazasModel();
				$_nombre_controlador = "AsignarUsuarioBodega";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_usuarios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				$this->redirect("AsignarUsuarioBodega", "index");
	
			}
				
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Asignar Usuario Bodega"
	
		));
	
	
	}

	}
	
	public function borrarId()
	{
		
		session_start();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "AsignarUsuarioBodega";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		if(isset($_GET["id_asignacion_usuarios_bodegas"]))
		{
			$id_asignacion_usuarios_bodegas=(int)$_GET["id_asignacion_usuarios_bodegas"];
	
			$asignar_usuario_bodega = new AsignarUsuarioBodegaModel();
				
			$asignar_usuario_bodega->deleteBy(" id_asignacion_usuarios_bodegas",$id_asignacion_usuarios_bodegas);
		
			$traza=new TrazasModel();
			$_nombre_controlador = "AsignarUsuarioBodega";
			$_accion_trazas  = "Borrar";
			$_parametros_trazas = $id_asignacion_usuarios_bodegas;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
		}
	
		$this->redirect("AsignarUsuarioBodega", "index");
	}
	else
	{
		$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Editar Asignar Usuario Bodega"
		
		));
	}
	
	}
    
   
	
	
		
	
	
	public function consulta(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
	
		$citaciones = new CitacionesModel();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $citaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){
	
					$id_ciudad=$_POST['id_ciudad'];
					$identificacion=$_POST['identificacion'];
					$numero_juicio=$_POST['numero_juicio'];
					$titulo_credito=$_POST['numero_titulo'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
	
					$citaciones= new CitacionesModel();
	
	
					$columnas = "juicios.id_juicios,
					clientes.id_clientes,
  					clientes.nombres_clientes,
  					clientes.identificacion_clientes,
  					ciudad.nombre_ciudad,
  					tipo_persona.nombre_tipo_persona,
  					juicios.juicio_referido_titulo_credito,
  					usuarios.nombre_usuarios,
  					titulo_credito.id_titulo_credito,
  					etapas_juicios.nombre_etapas,
  					tipo_juicios.nombre_tipo_juicios,
  					juicios.creado,
  					titulo_credito.total";
	
					$tablas="public.clientes,
					  public.ciudad,
					  public.tipo_persona,
					  public.juicios,
					  public.titulo_credito,
					  public.etapas_juicios,
					  public.tipo_juicios,
					  public.usuarios";
	
					$where="ciudad.id_ciudad = clientes.id_ciudad AND
					  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
					  juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
					  juicios.id_clientes = clientes.id_clientes AND
					  juicios.id_tipo_juicios = tipo_juicios.id_tipo_juicios AND
					  etapas_juicios.id_etapas_juicios = juicios.id_etapas_juicios AND
					  usuarios.id_usuarios=juicios.id_usuarios";
	
					$id="juicios.id_juicios";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
	
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
	
					if($identificacion!=""){$where_2=" AND clientes.identificacion='$identificacion'";}
	
					if($titulo_credito!=""){$where_3=" AND juicios.id_titulo_credito='$titulo_credito'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  juicios.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
				}
	
	
	
	
				$this->view("ConsultaClientes",array(
						"resultSet"=>$resultSet,"resultCiu"=>$resultCiu
							
				));
	
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Citaciones"
	
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
