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

  <style>
   
       .fila{
       
       }
       
       .seleccionado{
          background: rgb(255,255,153);
       }
     </style>
    
    <script src="jquery.js"></script>
    <script>
      $(function(){          
          $("table.tablaBBDD tr").each(function(){
            $(this).click(function(){
              if($(this).attr("class") == 'fila'){
                $(this).removeClass('fila');
                $(this).addClass('seleccionado');   
              }else{
                $(this).removeClass('seleccionado');
                $(this).addClass('fila');
              }   
            })
          });
         $("#pasar").click(function(){
            $("table.tablaBBDD tr").each(function(){
               if($(this).attr("class") == 'seleccionado'){
                  $("#guardarRegistros").append($(this));
               } 
            })
         }) 
                       
      })
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
    
    <h4 style="color:#ec971f;" ALIGN="center">GENERAR SOLICITUD</h4>
            	<hr/>
    
   
    
     <div  class="col-lg-6">
     <h4 style="color:#ec971f;">Seleccionar Cartones</h4>
            <hr/>
            <div class="col-xs-2">
            </div>
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
           
           <div class="col-xs-2" >
		
			  	<input type="submit" id="buscar" name="buscar"  onclick="this.form.action='<?php echo $helper->url("GenerarSolicitud","index"); ?>'" value="buscar" class="btn btn-default"/>
			</div>
		
	<div class="col-xs-12">
      
    	 
		 
       <section   class="col-lg-6 usuario"   style="height:300px; overflow-y:scroll;     ">
        
        
        <table  class="tablaBBDD" >
	         <tr  class="fila">
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
	        		<tr class="fila">
	        		
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
    <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
           <?php //no hay datos para editar?>
        
            
		     <?php } } else {?>
		     
		 
		    
            	
           
      
             	
		     <?php } ?>
   
    <div  class="col-lg-6">
     <h4 style="color:#ec971f;">Cartones Seleccionados</h4>
            <hr/>
    		
            
           
        
		<div class="col-xs-12" style="margin: 20px;">	

	</div>
	<div class="col-xs-12">
      
      
       <section   class="col-lg-6 usuario" style="height:300px; overflow-y:scroll;">
        <table id="guardarRegistros">
        <tr>
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
	    		</tr>
       	</table>     
		     
      </section>
        </div>
        
        <div class="col-xs-5">
         <input type="button" id="pasar" value="Pasar Datos">
        </div>
		 </div>
    
        </div>
    
    
    </form>
  

    </div>
   </div>
     </body>  
    </html>   