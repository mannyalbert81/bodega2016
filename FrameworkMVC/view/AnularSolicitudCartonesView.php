 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Anular Solicitud Cartones - bodega 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 		
 		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
		
		
		
        <!-- AQUI NOTIFICAIONES -->
		<script type="text/javascript" src="view/css/lib/alertify.js"></script>
		<link rel="stylesheet" href="view/css/themes/alertify.core.css" />
		<link rel="stylesheet" href="view/css/themes/alertify.default.css" />
		
		
		
		<script>

		function Ok(){
				alertify.success("Has Pulsado en Buscar"); 
				return false;
			}
			
			function Borrar(){
				alertify.success("Has Pulsado en Borrar"); 
				return false; 
			}

			function notificacion(){
				alertify.success("Has Pulsado en Editar"); 
				return false; 
			}
		</script>
	<!-- TERMINA NOTIFICAIONES -->
        
        
       <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
         
         	<script>
	$(document).ready(function(){
			$("#fecha_hasta").change(function(){
				 var startDate = new Date($('#fecha_desde').val());

                 var endDate = new Date($('#fecha_hasta').val());

                 if (startDate > endDate){
 
                    $("#mensaje_fecha_hasta").text("Fecha desde no debe ser mayor ");
		    		$("#mensaje_fecha_hasta").fadeIn("slow"); //Muestra mensaje de error  
		    		$("#fecha_hasta").val("");

                        }
				});

			 $( "#fecha_hasta" ).focus(function() {
				  $("#mensaje_fecha_hasta").fadeOut("slow");
			   });
			});
        </script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php
       
       $sel_id_usuarios = "";
       $sel_numero_movimientos_cabeza="";
       $sel_fecha_desde="";
       $sel_fecha_hasta="";
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	
       	
       	$sel_id_usuarios = $_POST['id_usuarios'];
       	$sel_numero_movimientos_cabeza=$_POST['numero_movimientos_cabeza'];
       	$sel_fecha_desde=$_POST['fecha_desde'];
       	$sel_fecha_hasta=$_POST['fecha_hasta'];
       
       }
       ?>
 
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("AnularSolicitudCartones","anula_solicitud_cartones"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Anular Solicitud Cartones</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			<div class="col-xs-2"></div>
  			<div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Solicita:</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
			  		<option value="0"><?php echo "--Seleccione--";  ?> </option>
					<?php foreach($resultUsu as $res) {?>
						<option value="<?php echo $res->id_usuarios; ?>"<?php if($sel_id_usuarios==$res->id_usuarios){echo "selected";}?>><?php echo $res->nombre_usuarios;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		 
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Movimiento:</p>
			  	<input type="text"  name="numero_movimientos_cabeza" id="numero_movimientos_cabeza" value="<?php echo $sel_numero_movimientos_cabeza;?>" class="form-control"/> 
			    <div id="mensaje_numero_titulo" class="errores"></div>

         </div>
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_desde" id="fecha_desde" value="<?php echo $sel_fecha_desde;?>" class="form-control "/> 
			    <div id="mensaje_fecha_desde" class="errores"></div>
		</div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_hasta" id="fecha_hasta" value="<?php echo $sel_fecha_hasta;?>" class="form-control "/> 
			    <div id="mensaje_fecha_hasta" class="errores"></div>
		</div>
		 
  			</div>
  		
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
  		
		 <input type="submit" id="buscar" name="buscar" value="Buscar" onClick="Ok()" class="btn btn-warning " style="margin-top: 10px;"/> 
	     </div>
		 
		</div>
        	
		 </div>
		 
		 
		 <div class="col-lg-12">
		 
	      <div class="col-lg-12">
		 <div class="col-lg-10"></div>
		 <div class="col-lg-2">
		 <span class="form-control" style="margin-bottom:0px;"><strong>Registros:</strong><?php if(!empty($resultSet)) echo "  ".count($resultSet);?></span>
		 </div>
		 </div>
		 <div class="col-lg-12">
		 
		 
		 <section class="" style="height:300px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	            
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Numero Movimientos</th>
	    		<th style="color:#456789;font-size:80%;">Tipo Operación</th>
	    		<th style="color:#456789;font-size:80%;">Solicita</th>
	    		<th style="color:#456789;font-size:80%;">Observación</th>
	    		<th style="color:#456789;font-size:80%;">Cantidad de Cartones</th>
	    		<th style="color:#456789;font-size:80%;">Fecha Solicitud</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		
	        		  <td style="color:#000000;font-size:80%;"> <?php echo $res->id_movimientos_cabeza; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_movimientos_cabeza; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_operaciones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuarios; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->observaciones_movimientos; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->cantidad_cartones_movimientos_cabeza; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>  </td>
		               
	                   <td style="color:#000000;font-size:80%;">
	                   <div class="right">
			                    <a href="<?php echo $helper->url("AnularSolicitudCartones","borrarId"); ?>&id_movimientos_cabeza=<?php echo $res->id_movimientos_cabeza; ?>&numero_movimientos_cabeza=<?php echo $res->numero_movimientos_cabeza; ?>" class="btn btn-danger" style="font-size:75%;">Anular</a>
			                </div>
	                   
		              </td> 
		    		</tr>
		        <?php } }  ?>
           
       	</table>     
      </section>
		 
		 		 
		 </div>
		 </div>
		
		
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
   </body>  

    </html>   