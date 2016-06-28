<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Generar Solicitud - bodega 2016</title>
        
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
    
    <script>
        $().ready(function() 
	   {
		$('.pasar').click(function() {   !$('#origen option:selected').remove().appendTo('#destino'); $('#total_cartones').val($('#destino option').size()); return  true;});  
		$('.quitar').click(function() { !$('#destino option:selected').remove().appendTo('#origen'); $('#total_cartones').val($('#destino option').size()); return true});
		$('.pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#destino'); $('#total_cartones').val($('#destino option').size());  }); });
		$('.quitartodos').click(function() { $('#destino option').each(function() { $(this).remove().appendTo('#origen'); $('#total_cartones').val($('#destino option').size()); return  true;}); });
		$('.submit').click(function() { $('#destino option').prop('selected', 'selected'); });
	  });
    </script>
    
    
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
     	$resultMenu_busqueda=array(0=>'--Seleccione--',1=>'Numero', 2=>'Serie', 3=>'Contenido', 4=>'Año', 5=>'Cantidad Documentos', 6=>'Nombre Contenido', 7=>'Digitalizado', 8=>'Nombre Entidades', 9=>'Nombre Bodega');
     	
     	
     
     		 
     			
     	
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
     
      <form action="<?php echo $helper->url("GenerarSolicitud","InsertaGenerarSolicitud"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
    
    <div class="col-lg-5">
    <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
           <?php //no hay datos para editar?>
        
            
		     <?php } } else {?>
		     
		 
		    <h4 style="color:#ec971f;">GENERAR SOLICITUD</h4>
            	<hr/>
            	
            <div class="row"> 
            <div class="col-xs-3">
			  <p  class="formulario-subtitulo" ><font color="White">Agregar </font></p>
	           <select  name="destino[]" id="destino" multiple="multiple" size="10" class="form-control"></select> 
		   	 </div>
		   	  <div class="col-xs-2">
             <p  class="formulario-subtitulo" ><font color="White">.</font></p>
			 <p  class="formulario-subtitulo" ><font color="White">.</font></p> 
	          <input type="button" class="pasar izq" value="Pasar »"><input type="button" class="quitar der" value="« Quitar"><br />
	         <input type="button" class="pasartodos izq" value="Todos »"><input type="button" class="quitartodos der" value="« Todos">
	       	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
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
		
			  	<input type="submit" id="buscar" name="buscar"  onclick="this.form.action='<?php echo $helper->url("GenerarSolicitud","index"); ?>'" value="buscar" class="btn btn-default"/>
			</div>
		<div class="col-xs-12" style="margin: 10px;">	

	</div>
	<div class="col-xs-12">
      
      
        
   
		 
		 
		 
       <section   style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	         <th style="color:#456789;font-size:80%;"><input type="checkbox" id="marcar_todo" name="origen[]" id="origen" class="checkbox"> </th>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Numero de Cartones</th>
	    		<th style="color:#456789;font-size:80%;">Serie de Cartones</th>
	    		<th style="color:#456789;font-size:80%;">Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Años</th>
	    		<th style="color:#456789;font-size:80%;">Cantidad de Documentos</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Digitalizado</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Entidades</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Bodegas</th>
	    		
	    		
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultDatos)) {  foreach($resultDatos as $res) {?>
	        		<tr>
	        		<th style="color:#456789;font-size:80%;"><input type="checkbox" id="id_cartones[]"   name="id_cartones[]"  value="<?php echo $res->id_cartones; ?>" class="marcados"></th>
	                 
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
    
    
    </form>
  

    </div>
   </div>
     </body>  
    </html>   