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
     
		       	<style>
		#tabla1 tr:hover{
			background:#9C0
		}
		#tabla1 tr.selected, #tabla1 tr.selected:hover{
			background:#F00
		}
		#tabla2 tr:hover{
			background:#9C0
		}
		#tabla2 tr.selected, #tabla2 tr.selected:hover{
			background:#F00
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
       
       .seleccionado {
          background:#9C0;
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
    
    <script>
    $(document).ready(function(){
    $('#contenido_busqueda').keyup(function(){
		var dato = $('#contenido_busqueda').val();
		var url = '<?php echo $helper->url("GenerarSolicitud","buscarCartones"); ?>';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
    });
    </script>
    
			
    
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
     	
     
     		 
     			
     	
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
     
      <form action="<?php echo $helper->url("GenerarSolicitud","InsertaGenerarSolicitud"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
    
    <h4 style="color:#ec971f;" ALIGN="center">GENERAR SOLICITUD</h4>
            	<hr/>
    
   <div  class="col-xs-6 col-md-6">
     
     	<h4 style="color:#ec971f;">Seleccionar Cartones</h4>
            <hr/>
     
     </div>
   <div  class="col-xs-6 col-md-6">
     
     	<h4 style="color:#ec971f;">Cartones Seleccionados</h4>
 		       <hr/>
         
     </div>
   
    
     <div  class="col-xs-6 col-md-6">
     
     <div class="row" >
     
     
    		<div class="col-xs-4 col-md-4">
			
           		<input type="text"  name="contenido_busqueda" id="contenido_busqueda" value="" class="form-control"/>
          		 <div id="mensaje_contenido_busqueda" class="errores"></div>
           	</div>
            
    </div>
    </div>
	<div class="col-xs-12 col-md-12">
      
    	 
		<div id="agrega-registros">
       <section   class="col-lg-5 usuario" class="table table-hover "  style="height:300px; overflow-y:scroll;     ">
        
        
        <table  class="tablaBBDD" >
	         <tr  class="fila">
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
        <div class="col-lg-1 usuario">
        		 <input type="button" id="pasar" value="Pasar Datos">
        </div>
        
        <section   class="col-lg-5 usuario" style="height:300px; overflow-y:scroll;">
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
		 
    
   
  
        </div>
    
    
    </form>
  

    </div>
   </div>
     </body>  
    </html>   