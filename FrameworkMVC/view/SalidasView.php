<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Movimientos - bodega 2016</title>
        
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
		$("#id_ciudad").change(function(){

            // obtenemos el combo de resultado combo 2
           var $ddl_agente = $("#id_usuarioAgente");
       	

            // lo vaciamos
           var ddl_ciudad = $(this).val();

          
           $ddl_agente.empty();

          
            if(ddl_ciudad != 0)
            {
            	
            	 var datos = {
                   	   
           			   ciudad:$(this).val()
                  };
             
            	


         	   $.post("<?php echo $helper->url("AutoPagos","returnAgentesbyciudad"); ?>", datos, function(resultUsuarioAgenteC) {

         		 		$.each(resultUsuarioAgenteC, function(index, value) {
         		 			$ddl_agente.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
                    		 });

         		 		 	 		   
         		  }, 'json');


            }
            else
            {
                
         	   $ddl_resultado.empty();

            }
		//alert("hola;");
		});

		$("#id_ciudad").change(function(){

            // obtenemos el combo de resultado combo 2
           var $ddl_impulsor = $("#id_usuarioImpulsor");
       	

            // lo vaciamos
           var ddl_ciudad = $(this).val();

          
            $ddl_impulsor.empty();

          
            if(ddl_ciudad != 0)
            {
            	
            	 var datos = {
                   	   
           			   ciudad:$(this).val()
                  };
             
            	


         	   $.post("<?php echo $helper->url("AutoPagos","returnImpulsorbyciudad"); ?>", datos, function(resultUsuarioImpulC) {

         		 		$.each(resultUsuarioImpulC, function(index, value) {
            		 	    $ddl_impulsor.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
                    		 });

         		 		 	 		   
         		  }, 'json');


            }
            else
            {
                
         	   $ddl_impulsor.empty();

            }
		//alert("hola;");
		});
		});
	
       

	</script>
      <script >
		$(document).ready(function(){

			$("#Guardar").click(function()

			{

				var contenido = $("#contenido").val();
				var fecha_asignacion= $("#fecha_asignacion").val();

				if (contenido != "" && fecha_asignacion==0)
		    	{
					$("#mensaje_criterio").text("Seleccione una fecha");
		    		$("#mensaje_criterio").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_criterio").fadeOut("slow"); //Muestra mensaje de error
		    		
		            
				}    

				if (criterio !=0 && fecha_asignacion=="")
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
        
    
    		
			
	
    <script>
    $(document).ready(function(){
        $("#marcar_todo").change(function () {
            if ($(this).is(':checked')) {
               
                $(".marcados").prop('checked', true); 
            } else {
                
                $("input:checkbox").prop('checked', false);
                $("input[type=checkbox]").prop('checked', false);
            }
        });
        });
    </script>

    <script>
    $(document).ready(function(){
        
 		$("#buscar").click(function () {
             
             var fecha_asignacion = $("#fecha_asignacion").val();
             var contenido = $("#contenido_busqueda").val();
             if(fecha_asignacion!=0 && contenido==""){
          	   $("#mensaje_contenido").text("Ingrese contenido");
  	    	   $("#mensaje_contenido").fadeIn("slow"); //Muestra mensaje de error
                 return false;
                 }else if(fecha_asignacion==0 && contenido!=""){
               $("#mensaje_criterio").text("Selecione una busqueda");
        	   $("#mensaje_criterio").fadeIn("slow");
        	     return false;
                 }else{
                	 return true;
                     }
          });
          
          $( "#contenido_busqueda" ).focus(function() {
  			  $("#mensaje_contenido").fadeOut("slow");
  		    });
          $( "#fecha_asignacion" ).focus(function() {
  			  $("#mensaje_criterio").fadeOut("slow");
  		    });
        });

    </script>
    
    <script >
	$(document).ready(function(){

		$("#agregar").click(function(){

			var id_carton = $("#num_cartones").val();
			var nombre_carton = $("#num_cartones option:selected").text();
			var lista_cartones = $("#lista_carton");
			var cantidad_cartones = $("#total_cartones");

			cantidad_cartones.val("");
			
		    //alert(id_carton+' '+nombre_carton);

			 lista_cartones.append("<option value= " +id_carton +" selected>" + nombre_carton + "</option>");
			 
			 cantidad_cartones.val($('#lista_carton option').size()); 	

			
			});
		
		});
    </script>
    
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
     	$resultMenu_busqueda=array(0=>"Identificacion",1=>"Titulo Credito");
     	
     	
     	$sel_id_usuarioAgente = "";
     	$sel_id_usuarioImpulsor="";
     	$sel_id_cartones="";
     	$sel_fecha_asignacion="";
   
     		
     	if($_SERVER['REQUEST_METHOD']=='POST' )
     		{
     			$sel_id_usuarioAgente = $_POST['id_usuarioAgente'];
     			$sel_id_usuarioImpulsor=$_POST['id_usuarioImpulsor'];
     			$sel_id_cartones=$_POST['num_cartones'];
     			$sel_fecha_asignacion=$_POST['fecha_asignacion'];
     	
     		}
     	
     		 
     			
     	
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
     
      <form action="<?php echo $helper->url("Salidas","InsertaSalidas"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
    
    <div class="col-lg-5">
    <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
           <?php //no hay datos para editar?>
        
            
		     <?php } } else {?>
		     
		 
		    <h4 style="color:#ec971f;">Salidas</h4>
            	<hr/>
            	
           <div class="col-xs-5">
			  	<p  class="formulario-subtitulo" >Cartones</p>
			  	<select name="num_cartones" id="num_cartones"  class="form-control" >
			  	<option value="0" > --Seleccione-- </option>
					<?php foreach($resultCartones as $resCartones) {?>
						<option value="<?php echo $resCartones->id_cartones; ?>" <?php if($sel_id_cartones==$resCartones->id_cartones){echo "selected";}?> ><?php echo $resCartones->numero_cartones; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
            	
            <div class="col-xs-5">
			  <p  class="formulario-subtitulo" >Agregar Carton </p>
	          <input type="button" id="agregar" name="agregar" class="btn btn-default form-control" value="Add">
		   	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
            	
		   	
			  
			  <div class="col-xs-1"  style="width: 400px;">
			<hr>
			</div>
		
	
			
			<div class="col-xs-5">
			  <p  class="formulario-subtitulo" >Cartones </p>
	            	 <select size="10" name="lista_carton[]" id="lista_carton" multiple class="form-control">
	            	 
						</select> 
		   		   
		    </div>
		    
		    <div class="col-xs-5">
			  <p  class="formulario-subtitulo" > Total Cartones: </p>
	          <input type="text" id="total_cartones" name="total_cartones" class="form-control" value="">
		   		   
		    </div>
		    
		    <div class="col-xs-1"  style="width: 400px;">
			<hr>
			</div>
			
			
			
			 <div class="col-xs-5">
			  <p  class="formulario-subtitulo" >Observaciones </p>
	          <input type="text" id="observaciones" name="observaciones" class="form-control" value="" >
		   	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
		    
		    <div class="col-xs-1"  style="width: 400px;">
			<hr>
			</div>
		    
			  <div class="col-xs-10" style="text-align: center;" >
			  <p style="color:#ffffff;" >-----</p>
			
			  	<input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
			  </div>
			 
			<div class="col-xs-1"  style="width: 400px;">
			<hr>
			</div>
			 
			
			
      
             	
		     <?php } ?>
    </div>
    
    
    <div  class="col-lg-7">
     <h4 style="color:#ec971f;">Lista de Cartones</h4>
            <hr/>
    		<div class="col-xs-4">
			
           <input type="text"  name="contenido_busqueda" id="contenido_busqueda" value="" class="form-control"/>
           <div id="mensaje_contenido_busqueda" class="errores"></div>
            </div>
            
           <div class="col-xs-4">
           <select name="criterio_busqueda" id="criterio_busqueda"  class="form-control">
                                    <?php foreach($resultMenu_busqueda as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" <?php //if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
           
           <div class="col-xs-4" >
		
			  	<input type="submit" id="buscar" name="buscar"  onclick="this.form.action='<?php echo $helper->url("AutoPagos","index"); ?>'" value="buscar" class="btn btn-default"/>
			</div>
		<div class="col-xs-12" style="margin: 10px;">	

	</div>
	<div class="col-xs-12">
      
      
        
        <div class="col-lg-12">
		 <div class="col-lg-9"></div>
		 <div class="col-lg-3">
		 <span class="form-control" style="margin-bottom:0px;"><strong>Registros:</strong><?php if(!empty($resultDatos)) echo "  ".count($resultDatos);?></span>
		 </div>
		 </div>
		 <div class="col-lg-12">
		 
		 
       <section   style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><input type="checkbox" id="marcar_todo" class="checkbox"> </th>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Numero de Identifiación</th>
	    		<th style="color:#456789;font-size:80%;">Nombres Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Celular Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Total</th>
	    		<th style="color:#456789;font-size:80%;">Fecha Corte</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Ciudad</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultDatos)) {  foreach($resultDatos as $res) {?>
	        		<tr>
	        		<th style="color:#456789;font-size:80%;"><input type="checkbox" id="id_juicio[]"   name="id_juicio[]"  value="<?php echo $res->id_titulo_credito; ?>" class="marcados"></th>
	                 
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_titulo_credito; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->celular_clientes; ?>  </td>
		                <td style="color:#000000;font-size:80%;"> <?php echo $res->total; ?>  </td>
		                 <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_corte; ?>  </td>
		                 <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_ciudad; ?>  </td>
		             
		              
		           	   <td>
			           		
			                <hr/>
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
    
    </form>
  

    </div>
   </div>
     </body>  
    </html>   