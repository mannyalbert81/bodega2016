 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Consulta Cartones - bodega 2016</title>
        
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
       
      
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Cartones","consulta_cartones"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Consulta Cartones</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  			
		   			
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Entidad:</p>
			  	<select name="id_entidades" id="id_entidades"  class="form-control" >
			  		<option value="0"><?php echo "--Seleccione--";  ?> </option>
					<?php foreach($resultEnt as $res) {?>
						<option value="<?php echo $res->id_entidades; ?>"><?php echo $res->nombre_entidades;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		 <div class="col-xs-2 ">
			    <p  class="formulario-subtitulo" style="" >Tipo Operación:</p>
			  	<select name="id_tipo_operaciones" id="id_tipo_operaciones"  class="form-control" >
			  		<option value="0"><?php echo "--Seleccione--";  ?> </option>
					<?php foreach($resultTipoOpe as $res) {?>
						<option value="<?php echo $res->id_tipo_operaciones; ?>"><?php echo $res->nombre_tipo_operaciones;  ?> </option>
			            <?php } ?>
				</select>	

         </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" style="" >Tipo Contenido Carton:</p>
			  	<select name="id_tipo_contenido_cartones" id="id_tipo_contenido_cartones"  class="form-control" >
			  		<option value="0"><?php echo "--Seleccione--";  ?> </option>
					<?php foreach($resultTipoCont as $res) {?>
						<option value="<?php echo $res->id_tipo_contenido_cartones; ?>"><?php echo $res->nombre_tipo_contenido_cartones;  ?> </option>
			            <?php } ?>
				</select>

         </div>
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Carton:</p>
			  	<input type="text"  name="numero_cartones" id="numero_cartones" value="" class="form-control"/> 
			    <div id="mensaje_numero_titulo" class="errores"></div>

         </div>
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_desde" id="fecha_desde" value="" class="form-control "/> 
			    <div id="mensaje_fecha_desde" class="errores"></div>
		</div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_hasta" id="fecha_hasta" value="" class="form-control "/> 
			    <div id="mensaje_fecha_hasta" class="errores"></div>
		</div>
		 
  			</div>
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
		 <input type="submit" id="buscar" name="buscar" value="Buscar" class="btn btn-warning " style="margin-top: 10px;"/> 	
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
	    		<th style="color:#456789;font-size:80%;">Serie</th>
	    		<th style="color:#456789;font-size:80%;">Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Años</th>
	    		<th style="color:#456789;font-size:80%;">Cantidad de Documentos</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Digitalizado</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Entidades</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Bodegas</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Tipo Operacion</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		
	        		  <td style="color:#000000;font-size:80%;"> <?php echo $res->id_cartones; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_cartones; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->serie_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->contenido_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->year_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->cantidad_documentos_libros_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_contenido_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->digitalizado_cartones; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_bodegas; ?>  </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_operaciones; ?>  </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>  </td>
	                   
	                  
	                   <td style="color:#000000;font-size:80%;">
		               <a href="/FrameworkMVC/view/ireports/ContCartonesSubReport.php?id_cartones=<?php echo $res->id_cartones; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" class="btn btn-success" style="font-size:80%;">Reporte</a>
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