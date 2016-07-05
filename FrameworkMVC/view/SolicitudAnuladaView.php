<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Aprobar Solicitud - bodega 2016</title>
        
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
  
     
    
    <h4 style="color:#ec971f;" align="center">SOLICITUD ANULADA</h4>
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
		    	
		      		
		      	
    			</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
		</nav>
   
   
    </div>
    
    <div class="col-xs-12 col-md-12" id="" style="display: ;" >
     	
        <section   class="col-xs-12 col-md-12" class="table table-hover "  style="max-height:300px; min-height:100px;">
        <table  class="table table-hover" >
	         <tr  class="fila">
	        	<th style="color:#456789;font-size:80%;"></th>
	        	<th style="color:#456789;font-size:80%;">Numero de Movimiento</th>
	    		<th style="color:#456789;font-size:80%;">Tipo Operaciones</th>
	    		<th style="color:#456789;font-size:80%;">Usuario Creador</th>
	    		<th style="color:#456789;font-size:80%;">Cantidad Cartones</th>
	    		<th style="color:#456789;font-size:80%;">Fecha de creacion</th>
	    		
	    	  </tr>
            
	          <?php if (!empty($resulCabecera)) {  foreach($resulCabecera as $res) {?>
	          <tr class="fila">
	        	    
	        	    <td >
	        	    </td>	        	            
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_movimientos_cabeza; ?>     </td> 
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_operaciones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->usuario_usuarios; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->cantidad_cartones_movimientos_cabeza; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>  </td>
		      </tr>
		      <?php } } ?>
		</table>     
		     
      </section>
      
    
    </div>
	
  <h4 style="color:#ec971f; margin-left: 30px;" align="left">Lista de Cartones</h4>
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
	    	  </tr>
            
	          <?php if (!empty($resulSet)) {  foreach($resulSet as $res) {?>
	          <tr class="fila">
	        	    <td style="color:#000000;font-size:80%;"> <?php  ?>     </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_cartones; ?>     </td> 
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->serie_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->contenido_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->year_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->cantidad_documentos_libros_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_contenido_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->digitalizado_cartones; ?>  </td>
		            <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>  </td>
		           
		      </tr>
		      <?php } } ?>
		</table>     
		     
      </section>
     </div>
  
   
  
   </div>
  </div>
  </body>  
</html>   