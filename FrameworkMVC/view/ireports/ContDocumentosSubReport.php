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


$sel_id_areas_documentos=0;
$sel_id_bodegas=0;
$sel_numero_cartones=0;
$sel_id_tipo_documentos=0;
$sel_seccion_cartones=0;
$sel_id_tipo_contenido_cartones=0;
$sql="";
$detallesql="";





        if ($_GET['id_areas_documentos']!=0)
		{
			$sel_id_areas_documentos=$_GET['id_areas_documentos'];
			$detallesql=$detallesql." AND area_doumentos.id_areas_documentos = '$sel_id_areas_documentos'";
		}
		
		if ($_GET['id_bodegas']!=0)
		{
		
			$sel_id_bodegas= $_GET['id_bodegas'];
			$detallesql=$detallesql." AND bodegas.id_bodegas = '$sel_id_bodegas'";
		}
		
		if ($_GET['numero_cartones']!="")
		{
		
			$numero_cartones= $_GET['numero_cartones'];
			$detallesql=$detallesql." AND cartones.numero_cartones = '$numero_cartones'";
		}
		if ($_GET['id_tipo_documentos']!=0)
		{
		
			$sel_id_tipo_documentos= $_GET['id_tipo_documentos'];
			$detallesql=$detallesql." AND tipo_documentos.id_tipo_documentos = '$sel_id_tipo_documentos'";
		}
		if ($_GET['seccion_cartones']!="")
		{
		
			$sel_seccion_cartones= $_GET['seccion_cartones'];
			$detallesql=$detallesql." AND cartones.seccion_cartones = '$sel_seccion_cartones'";
		}
		if ($_GET['id_tipo_contenido_cartones']!=0)
		{
		
			$sel_id_tipo_contenido_cartones= $_GET['id_tipo_contenido_cartones'];
			$detallesql=$detallesql." AND tipo_contenido_cartones.id_tipo_contenido_cartones = '$sel_id_tipo_contenido_cartones'";
		}
		
		
		
		
$cabeceraSql="select      documentos.id_documentos, 
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
							  documentos.serie_documentos
	
from	public.area_doumentos, 
							  public.documentos, 
							  public.bodegas, 
							  public.tipo_documentos, 
							  public.cartones, 
							  public.entidades, 
							  public.ciudad, 
							  public.tipo_contenido_cartones, 
							  public.tipo_operaciones
	
where		documentos.id_area_documentos = area_doumentos.id_areas_documentos AND
							  documentos.id_bodegas = bodegas.id_bodegas AND
							  documentos.id_tipo_documentos = tipo_documentos.id_tipo_documentos AND
							  cartones.id_cartones = documentos.id_cartones AND
							  cartones.id_entidades = entidades.id_entidades AND
							  cartones.id_ciudad = ciudad.id_ciudad AND
							  cartones.id_tipo_contenido_cartones = tipo_contenido_cartones.id_tipo_contenido_cartones AND
  					          cartones.id_tipo_operaciones = tipo_operaciones.id_tipo_operaciones";


$sql=$cabeceraSql.$detallesql;
		//, "_fecha_desde"=>$fecha_desde, "_fecha_hasta"=>$fecha_hasta

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("DocumentosCartonesSubReport.jrxml");


////$PHPJasperXML = new PHPJasperXML();
////$PHPJasperXML->xml_dismantle($xml); 
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");


?>