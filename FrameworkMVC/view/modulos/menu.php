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
          <ul class="dropdown-menu">
        	<li><a href="index.php?controller=Usuarios&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Usuarios</span> </a>
		    </li>
			<li><a href="index.php?controller=Roles&action=index"> <span class=" glyphicon glyphicon-asterisk" aria-hidden="true"> Roles de Usuario</span> </a>
			</li>
			<li><a href="index.php?controller=PermisosRoles&action=index"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Permisos Roles</span> </a>
			</li>
			<li><a href="index.php?controller=Controladores&action=index"><span class="glyphicon glyphicon-inbox" aria-hidden="true"> Controladores</span> </a>
			</li>
			
			
		</ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Procesos" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
        	  <li><a href="index.php?controller=Clientes&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Clientes</span> </a>
            </li>
          	<li><a href="index.php?controller=Clientes&action=ImportacionClientes"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"> Importacion Clientes</span> </a>
            </li>
            <li><a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Entidades</span> </a>
			</li> 
			<li><a href="index.php?controller=AsignarUsuarioBodega&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Asignar Usuario Bodega</span> </a>
			</li>
         </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Mantenimiento" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="index.php?controller=TipoPersona&action=index"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Tipo de Personas</span> </a>
			</li>
			<li><a href="index.php?controller=TipoIdentificacion&action=index"><span class="glyphicon glyphicon-time" aria-hidden="true"> Tipo de Identificacion</span> </a>
			</li>
			<li><a href="index.php?controller=TipoNotificacion&action=index"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"> Tipo Notificacion</span> </a>
			</li>
			 <li><a href="index.php?controller=Ciudad&action=index"><span class="glyphicon glyphicon-object-align-vertical" aria-hidden="true"> Ciudades</span> </a>
			</li>
            <li><a href="index.php?controller=Bodegas&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Bodegas</span> </a>
			</li>
			<li><a href="index.php?controller=Notificaciones&action=index"><span class="glyphicon glyphicon-globe" aria-hidden="true"> Notificaciones</span> </a>
			</li>
			 <li><a href="index.php?controller=TipoOperaciones&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Tipo Operaciones</span> </a>
            </li>  
             <li><a href="index.php?controller=TipoContenidoCartones&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Contenido Cartones</span> </a>
            </li>
          </ul>
        </li>

		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Cartones" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">

			<li><a href="index.php?controller=Cartones&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Crear Cartones</span> </a>
			</li>
			<li><a href="index.php?controller=Movimientos&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Entradas de Cartones</span> </a>
			</li>
			<li><a href="index.php?controller=Salidas&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Salidas de Cartones</span> </a>
			</li>
			<li><a href="index.php?controller=GenerarSolicitud&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Generar Solicitud de Cartones</span> </a>
			</li>
			<li><a href="index.php?controller=AnularSolicitud&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Anular Solicitud de Cartones</span> </a>
			</li>
			<li><a href="index.php?controller=Baja&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Baja de Cartones</span> </a>
			</li>
          </ul>
        </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Consultas" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li><a href="index.php?controller=Trazas&action=index"><span class="glyphicon glyphicon-save-file" aria-hidden="true"> Auditoria del Sistema</span> </a>
            </li>
          <li><a href="index.php?controller=Cartones&action=consulta_cartones"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Consulta Estado Cartones</span> </a>
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