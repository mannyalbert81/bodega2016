 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Consulta Documentos Cartones - bodega 2016</title>
        
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
				alertify.success("Has Pulsado en Guardar"); 
				return false;
			}
			
			function Borrar(){
				alertify.success("Has Pulsado en Buscar"); 
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
       
       $sel_id_areas_documentos = "";
       $sel_id_bodegas="";
       $sel_numero_cartones="";
       $sel_id_tipo_documentos="";
       $sel_seccion_cartones="";
       $sel_id_tipo_contenido_cartones="";
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	
       	
       	$sel_id_areas_documentos = $_POST['id_areas_documentos'];
        $sel_id_bodegas=$_POST['id_bodegas'];
       	$sel_numero_cartones=$_POST['numero_cartones'];
       	$sel_id_tipo_documentos=$_POST['id_tipo_documentos'];
       	$sel_seccion_cartones=$_POST['seccion_cartones'];
       	$sel_id_tipo_contenido_cartones=$_POST['id_tipo_contenido_cartones'];
       	 
       }
       ?>
 
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("DocumentosCartones","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Consulta Documentos Cartones</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  		 <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" >Area Documento</p>
			  	<select name="id_areas_documentos" id="id_areas_documentos"  class="form-control" >
					<option value="0"><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultArea as $res) {?>
						<option value="<?php echo $res->id_area_documentos; ?>" <?php if($sel_id_areas_documentos==$res->id_area_documentos){echo "selected";}?> ><?php echo $res->nombre_area_documentos; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
		    
		  <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Bodega:</p>
			  	<select name="id_bodegas" id="id_bodegas"  class="form-control" >
			  		<option value="0"><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultBodegas as $res) {?>
						<option value="<?php echo $res->id_bodegas; ?>"<?php if($sel_id_bodegas==$res->id_bodegas){echo "selected";}?>><?php echo $res->nombre_bodegas;  ?> </option>
			            <?php } ?>
				</select>
		 </div> 			
          
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Tipo Documentos:</p>
			  	<select name="id_tipo_documentos" id="id_tipo_documentos"  class="form-control" >
			  		<option value="0"><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultTipDoc as $res) {?>
						<option value="<?php echo $res->id_tipo_documentos; ?>"<?php if($sel_id_tipo_documentos==$res->id_tipo_documentos){echo "selected";}?>><?php echo $res->nombre_tipo_documentos;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" style="" >Tipo Contenido Carton:</p>
			  	<select name="id_tipo_contenido_cartones" id="id_tipo_contenido_cartones"  class="form-control" >
			  		<option value="0"><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultTipoCont as $res) {?>
						<option value="<?php echo $res->id_tipo_contenido_cartones; ?>"<?php if($sel_id_tipo_contenido_cartones==$res->id_tipo_contenido_cartones){echo "selected";}?> ><?php echo $res->nombre_tipo_contenido_cartones;  ?> </option>
			            <?php } ?>
				</select>

         </div>
         <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Sección:</p>
			  	<select name="seccion_cartones" id="seccion_cartones"  class="form-control" >
			  		<option value=""><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultSecc as $res) {?>
						<option value="<?php echo $res->seccion_cartones; ?>"<?php if($sel_seccion_cartones==$res->seccion_cartones){echo "selected";}?>><?php echo $res->seccion_cartones;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Carton:</p>
			  	<input type="text"  name="numero_cartones" id="numero_cartones" value="<?php echo $sel_numero_cartones;?>" class="form-control"/> 
			    <div id="mensaje_numero_titulo" class="errores"></div>

         </div>
         
        
  			</div>
  		
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
  		
		 <input type="submit" id="buscar" name="buscar" value="Buscar"  onClick="Borrar()" class="btn btn-warning " style="margin-top: 10px;"/> 
	    
	  <?php if(!empty($resultSet))  {?>
		 <a href="/bodega_territorial/FrameworkMVC/view/ireports/ContDocumentosSubReport.php?id_areas_documentos=<?php  echo $sel_id_areas_documentos ?>&id_bodegas=<?php  echo $sel_id_bodegas?>&numero_cartones=<?php  echo $sel_numero_cartones?>&id_tipo_documentos=<?php  echo $sel_id_tipo_documentos?>&seccion_cartones=<?php  echo $sel_seccion_cartones?>&id_tipo_contenido_cartones=<?php echo sel_id_tipo_contenido_cartones?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success">Reporte</a>
		            
		  <?php } else {?>
		  
		  <?php } ?>
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
	    		<th style="color:#456789;font-size:80%;">Numero</th>
	    		<th style="color:#456789;font-size:80%;">Serie Carton</th>
	    		<th style="color:#456789;font-size:80%;">Sección</th>
	    		<th style="color:#456789;font-size:80%;">Contenido Carton</th>
	    		<th style="color:#456789;font-size:80%;">Años</th>
	    		<th style="color:#456789;font-size:80%;">Cantidad de Documentos</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Digitalizado</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Entidades</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Bodegas</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Tipo Operacion</th>
	    		<th style="color:#456789;font-size:80%;">Contenido Documentos</th>
	    		<th style="color:#456789;font-size:80%;">Serie Documentos</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
             <?php  $paginas =   0;  ?>
		    <?php  $registros = 0; ?>
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		
	        		  <td style="color:#000000;font-size:80%;"> <?php echo $res->id_cartones; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_cartones; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->serie_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->seccion_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->contenido_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->year_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->cantidad_documentos_libros_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_contenido_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php if($res->digitalizado_cartones=="t"){echo "Si";}else {echo "No";} ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_bodegas; ?>  </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_operaciones; ?>  </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->contenido_documentos; ?>  </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->serie_documentos; ?>  </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>  </td>
	                   
		    		</tr>
		        <?php  }  ?>
           
       	</table>     
      </section>
		 <table class="table">
				<th class="text-center">
				    	<nav>
						  <ul id="pagina" name="pagina" class="pagination">
						    <?php if ($paginasTotales > 0) {?>
						    		<?php if ($ultima_pagina > 1 ) {?>
						    			<input type="submit" value="<?php echo "<<"; ?>" id="anterior_pagina"    name="anterior_pagina" class="btn btn-info"/>
						    		<?php }?>
						    <?php for ($i = $ultima_pagina; $i< $paginasTotales+1; $i++)  { ?>
						    		
						    		<?php if ($i  < $ultima_pagina + 5) {  ?>
						    			<input type="hidden" value="<?php echo $i+1; ?>" id="ultima_pagina"    name="ultima_pagina" class="btn btn-info"/>
						    			<input type="submit" value="<?php echo $i; ?>" id="pagina"  <?php if ($i == $pagina_actual ) { echo 'style="color: #1454a3 " '; }  ?>     name="pagina" class="btn btn-info"/>
						    			
						    		<?php } ?>
						    		<?php if ($paginasTotales  == $i) {  ?>
						    			<input type="submit" value="<?php echo ">>"; ?>" id="siguiente_pagina"    name="siguiente_pagina" class="btn btn-info"/>
						    		<?php } ?>
						    		
						    <?php    } }?>
						    
						  </ul>
						</nav>	   	   
			
				</th>
				<tr class="bg-primary">
						<p class="text-center"> <strong> Registros Cargados: <?php echo  $registros?> Registros Totales: <?php echo  $registrosTotales?> </strong>  </p>
	     		  	
				</tr>			
		</table>
		 	
 				<?php  }   else { ?>
		        <?php }  ?>  
		 		 
		 </div>
		 </div>
		
		
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
   </body>  

    </html>   