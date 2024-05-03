<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SBPO| Login</title>

    <!-- Custom fonts for this template-->
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <link href="vistas/css/style-login.css" rel="stylesheet" type="text/css">

</head>

<body class="background-image-login">
    
    <section class="login">
        
        <br>
        
        <div class="box-form glass">
            
        	<div class="leftLogin">
        	    
        		<div class="overlay">
        		    
            		<h1>SBPO</h1>            		
            		
            		<div class="description" style="height: 220px">
            		    <p>Plataforma de gestión tecnologica</p>
            		</div>
            		
            		<span>
            		    <a href="#" style="display:none"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
            			<a href="#" style="display:none"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a>
            		    <p><a href="https://solucionesbpo.com"><img src="vistas/img/Logo3.png" width="32px"> Soluciones BPO</a></p>
                        <p>SBPO v 1.0.0</p>
            		</span>
            		
            	</div>
        		
        	</div>
        	
    		<div class="rightLogin">
    		    
    		    <form class="user" method="post">
    		    
        		    <h5>Login</h5>
        		
        		    
        		
            		<div class="inputs">
            		    
            			<input type="text" class="form-glass" name="ingUsuario" placeholder="Usuario" required>
            			<br>
            			<input type="password" class="form-glass" name="ingPassword" placeholder="Contraseña" required>
            			
            		</div>
        			
            		<br><br>
            			
            		<!--<div class="remember-me--forget-password">
            			
                    	<label>
                    	    
                    		<input type="checkbox" name="item" checked/>
                    		
                    		<span class="text-checkbox">Remember me</span>
                    		
                    	</label>
                    	
            			<p>forget password?</p>
            			
            		</div>-->
        			
            		<br>
            		
            		<button type="submit" class="">Ingresar</button>
            		
            	
                      <?php

                    $login = new ControladorUsuarios();
                    $login -> ctrIngresoUsuario();

                    ?>
                </form>
        		
    	    </div>
        	
        </div>
    
    </section>

    <!-- Bootstrap core JavaScript
    <script src="vistas/vendor/jquery/jquery.min.js"></script>
    <script src="vistas/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->

    <!-- Core plugin JavaScript-->
    <script src="vistas/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages
    <script src="vistas/js/sb-admin-2.min.js"></script>-->

</body>

</html>
