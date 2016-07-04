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
	<script >
	$(document).ready(function(){
			
		$("#visualizar_seleccionados").click(function(){

			
				$("#div_seleccionados").fadeIn("slow");
			    	
	  
		});
	});
	</script>
	<script >
	$(document).ready(function(){
	
		$("#div_seleccionados").fadeOut("slow");
		$("#seleccionados").fadeOut("slow");
		
	});
	</script>

    
  <style>
   
       .fila{
       
       }
       
       .seleccionado {
          background:#9C0;
       }
       
     </style>
    
   
    <script>
		function contador (campo, cuentacampo, limite) {
		if (campo.value.length > limite) campo.value = campo.value.substring(0, limite);
		else cuentacampo.value = limite - campo.value.length;
		} 
    </script>
   
   
    
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
      
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
     
    
    <h4 style="color:#ec971f;" align="center">GENERAR SOLICITUD</h4>
    <hr/>

	<div  class="col-xs-12 col-md-12">
	
	
	
 		<nav class="navbar navbar-default">
  			<div class="container-fluid">
   				 <!-- Brand and toggle get grouped for better mobile display -->
    			<div class="navbar-header">
      				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        				<span class="sr-only">Toggle navigation</span>
        				<span class="icon-bar"></span>
       					<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
      				</button>
     			</div>

    <!-- Collect the nav links, forms, and other content for toggling -->
		    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
		      		<button id="visualizar_seleccionados" class="btn btn-default" type="button" style="margin-top: 10px;">
					  Ver Seleccionados <span class="badge"><?php echo count($resultSol); ?></span>
					</button>
		      	
		      	
		      		<form class="navbar-form navbar-right" role="search" action="<?php echo $helper->url("GenerarSolicitud","index");?>"  method="post" >
		  		   	<div class="form-group">
		          		<input type="text" class="form-control" name="contenido_busqueda" id="criterio_busqueda" placeholder="texto a buscar">
		          		<select id="criterio_busqueda" name="criterio_busqueda" class="form-control">
							<option value="0"  >--Seleccione--</option>
							<option value="1"  >Numero de Carton</option>
							<option value="2"  >Serie de Documental</option>
							<option value="3"  >Número Carton</option>
							<option value="4"  >Años</option>
							<option value="6"  >Contenido</option>
						</select>
				   		<button type="submit" id="buscar" name="buscar" class="btn btn-default"><span class="glyphicon glyphicon-search	" ><?php echo " Buscar" ;?> </span></button>					   		
		        	</div>
		        
		      		</form>
		      
    			</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
		</nav>
   
   
    </div>
	<div class="col-xs-12 col-md-12" id="div_seleccionados" style="display: none;" >
     	
        <section   class="col-xs-12 col-md-12" class="table table-hover "  style="height:300px; overflow-y:scroll;     ">
        <table  class="table table-hover" >
	         <tr  class="fila">
	        	<th style="color:#456789;font-size:80%;"></th>
	        	<th style="color:#456789;font-size:80%;">Numero de Carton</th>
	    		<th style="color:#456789;font-size:80%;">Serie de Documental</th>
	    		<th style="color:#456789;font-size:80%;">Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Años</th>
	    		<th style="color:#456789;font-size:80%;">Cantidad de Documentos</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Digitalizado</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Entidades</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Bodegas</th>
	    	  </tr>
            
	          <?php if (!empty($resultSol)) {  foreach($resultSol as $res) {?>
	          <tr class="fila">
	        	    
	        	    <td >
	        	    	<a href="<?php echo $helper->url("GenerarSolicitud","index"); ?>&id_cartones_eliminar=<?php echo $res->id_cartones; ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  </a>
	        	    </td>
	        	            
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_cartones; ?>     </td> 
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->serie_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->contenido_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->year_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->cantidad_documentos_libros_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_contenido_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->digitalizado_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_bodegas; ?>  </td>
		      </tr>
		      <?php } } ?>
		</table>     
		     
      </section>
      
    
    </div>
  
  	<div class="col-xs-12 col-md-12">
     	
        <section   class="col-xs-12 col-md-12" class="table table-hover "  style="height:300px; overflow-y:scroll;     ">
        <table  class="table table-hover" >
	         <tr  class="fila">
	       
	        	<th style="color:#456789;font-size:80%;"></th>
	    		<th style="color:#456789;font-size:80%;">Numero de Carton</th>
	    		<th style="color:#456789;font-size:80%;">Serie de Documental</th>
	    		<th style="color:#456789;font-size:80%;">Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Años</th>
	    		<th style="color:#456789;font-size:80%;">Cantidad de Documentos</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Contenido</th>
	    		<th style="color:#456789;font-size:80%;">Digitalizado</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Entidades</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Bodegas</th>
	    	  </tr>
            
	          <?php if (!empty($resultDatos)) {  foreach($resultDatos as $res) {?>
	          <tr class="fila">
	        	    <td >
	        	    	<a href="<?php echo $helper->url("GenerarSolicitud","index"); ?>&id_cartones_agregar=<?php echo $res->id_cartones; ?>" class="btn btn-info"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  </a>
	        	    </td>
	        	    
	        	            
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_cartones; ?>     </td> 
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->serie_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->contenido_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->year_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->cantidad_documentos_libros_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_contenido_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->digitalizado_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_bodegas; ?>  </td>
		      </tr>
		      <?php } } ?>
		</table>     
		     
      </section>
     </div>
  
   <form action="<?php echo $helper->url("GenerarSolicitud","InsertaGenerarSolicitud");?>"  method="post" enctype="multipart/form-data"  class="col-lg-12">
	
	 <div class="row">
	<div class="col-xs-12 col-md-12" >
			  	<p  class="formulario-subtitulo" >Observaciones </p>
	          	<textarea  class="form-control" id="observaciones" name="observaciones" wrap="physical" rows="3"  onKeyDown="contador(this.form.observaciones,this.form.remLen,400);" onKeyUp="contador(this.form.observaciones,this.form.remLen,400);"></textarea>
	          	<p  class="formulario-subtitulo" >Te quedan <input type="text" name="remLen" size="2" maxlength="2" value="400" readonly="readonly"> letras por escribir. </p>
	        		   
    </div>
   
  
  
    <div class="col-xs-12 col-md-12">
	<div style="margin-top:10px ; text-align: center; " >
			  
     <input type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php echo $helper->url("GenerarSolicitud","index"); ?>'" value="Guardar" class="btn btn-success"/>
            </div>
       </div>    	 		
       </div>
   </form>
  
  
   </div>
  </div>
  </body>  
</html>   