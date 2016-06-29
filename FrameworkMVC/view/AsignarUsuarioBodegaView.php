


<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Asignar Usuario Bodega- bodega 2016</title>
        
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
	
	<script >   
    function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
    if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
     }
    </script > 
	
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
       
      <form action="<?php echo $helper->url("AsignarUsuarioBodega","InsertaAsignarUsuarioBodega"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            
         
        	    <h4 style="color:#ec971f;">Asignar Usuarios Bodegas</h4>
            	<hr/>
            	
		   		
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            
         <div class="row">
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuarios</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
			  	<option value="">--Seleccione-- </option>
					<?php foreach($resultUsu as $res) {?>
					<option value="<?php echo $res->id_usuarios; ?>"  <?php if ($res->id_usuarios == $resEdit->id_usuarios ) echo ' selected="selected" '  ; ?> ><?php echo $res->nombre_usuarios; ?> </option>
					
						  <?php } ?>
				</select> 			  
			  </div>
		    
		   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Bodegas</p>
			  	<select name="id_bodegas" id="id_bodegas"  class="form-control" >
			  	<option value="">--Seleccione-- </option>
					<?php foreach($resultBodegas as $res) {?>
					<option value="<?php echo $res->id_bodegas; ?>"  <?php if ($res->id_bodegas == $resEdit->id_bodegas ) echo ' selected="selected" '  ; ?> ><?php echo $res->nombre_bodegas; ?> </option>
					
						  <?php } ?>
				</select> 			  
			  </div>
			  
			  </div>
			   
			   
		    
		    
		    <hr>
		    
         
            
            
		     <?php } } else {?>
		    
		    <div class="row">
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuarios</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<option value="">--Seleccione-- </option>
					
					<?php foreach($resultUsu as $res) {?>
						<option value="<?php echo $res->id_usuarios; ?>"  ><?php echo $res->nombre_usuarios; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
		    
		   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Bodegas</p>
			  	<select name="id_bodegas" id="id_bodegas"  class="form-control" >
					<option value="">--Seleccione-- </option>
					<?php foreach($resultBodegas as $res) {?>
						<option value="<?php echo $res->id_bodegas; ?>"  ><?php echo $res->nombre_bodegas; ?> </option>
			        <?php } ?>
				</select> 			  
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
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Asignaciones Realizadas</h4>
           
     <!-- empieza formulario de busqueda -->
     
            <hr>
        <div class="row">
           <form action="<?php echo $helper->url("AsignarUsuarioBodega","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
           
           <div class="col-lg-4">
           <input type="text"  name="contenido" id="contenido" value="" class="form-control"/>
           <div id="mensaje_contenido" class="errores"></div>
            </div>
            
           <div class="col-lg-4">
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
         
       <section class="col-lg-12  cartones" style="height:500px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Usuario</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Rol</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Bodega</th>
	    		<th style="color:#456789;font-size:80%;">Fecha Asignacion</th>
	    	
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_asignacion_usuarios_bodegas; ?></td>
		                <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuarios; ?>  </td>
		                <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_rol; ?>  </td>
		           	   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_bodegas; ?>  </td>
		           	   <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>  </td>
		           	  
		           	  
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("AsignarUsuarioBodega","index"); ?>&id_asignacion_usuarios_bodegas=<?php echo $res->id_asignacion_usuarios_bodegas; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("AsignarUsuarioBodega","borrarId"); ?>&id_asignacion_usuarios_bodegas=<?php echo $res->id_asignacion_usuarios_bodegas; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
			                </div>
			              
		               </td>
		               
		               
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            //<a href="javascript:abrir('/FrameworkMVC/view/ireports/ContClientesReport.php')" class="btn btn-success" style="font-size:65%;">Reporte</a>
            
            ?>
            
       	</table>     
		     
      </section>
        
        </div>
       
       
      
      </div>
      </div>
   </div>
     </body>  
    </html>   