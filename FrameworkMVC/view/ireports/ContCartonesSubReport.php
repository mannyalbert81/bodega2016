<?php 
#<?php 
#Importas la librer�a PhpJasperLibrary
ob_end_clean(); //add this line here

include_once('PhpJasperLibrary/class/tcpdf/tcpdf.php');
include_once("PhpJasperLibrary/class/PHPJasperXML.inc.php");

include_once ('conexion.php');


#Conectas a la base de datos 
$server  = server;
$user    = user;
$pass    = pass;
$db      = db;
$driver  = driver;
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
$PHPJasperXML->debugsql=false;
#aqu� va el reporte


$id_entidades=0;
$id_tipo_operaciones=0;
$id_tipo_contenido_cartones=0;
$numero_cartones=0;
$fecha_desde=0;
$fecha_hasta=0;
$sql="";
$detallesql="";


		if ($_GET['id_entidades']!=0)
		{
			$id_entidades=$_GET['id_entidades'];
			$detallesql=$detallesql." AND cartones.id_entidades = '$id_entidades'";
		}
		
		
		if ($_GET['id_tipo_operaciones']!=0)
		{
			
			$id_tipo_operaciones= $_GET['id_tipo_operaciones'];
			$detallesql=$detallesql." AND cartones.id_tipo_operaciones = '$id_tipo_operaciones'";
		}
		
		if ($_GET['id_tipo_contenido_cartones']!=0)
		{
		
			$id_tipo_contenido_cartones= $_GET['id_tipo_contenido_cartones'];
			$detallesql=$detallesql." AND cartones.id_tipo_contenido_cartones = '$id_tipo_contenido_cartones'";
		}
		
		if ($_GET['numero_cartones']!="")
		{
		
			$numero_cartones= $_GET['numero_cartones'];
			$detallesql=$detallesql." AND cartones.numero_cartones = '$numero_cartones'";
		}
		
		if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
		{
		
			//$fecha_desde= $_GET['fecha_desde']. " 00:00:27.528-05";
			//$fecha_hasta= $_GET['fecha_hasta']. " 23:59:27.528-05";
			$fecha_desde= $_GET['fecha_desde'];
			$fecha_hasta= $_GET['fecha_hasta'];
			$detallesql=$detallesql." AND  cartones.creado BETWEEN '$fecha_desde' AND '$fecha_hasta'";
		}
		
		
		
$cabeceraSql="select      cartones.id_cartones,
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
		                          cartones.seccion_cartones
	
from	public.cartones, 
							  public.tipo_operaciones, 
							  public.bodegas, 
							  public.entidades, 
							  public.tipo_contenido_cartones
	
where		tipo_operaciones.id_tipo_operaciones = cartones.id_tipo_operaciones AND
							  bodegas.id_bodegas = cartones.id_bodegas AND
							  entidades.id_entidades = cartones.id_entidades AND
							  tipo_contenido_cartones.id_tipo_contenido_cartones = cartones.id_tipo_contenido_cartones";


$sql=$cabeceraSql.$detallesql;
		//, "_fecha_desde"=>$fecha_desde, "_fecha_hasta"=>$fecha_hasta

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("CartonesSubReport.jrxml");


////$PHPJasperXML = new PHPJasperXML();
////$PHPJasperXML->xml_dismantle($xml); 
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");


?>