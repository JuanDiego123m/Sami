<header class="main-header">
	
	<!--==============================
	=            LOGOTIPO            =
	===============================-->
	
	<a href="inicio">
			<!-- logo modal -->
		<div class="container-fluid">
             <a class="navbar-brand" href="inicio"><img src="vistas/img/Logo1.png"><strong style="font-size: 1rem">&nbsp;&nbsp;&nbsp;SBPO</strong></a>
        </div>
	

	</a>

	

	<!--==============================
	=         BARRA DE NAVEGACIÓN    =
	===============================-->
	
	<nav class="navbar" role="navigation">

		



		<!-- Perfil de usuario -->

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

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu">
						 
						

							<div class="pull-left">

								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									
									<tr>

										<td width="800" valign="top" style="border: 2px">
											
											
											

											<p>

												<span class="hidden-xs">

													<h5>Hola</h5>
													
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