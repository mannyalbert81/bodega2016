<?php 

$controladores=$_SESSION['controladores'];


 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 			
 		}
 	}
 	}
 	
 	return $display;
 }

 
?>
<div class="container" style="margin-top: 15px;" >
<div class="row">
<div class="col-xs-12">
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
      <a class="navbar-brand" href="#"></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" ><?php echo " Administración" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu" >
        	
        	<li style="<?php echo getcontrolador("Usuarios",$controladores) ?>">
        	<a href="index.php?controller=Usuarios&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Usuarios</span> </a>
		    </li>
			<li style="<?php echo getcontrolador("Roles",$controladores) ?>">
			<a href="index.php?controller=Roles&action=index"> <span class=" glyphicon glyphicon-asterisk" aria-hidden="true"> Roles de Usuario</span> </a>
			</li>
			<li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>">
			<a href="index.php?controller=PermisosRoles&action=index"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Permisos Roles</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Controladores",$controladores) ?>">
			<a href="index.php?controller=Controladores&action=index"><span class="glyphicon glyphicon-inbox" aria-hidden="true"> Controladores</span> </a>
			</li>
			
			
		</ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Procesos" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
        	
            <li style="<?php echo getcontrolador("Controladores",$controladores) ?>">
            <a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Entidades</span> </a>
			</li> 
			<li style="<?php echo getcontrolador("Controladores",$controladores) ?>">
			<a href="index.php?controller=AsignarUsuarioBodega&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Asignar Usuario Bodega</span> </a>
			</li>
         </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-wrench" ><?php echo " Mantenimiento" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
              <li style="<?php echo getcontrolador("TipoPersona",$controladores) ?>">
              <a href="index.php?controller=TipoPersona&action=index"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Tipo de Personas</span> </a>
			</li>
			<li style="<?php echo getcontrolador("TipoIdentificacion",$controladores) ?>">
			<a href="index.php?controller=TipoIdentificacion&action=index"><span class="glyphicon glyphicon-time" aria-hidden="true"> Tipo de Identificacion</span> </a>
			</li>
			<li style="<?php echo getcontrolador("TipoNotificacion",$controladores) ?>">
			<a href="index.php?controller=TipoNotificacion&action=index"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"> Tipo Notificacion</span> </a>
			</li>
			 <li style="<?php echo getcontrolador("Ciudad",$controladores) ?>">
			 <a href="index.php?controller=Ciudad&action=index"><span class="glyphicon glyphicon-object-align-vertical" aria-hidden="true"> Ciudades</span> </a>
          
            <li style="<?php echo getcontrolador("Bodegas",$controladores) ?>"> 
            <a href="index.php?controller=Bodegas&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Bodegas</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Notificaciones",$controladores) ?>">
			<a href="index.php?controller=Notificaciones&action=index"><span class="glyphicon glyphicon-globe" aria-hidden="true"> Notificaciones</span> </a>
			</li>
			 <li style="<?php echo getcontrolador("TipoOperaciones",$controladores) ?>"> 
			 <a href="index.php?controller=TipoOperaciones&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Tipo Operaciones</span> </a>
            </li>  
            <li style="<?php echo getcontrolador("TipoContenidoCartones",$controladores) ?>">
            <a href="index.php?controller=TipoContenidoCartones&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Contenido Cartones</span> </a>
            </li>
         </ul>

             
          

        </li>

		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-book" ><?php echo " Cartones" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">

			<li style="<?php echo getcontrolador("Cartones",$controladores) ?>">
			<a href="index.php?controller=Cartones&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Crear Cartones</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Movimientos",$controladores) ?>"> 
			<a href="index.php?controller=Movimientos&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Entradas de Cartones</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Salidas",$controladores) ?>">
			<a href="index.php?controller=Salidas&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Salidas de Cartones</span> </a>
			</li>
			<li style="<?php echo getcontrolador("GenerarSolicitud",$controladores) ?>">
			<a href="index.php?controller=GenerarSolicitud&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Generar Solicitud de Cartones</span> </a>
			</li>
			<li style="<?php echo getcontrolador("AnularSolicitudCartones",$controladores) ?>">
			<a href="index.php?controller=AnularSolicitudCartones&action=anula_solicitud_cartones"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Anular Solicitud de Cartones</span> </a>
			</li>
			<li style="<?php echo getcontrolador("AprobarSolicitudCartones",$controladores) ?>">
			<a href="index.php?controller=AprobarSolicitudCartones&action=aprobar_solicitud_cartones"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Aprobar Solicitud de Cartones</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Baja",$controladores) ?>">
			<a href="index.php?controller=Baja&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Baja de Cartones</span> </a>
			</li>
			
          </ul>
        </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-flash" ><?php echo " Consultas" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Trazas",$controladores) ?>">
          <a href="index.php?controller=Trazas&action=index"><span class="glyphicon glyphicon-save-file" aria-hidden="true"> Auditoria del Sistema</span> </a>
            </li>
          <li style="<?php echo getcontrolador("Cartones",$controladores) ?>">
          <a href="index.php?controller=Cartones&action=consulta_cartones"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Consulta Estado Cartones</span> </a>
            </li>  
            
            <li style="<?php echo getcontrolador("Cartones",$controladores) ?>">
            <a href="index.php?controller=Cartones&action=busqueda_cartones"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Busqueda de  Cartones</span> </a>
            </li>  
            
            <li style="<?php echo getcontrolador("AnularSolicitudCartones",$controladores) ?>">
               <a href="index.php?controller=AnularSolicitudCartones&action=consulta_solicitud_cartones"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Consulta Solicitud Cartones</span> </a>
            </li> 
            
             <li style="<?php echo getcontrolador("InventarioCartones",$controladores) ?>">
             <a href="index.php?controller=InventarioCartones&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Inventario</span> </a>
            </li> 
            
			
</ul>
</li>

<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-print" ><?php echo " Reportes" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li><a href="/FrameworkMVC/view/ireports/ContEntradasReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Entradas de Cartones</span> </a>
            </li>
    
            <li><a href="/FrameworkMVC/view/ireports/ContBajasReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Bajas de Cartones</span> </a>
            </li>
           <li><a href="/FrameworkMVC/view/ireports/ContSalidasReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Salidas de Cartones</span> </a>
            </li>
			  <li><a href="/FrameworkMVC/view/ireports/ContSolicitudesReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Solicitud de Cartones</span> </a>
            </li>
			  <li><a href="/FrameworkMVC/view/ireports/ContAnularReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Anulacion de Cartones</span> </a>
            </li>
</ul>
</li>
     	

</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
</div>
</div>