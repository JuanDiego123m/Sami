Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #EBEBEB">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reportes de tickets
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Reportes de tickets</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="panel box-box">

        <div class="box-header">

          <div class="imput-group">
            
            <button type="button" class="btn btn-default" id="daterange-btn2">
            
              <span>
                <i class="fa fa-calendar"></i> Rango de fecha
              </span>

              <i class="fa fa-caret-down"></i>

            </button>

          </div>

          <div class="box-tools pull-right">

            <?php

            if (isset($_GET["fechaInicial"])){ 

              echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial"'.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

            }else{

              echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

            }

            ?>
            
            
              
              <button class="btn btn-cr" style="margin-top: 5px"><i class="fa fa-cloud-download"></i> Descargar reporte</button>

            </a>
            

          </div>

          


          <div class="box-tools pull-right"></div>


        </div>




        <!-- <div class="box-body">
          
          <div class="row">
            
            <div class="col-xs-12">
                
               <?php 

                //include "reportes/grafico-ventas.php";

               ?>

            </div>

          </div>

        </div> -->


        <!-- *** VISTA DE ZOHO -->

        <div class="box-body">
          
          <div class="row">
            
            <div class="col-xs-12">
                
               <iframe frameborder=0 width="100%" height="1000" src="https://analytics.zoho.com/open-view/1412003000016992403"></iframe>

            </div>

          </div>

        </div>        

        

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper