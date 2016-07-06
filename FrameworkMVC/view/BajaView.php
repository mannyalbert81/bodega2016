<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Baja - bodega 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
   		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
 		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
		<link href="view/css/jqueryui.css" type="text/css" rel="stylesheet"/>
		
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="view/css/functions.js"></script>
	
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
				alertify.success("Has Pulsado en Quitar"); 
				return false; 
			}

			function notificacion(){
				alertify.success("Has Pulsado en Pasar"); 
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
        $().ready(function() 
	   {
		$('#pasar').click(function() 
		 {   !$('#origen option:selected').remove().appendTo('#destino'); 
		      $('#total_cartones').val($('#destino option').size()); 
		      return  true;});
	        
		$('#quitar').click(function() { !$('#destino option:selected').remove().appendTo('#origen'); $('#total_cartones').val($('#destino option').size()); return true});
		$('#pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#destino'); $('#total_cartones').val($('#destino option').size());  }); });
		$('#quitartodos').click(function() { $('#destino option').each(function() { $(this).remove().appendTo('#origen'); $('#total_cartones').val($('#destino option').size()); return  true;}); });
		$('#btnGuardar').click(function() 
	    	{ 
				
			$('#destino option').prop('selected', 'selected'); 

			});
	  });
    </script>
    
    
    
     
     
    <script>
	       	$(document).ready(function(){ 	
				$( "#busqueda" ).autocomplete({
      				source: "<?php echo $helper->url("Movimientos","AutocompleteMovimientos"); ?>",
      				minLength: 1
    			});

				$("#busqueda").focusout(function(){
    				$.ajax({
    					url:'<?php echo $helper->url("Movimientos","AutocompleteMovimientosId"); ?>',
    					type:'POST',
    					dataType:'json',
    					data:{numero_carton:$('#busqueda').val()}
    				}).done(function(respuesta){

    					$('#destino').append('<option value="'+respuesta.id_cartones+'" selected>'+$('#busqueda').val()+' </option>')
    					$('#busqueda').val("");
    					$('#total_cartones').val($('#destino option').size());
        			});
    				 
    				
    			});   
				
    		});

			
     </script>
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
       
       <?php
       
     	$sel_id_cartones="";
     	
   
     	if($_SERVER['REQUEST_METHOD']=='POST' )
     		{
     			
     			$sel_id_cartones=$_POST['num_cartones'];
     			
     	
     		}
     	 
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
     
  <form action="<?php echo $helper->url("Baja","InsertaBaja"); ?>" method="post" class="col-lg-12">
   
     <h4 ALIGN="center"></h4>
		   <hr/>
		    <h4 style="color:#ec971f;" ALIGN="center" >BAJA DE CARTONES</h4>
		    
            	<hr/>
            <div class="row"> 
              <div class="col-xs-2 col-md-2">
           	  </div>
           	
           	  <div class="col-xs-3 col-md-3">
           	   <p  class="formulario-subtitulo" > Ingrese Numero Carton: </p>
			   <input type="text" id="busqueda" name="busqueda" class="form-control" placeholder="Search" >
           	  </div>
           	</div>
           	
            <div class="row"> 
           	 <div class="col-xs-2 col-md-2">
           	 </div>
           	 <div class="col-xs-3 col-md-3">
                <p  class="formulario-subtitulo" >Cartones</p>
			  	<select  name="origen[]" id="origen" multiple="multiple" size="10" class="form-control">
			  	<?php foreach($resultCartones as $resCartones) {?>
						<option value="<?php echo $resCartones->id_cartones; ?>" <?php if($sel_id_cartones==$resCartones->id_cartones){echo "selected";}?> ><?php echo $resCartones->numero_cartones; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
            
            
             <div class="col-xs-2 col-md-2" >
            	
            	<div style=  "margin-top: 80px; text-align: center; ">
            	
            	
            	<div class="row" >
            		
            		<button type="button" class="btn btn-info" onClick="notificacion()"  id= "pasar" >
  						<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Pasar
					</button>
                	<button type="button" class="btn btn-info" onClick="Borrar()" id="quitar">
  						Quitar <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> 
					</button>
					
				</div>
				<div style="margin-top: 5px;">
				</div>
				<div class="row">
					<button type="button" class="btn btn-info" onClick="notificacion()" id="pasartodos">
  						<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Todos
					</button>
					<button type="button" class="btn btn-info"  onClick="Borrar()" id="quitartodos">
  							Todos <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
					</button>
	       	    </div>
            
              </div>
            </div>
			
			 <div class="col-xs-3 col-md-3">
			   <p  class="formulario-subtitulo" ><font color="White">Agregar </font></p>
	           <select  name="destino[]" id="destino" multiple size="10" class="form-control"></select> 
		   	 	
		   	  </div>
		   	  <div class="col-xs-2 col-md-2">
           	  </div>
		   </div>
		   
		   
		 
		   <div class="row">
		     <div class="col-xs-2 col-md-2">
           	 </div>
           	 
		     <div class="col-xs-3 col-md-3" >
			  	<p  class="formulario-subtitulo" >Observaciones </p>
	          	<textarea  class="form-control" id="observaciones" name="observaciones" wrap="physical" rows="8"  onKeyDown="contador(this.form.observaciones,this.form.remLen,400);" onKeyUp="contador(this.form.observaciones,this.form.remLen,400);"></textarea>
	          	<p  class="formulario-subtitulo" >Te quedan <input type="text" name="remLen" size="2" maxlength="2" value="400" readonly="readonly"> letras por escribir. </p>
	        		   
		     </div>
		    <div class="col-xs-2 col-md-2">
           		
           	 </div>
		     <div class="col-xs-3 col-md-3" style="margin-top:20px">
			 	 <p  class="formulario-subtitulo" > Total Cartones: </p>
			 	 <input type="text" id="total_cartones" name="total_cartones" class="form-control" readonly="readonly">
			 	 <div style="margin-top:10px ; text-align: center; " >
           			<input type="submit" id="btnGuardar" name="Guardar" value="Guardar" onClick="Ok()" class="btn btn-success "/>
           	 	</div>
		   	  </div>	
		   	  <div class="col-xs-2 col-md-2">
           	 </div>
		   </div>
		    
			
    </form>
    </div>
      
  </div>
  
     </body>  
    </html>   