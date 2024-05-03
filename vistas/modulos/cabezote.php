<!-- ESTE ES LA BARRA DE NAVEGACIÓN DONDE ESTÁN TODOS LOS MODULOS DE LA PLATAFORMA -->

<header class="header" >

<div class="logo">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="inicio"><img src="vistas/img/Logo1.png"><strong style="font-size: 1rem">&nbsp;&nbsp;&nbsp;SBPO</strong></a>
        </div>
        <ul class="nav-links">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="inicio">Inicio</a>
            </li>

            <!-- ESTO PERMITE FILTRAR LA INFORMACIÓN DEPENDIENDO DEL PERDIL DEL USUARIO  -->

            <?php if ($_SESSION["perfil"] == "Administrador"): ?>
                <li class="nav-item">
                    <a class="nav-link active" href="empleados">Empleados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="inventario">Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="DID">DID</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="operaciones">Operaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="clientes">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="acta">Actas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="usuarios">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="malla">Malla turnos</a>
                </li>

            <?php elseif ($_SESSION["perfil"] == "Tecnico"): ?>
				<li class="nav-item">
                    <a class="nav-link active" href="empleados">Empleados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="inventario">Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="DID">DID</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="operaciones">Operaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="clientes">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="acta">Actas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="usuarios">Usuarios</a>
                </li>

            <?php elseif ($_SESSION["perfil"] == "Invitado"): ?>
				<li class="nav-item">
                    <a class="nav-link active" href="operaciones">Operaciones</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>


<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">

				<li class="dropdown user user-menu">

					<a href="#"  class="dropdown-toggle" data-toggle="dropdown" style="margin-top: 2px;">

						<?php 

							if($_SESSION["foto"] != ""){
								echo '<img src="'.$_SESSION["foto"].'" class="user-image">';
							}else{

								echo '<img src="vistas/img/usuarios/user.png" class="user-image">';

							}

							

						 ?>
						

					</a>

				    <!-- ESTO ES EL MODAL DE SALIDA DE LA PAGINA -->

					<ul class="dropdown-menu">
						 
						

							<div class="pull-left">

								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									
									<tr>

										<td width="800" valign="top" style="border: 2px">
											
											
											

											<p>

												<span class="hidden-xs">

													<h5>Hasta Luego 👋</h5>
													
												</span>

											</p>



											<p>

												<span class="hidden-xs">

													<h5><?php echo $_SESSION["nombre"]; ?></h5>
													
												</span>

											</p>

											<hr>

											<h5>
												<?php

													 echo date("d-M-Y");

												?>

											</h5>

										</td>

										<td style="font-size: 0; line-height: 0;" width="30" >
												
											<div style="border-right: 1px solid #CCCCCC; height: 120px;"></div>

										</td>

										<td style="font-size: 0; line-height: 0;" width="30" >
												
											&nbsp;

										</td>

										<td width="500" valign="top" style="margin-right: 20px">


											<?php
												if($_SESSION["perfil"] == "Administrador"){

													echo '<a href="usuarios">

		                        	
								                        	<h5><i class="fa fa-cog"></i> Ajustes</p></h5>

								                        </a>';
												}
											?>
											
												
											<a href="salir">

					                        	
					                        	<h5><i class="fa fa-sign-out"></i> Salir</p></h5>

					                        </a>

										</td>
										

									</tr>

								</table>

								
							</div>
					

					</ul>

				</li>
				
			</ul>
			
		</div>

	</nav>
    </header>



<!-- CSS DE LA BARRA DE NAVEGACIÓN -->

<style type="text/css">


.header{
    background-color: #fff;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    height: 85px;
  
}

.header .logo{
    margin-right: auto;
	color: black;
}

.header .logo img{
    height: 40px;
    width: auto;
    transition: all 0.3s;
	color: black;
}



.header .nav-links{
    list-style: none;
	color: black;
}

.header .nav-links li{
    display: inline-block;
    padding: 0 20px;   
	color: black; 
}


.header .nav-links a{
    font-size: 500;
	color: black; 
    text-decoration: none;    
}

.header .nav a{
  margin-left: auto;
  color: black; 
}

</style>