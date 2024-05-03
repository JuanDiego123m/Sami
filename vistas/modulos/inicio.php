<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-server" aria-hidden="true"></i>&nbsp;Tablero</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Panel de control</li>
                    <li class="breadcrumb-item active">Inicio</li>
                </ol>
          </nav> 

    <section class="content">

    <div class="row">

        <?php
          if ($_SESSION["perfil"] == "Administrador"){
            
            include "inicio/cajas-superiores.php";

          } elseif ($_SESSION["perfil"] == "Invitado") {
            
            include "inicio/cajas-invitado.php";

          } elseif ($_SESSION["perfil"] == "Tecnico") {
            
            include "inicio/cajas-superiores.php";

          }
        ?>
    </div>

    <div class="row">
        
      <div class="col-md-12">

        <?php


        ?>

      </div>

    </div>

  </section>
   
</div>
