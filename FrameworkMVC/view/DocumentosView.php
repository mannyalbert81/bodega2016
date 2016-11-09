


<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Documentos - bodega 2016</title>
        
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
		
        
        
        <script>
			function abrir() {
			//open('/FrameworkMVC/view/ireports/ContClientesReport.php','','top=500,left=500,width=500,height=500') ;
			open('','','top=500,left=500,width=500,height=500') ;
            
			}
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
       
         
        <script >
		$(document).ready(function(){

			$("#Buscar").click(function()

			{

				var contenido = $("#contenido").val();
				var criterio= $("#criterio").val();

				if (contenido != "" && criterio==0)
		    	{
					$("#mensaje_criterio").text("Seleccione filtro de busqueda");
		    		$("#mensaje_criterio").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_criterio").fadeOut("slow"); //Muestra mensaje de error
		    		
		            
				}    

				if (criterio !=0 && contenido=="")
		    	{

			    	
		    		$("#mensaje_contenido").text("Ingrese Contenido a buscar");
		    		$("#mensaje_contenido").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    	
		    		
			    }
		    	else 
		    	{
		    		$("#mensaje_contenido").fadeOut("slow"); //Muestra mensaje de error
		            
				}    


				

		
				
			});


			$( "#contenido" ).focus(function() {
				  $("#mensaje_contenido").fadeOut("slow");
			    });

			$( "#criterio" ).focus(function() {
				  $("#mensaje_criterio").fadeOut("slow");
			    });
		   
			
		});
			</script >
        
        
        
			
			
			<script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var identificacion_clientes = $("#identificacion_clientes").val();
		    	var nombres_clientes = $("#nombres_clientes").val();
		    	var telefono_clientes = $("#telefono_clientes").val();
		    	var celular_clientes = $("#celular_clientes").val();
		    	var direccion_clientes = $("#direccion_clientes").val();
		    	
		    	
		    	
		    	if (identificacion_clientes == "")
		    	{
			    	
		    		$("#mensaje_identificacion_clientes").text("Introduzca una Identificacion");
		    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}    
				
		    	if (nombres_clientes == "")
		    	{
			    	
		    		$("#mensaje_nombres_clientes").text("Introduzca un Nombre");
		    		$("#mensaje_nombres_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}  

		    	if (telefono_clientes == "")
		    	{
			    	
		    		$("#mensaje_telefono_clientes").text("Introduzca un Teléfono");
		    		$("#mensaje_telefono_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_telefono_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				} 

		    	if (celular_clientes == "")
		    	{
			    	
		    		$("#mensaje_celular_clientes").text("Introduzca un Celular");
		    		$("#mensaje_celular_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_celular_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	if (direccion_clientes == "")
		    	{
			    	
		    		$("#mensaje_direccion_clientes").text("Introduzca una Dirección");
		    		$("#mensaje_direccion_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_direccion_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

		    					    

			}); 

		    $( "#identificacion_clientes" ).focus(function() {
				  $("#mensaje_identificacion_clientes").fadeOut("slow");
			    });
				
		        $( "#nombres_clientes" ).focus(function() {
				  $("#mensaje_nombres_clientes").fadeOut("slow");
			    });

		        $( "#telefono_clientes" ).focus(function() {
					  $("#mensaje_telefono_clientes").fadeOut("slow");
				    });
		        $( "#celular_clientes" ).focus(function() {
					  $("#mensaje_celular_clientes").fadeOut("slow");
				    });
		        $( "#direccion_clientes" ).focus(function() {
					  $("#mensaje_direccion_clientes").fadeOut("slow");
				    });
				
		
				
		      
				    
		}); 

	</script>
	
    </head>
    <body style="background-color: #d9e3e4;" >
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
    
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
  <div></div>
    
      <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Documentos","InsertaDocumentos"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-4">
            
         
        	    <h4 style="color:#ec971f;">Insertar Documentos</h4>
            	<hr/>
            	
		   		
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            <div class="row">
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Area Documento</p>
			  	<select name="id_area_documentos" id="id_area_documentos"  class="form-control" >
					<?php foreach($resultArea as $res) {?>
						<option value="<?php echo $res->id_area_documentos; ?>" <?php if ($res->id_area_documentos == $resEdit->id_area_documentos ) echo ' selected="selected" '  ; ?> ><?php echo $res->nombre_area_documentos; ?> </option>
			      	
			        <?php } ?>
				</select> 
			  </div>
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Repositorio</p>
			    <select name="id_bodegas" id="id_bodegas"  class="form-control" >
					<?php foreach($resultBodegas as $res) {?>
						<option value="<?php echo $res->id_bodegas; ?>" <?php if ($res->id_bodegas == $resEdit->id_bodegas ) echo ' selected="selected" '  ; ?> ><?php echo $res->nombre_bodegas; ?> </option>
			       	
			        <?php } ?>
				</select>
			  </div>
			   </div>
			   
			   
		    <div class="row">
		    <div class="col-xs-6 col-md-6" style="margin-top: 10px">
			  	<p  class="formulario-subtitulo" >Tipo de Contenido </p>
		         <select name="id_tipo_documentos" id="id_tipo_documentos"  class="form-control" >
					<?php foreach($resultTipDoc as $res) {?>
						<option value="<?php echo $res->id_tipo_documentos; ?>" <?php if ($res->id_tipo_documentos == $resEdit->id_tipo_documentos ) echo ' selected="selected" '  ; ?> ><?php echo $res->nombre_tipo_documentos; ?> </option>
			           
			        <?php } ?>
				</select>	  	
		     </div>
			  
			  <div class="col-xs-6 col-md-6" style="margin-top: 10px">
			  	<p  class="formulario-subtitulo" >Numero de Carton</p>
			  <select name="id_cartones" id="id_cartones"  class="form-control" >
					<?php foreach($resultCartones as $res) {?>
						<option value="<?php echo $res->id_cartones; ?>" <?php if ($res->id_cartones == $resEdit->id_cartones ) echo ' selected="selected" '  ; ?> ><?php echo $res->numero_cartones; ?> </option>
			           
			        <?php } ?>
				</select>
			  </div>
			  
		    </div>
		    
		    <div class="row">
		    <div class="col-xs-6 col-md-6" style="margin-top: 10px">
			  	<p  class="formulario-subtitulo" >Serie </p>
			  	<input type="text" name="serie_documentos" id="serie_documentos" value="<?php echo $resEdit->serie_documentos; ?>" class="form-control"/>
			  </div>
			  
			  <div class="col-xs-6 col-md-6" style="margin-top: 10px">
			  	<p  class="formulario-subtitulo" >Contenido</p>
			  	<input type="text" name="contenido_documentos" id="contenido_documentos" value="<?php echo $resEdit->contenido_documentos; ?>" class="form-control"/>
			  </div>
			  
		    </div>
		  
		    <hr>
		   
            
		     <?php } } else {?>
		    
		    <div class="row">
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Area Documento</p>
			  	<select name="id_area_documentos" id="id_area_documentos"  class="form-control" >
					<?php foreach($resultArea as $res) {?>
						<option value="<?php echo $res->id_area_documentos; ?>"  ><?php echo $res->nombre_area_documentos; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Repositorio</p>
			    <select name="id_bodegas" id="id_bodegas"  class="form-control" >
					<?php foreach($resultBodegas as $res) {?>
						<option value="<?php echo $res->id_bodegas; ?>"  ><?php echo $res->nombre_bodegas; ?> </option>
			        <?php } ?>
				</select>
			  </div>
			   </div>
			   
			   
		    <div class="row">
		    <div class="col-xs-6 col-md-6" style="margin-top: 10px">
			  	<p  class="formulario-subtitulo" >Tipo de Contenido </p>
		         <select name="id_tipo_documentos" id="id_tipo_documentos"  class="form-control" >
					<?php foreach($resultTipDoc as $res) {?>
						<option value="<?php echo $res->id_tipo_documentos; ?>"  ><?php echo $res->nombre_tipo_documentos; ?> </option>
			        <?php } ?>
				</select>	  	
		     </div>
			  
			  <div class="col-xs-6 col-md-6" style="margin-top: 10px">
			  	<p  class="formulario-subtitulo" >Numero de Carton</p>
			  <select name="id_cartones" id="id_cartones"  class="form-control" >
					<?php foreach($resultCartones as $res) {?>
						<option value="<?php echo $res->id_cartones; ?>"  ><?php echo $res->numero_cartones; ?> </option>
			        <?php } ?>
				</select>
			  </div>
			  
		    </div>
		    
		    <div class="row">
		    <div class="col-xs-6 col-md-6" style="margin-top: 10px">
			  	<p  class="formulario-subtitulo" >Serie </p>
			  	<input type="text" name="serie_documentos" id="serie_documentos" value="" class="form-control"/>
			  </div>
			  
			  <div class="col-xs-6 col-md-6" style="margin-top: 10px">
			  	<p  class="formulario-subtitulo" >Contenido</p>
			  	<input type="text" name="contenido_documentos" id="contenido_documentos" value="" class="form-control"/>
			  </div>
			  
		    </div>
		  
		    <hr>
		    
		   
               	
		     <?php } ?>
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
			  </div>
			</div>     
               
		
		 <hr>
          
          </form>
       
         <!-- termina el form -->
       
        <div class="col-lg-8">
            <h4 style="color:#ec971f;">Lista de Documentos</h4>
           
     <!-- empieza formulario de busqueda -->
     
            <hr>
        <div class="row">
           <form action="<?php echo $helper->url("Documentos","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
           
           <div class="col-lg-3">
           <input type="text"  name="contenido" id="contenido" value="" class="form-control"/>
           <div id="mensaje_contenido" class="errores"></div>
            </div>
            
           <div class="col-lg-3">
           <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" <?php //if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
          
          
           <div class="col-lg-3">
           <input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-default"/>
           </div>
         
          </form>
          
       <!-- termina formulario de busqueda -->
        <hr/>
         
       <section class="col-lg-12  usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Area</th>
	    		<th style="color:#456789;font-size:80%;">Bodega</th>
	    		<th style="color:#456789;font-size:80%;">Tipo Documento</th>
	    		<th style="color:#456789;font-size:80%;">N° Carton</th>
	    		<th style="color:#456789;font-size:80%;">Serie</th>
	    		<th style="color:#456789;font-size:80%;">Contenido</th>
	    		
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_documentos; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_area_documentos; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_bodegas; ?>  </td>
		             <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_documentos; ?>  </td>
		             <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_cartones; ?>  </td>
		             <td style="color:#000000;font-size:80%;"> <?php echo $res->serie_documentos; ?>  </td>
		             <td style="color:#000000;font-size:80%;"> <?php echo $res->contenido_documentos; ?>  </td>
		             
		               <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Documentos","index"); ?>&id_documentos=<?php echo $res->id_documentos; ?>" class="btn btn-warning" onClick="Borrar()" style="font-size:65%;">Editar</a>
			                </div>
			              
		               </td>
		                <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Documentos","borrarId"); ?>&id_documentos=<?php echo $res->id_documentos; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
			              
		               </td>
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
   
            ?>
            
       	</table>     
		     
      </section>
        
        </div>
       
       
      
      </div>
      </div>
   </div>
     </body>  
    </html>   