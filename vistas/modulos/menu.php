<aside class="main-sidebar">
	
	<section class="sidebar" > 
		
		<ul class="sidebar-menu" style="margin-top: 18px">
			
			

			<?php 

			if ($_SESSION["perfil"] == "Administrador"){

				echo '
					<li class="active">
				
						<a href="inicio">
							
							<i class="fa fa-home"></i>
							<span>Inicio</span>


						</a>

					</li>

					<li>
				
						<a href="usuarios">
							
							<i class="fa fa-user i-bg"></i>
							<span>Usuarios</span>


						</a>

					</li>

					<li>
				
						<a href="tipos">
							
							<i class="fa fa-support"></i>
							<span>Tipo</span>


						</a>

					</li>

					<li>
						
						<a href="categorias">
							
							<i class="fa fa-shopping-bag"></i>
							<span>Productos</span>


						</a>

					</li>

					<li>
						
						<a href="productos">
							
							<i class="fa fa-navicon"></i>
							<span>Categorías</span>


						</a>

					</li>
					<li>
				
				<a href="desarrollos">
					
					<i class="fa fa-terminal"></i>
					<span>Desarrollo</span>


				</a>

			</li>

			<li class="treeview">
				
				<a href="#">
					
					<i class="fa fa-cog"></i>
					<span>Operación</span>
					<span class="pull-right-container">
						
						<i class="fa fa-angle-left pull-right"></i>

					</span>


				</a>

				<ul class="treeview-menu">
					
					<li>
				
						<a href="modulos">
							
							<i class="fa fa-server"></i>
							<span>Módulos</span>


						</a>

					</li>

					<li>
						
						<a href="numeracion">
							
							<i class="fa fa-tty"></i>
							<span>Numeración</span>

						</a>

					</li>

					

				</ul>

			</li>

			



			<li class="treeview">
				
				<a href="#">
					
					<i class="fa fa-group"></i>
					<span>Clientes</span>
					<span class="pull-right-container">
						
						<i class="fa fa-angle-left pull-right"></i>

					</span>


				</a>

				<ul class="treeview-menu">
					
					<li>
				
						<a href="contactos">
							
							<i class="fa fa-user"></i>
							<span>Contactos</span>


						</a>

					</li>

					<li>
						
						<a href="clientes">
							
							<i class="far fa-building"></i>
							<span>Clientes</span>

						</a>

					</li>
					

				</ul>

			</li>
			




			<li class="treeview">
				
				<a href="#">
					
					<i class="fas fa-ticket-alt"></i>
					<span>Tickets</span>
					<span class="pull-right-container">
						
						<i class="fa fa-angle-left pull-right"></i>

					</span>


				</a>

				<ul class="treeview-menu">

					<li>
						
							<a href="mis-ventas">
									
								<i class="fas fa-tags"></i>
								<span>Mis tickets</span>

							</a>

					</li>
					
					<li>
						
							<a href="ventas">
									
								<i class="fas fa-tags"></i>
								<span>Administrar tickets</span>

							</a>

					</li>


					<li>
						
						<a href="crear-venta">
							
							<i class="fas fa-plus-circle"></i>
							<span>Crear Ticket</span>

						</a>

					</li>

					<li>
						
						<a href="reportes">
							
							<i class="fa fa-line-chart"></i>
							<span>Reportes</span>

						</a>

					</li>

				</ul>

			</li>

			<li class="treeview">
				
				<a href="#">
					
					<i class="fa fa-hdd-o"></i>
					<span>CMDB</span>
					<span class="pull-right-container">
						
						<i class="fa fa-angle-left pull-right"></i>

					</span>


				</a>

				<ul class="treeview-menu">
					
					<li>
				
						<a href="utilidades">
						
							<i class="fab fa-whatsapp"></i>
							<span>Utilidades</span>

						</a>

					</li>

					<li>
						
						<a href="herramientas">
							
							<i class="fas fa-tools"></i>
							<span>Herramientas </span>

						</a>

					</li>

					

				</ul>

			</li>

			
			<li>
						
					<a href="inventario">
						
						<i class="fa fa-folder-open"></i>
						<span>Inventario</span>

					</a>

			</li>
			
			
			';

			}elseif($_SESSION["perfil"] == "Tecnico"){

				echo '

				<li class="active">
				
					<a href="inicio">
						
						<i class="fa fa-home"></i>
						<span>Inicio</span>


					</a>
					

				</li>

				<li>
							
						<a href="empleados">
							
							<i class="fa fa-user"></i>
							<span>Empleados</span>

						</a>

				</li>

				<li>
							
						<a href="inventario">
							
							<i class="fa fa-folder-open"></i>
							<span>Inventario</span>

						</a>

				</li>
				
	

				
				
				<li>
							
						<a href="DID">
							
							<i class="fa fa-fax" aria-hidden="true"></i>
							<span>DID</span>

						</a>

				</li>
				
				<li>
							
						<a href="operaciones">
							
							<i class="fa fa-bullseye"></i>
							<span>Operaciones</span>

						</a>

				</li>

				<li>
							
						<a href="clientes">
							
							<i class="fa fa-users"></i>
							<span>Clientes</span>

						</a>

				</li>

				
				
				';
				

			

			}elseif($_SESSION["perfil"] == "Invitado"){

				echo '
				<li class="treeview">
				
					<a href="#">
						
						<i class="fa fa-cog"></i>
						<span>Operación</span>
						<span class="pull-right-container">
							
							<i class="fa fa-angle-left pull-right"></i>

						</span>


					</a>

					<ul class="treeview-menu">
					
					<li>
				
						<a href="modulos">
							
							<i class="fa fa-server"></i>
							<span>Módulos</span>


						</a>

					</li>				

					</ul>

				</li>';

			}

			?>
			

		</ul>

	</section>

</aside>