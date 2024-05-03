<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;Clientes</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                </ol>
          </nav>

      <!-- Default box -->
      <div class="panel box-box">

         <div class="box-header with-border">
          
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente"><i class='fa fa-plus-circle'></i>
              Nuevo
            </button>

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCargarItemsClientes"><i class='fa fa-upload'></i>
            Importar
            </button>   

            <a href="extensiones/excel/clientes_reporte.php" target="_blank" role="button" aria-pressed="true" class="btn btn-primary"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a>
          
        </div>


        <div class="box-body">
          
        <table class="table table-bordered table-striped dt-responsive tablas" >
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">#</th>
                <th >Nombre</th>
                <th >NIT</th>
                <th>Acciones</th>
                


              </tr>


            </thead>

            <tbody>

             <!-- SE LLAMA LA FUNCIÓN DEL CONTROLADOR QUE PERMITE MOSTRAR LOS CLIENTES -->
              <?php 

                $item = null;
                $valor = null;

                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                foreach ($clientes as $key => $value) {
                  
                  echo '<tr>
              
                        <td>'.($key+1).'</td>
                        <td><a href="#" class="btnEditarCliente" idCliente="'.$value["idCliente"].'">'.strtoupper($value["nombre"]).'</a></td>
                        <td>'.$value["nit"].'</td>
                      

               
                        <td>

                          <div class="btn-group">
                            
                            <button class="btn btn-primary btnEditarCliente" idCliente="'.$value["idCliente"].'"><i class="fa fa-edit"></i></button>

                            <button class="btn btn-danger btnEliminarCliente" id="'.$value["idCliente"].'" ><i class="fa fa-trash-alt"></i></button>


                          </div>


                        </td>

                      </tr>';
                }

              ?>
            
            

          </tbody>


          </table>

        </div>

        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  
  <!--=======================
    MODAL AGREGAR CLIENTE
    =======================-->

    
<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 8px !important">

        <form role="form" method="post">

          <!--=======================
      CABEZA MODAL
      =======================-->

        <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">

          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>

          <h4 class="modal-title">Agregar empresa</h4>

        </div>

        <!--=======================
      CUERPO MODAL
      =======================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA NOMBRE-->
            
            <div class="form-group">
              
              <div class="form-group has-feedback">
                
                 <input type="text" class="form-control" name="nombreCliente" placeholder="Nombre" required>
                

              </div>

            </div>

            <!--ENTRADA NIT-->
            
            <div class="form-group">
              
              <div class="form-group has-feedback">
                

                <input type="text" class="form-control"  name="nuevoNit" placeholder="NIT" required>
               

              </div>

            </div>


          </div>

        </div>

        <!--=======================
      PIE MODAL
      =======================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>
        
        
      <?php 

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

      </form>

    </div>

  </div>

</div>

<!--=======================
MODAL CARGA MASIVA DE CLIENTES POR MEDIO DE UN EXCEL
=======================-->


<div id="modalCargarItemsClientes" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 8px !important">
            
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=======================
                  CABEZA MODAL
                  =======================-->

                <div class="modal-header" >

                  <h4 class="modal-title">Cargar Clientes</h4>

                  <button type="button" class="btn-close" data-dismiss="modal"></button>

                </div>

                <!--=======================
                  CUERPO MODAL
                  =======================-->

                <div class="modal-body">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-sm-12 col-md-12">

                                <p>Carga clientes de forma masiva mediante un archivo de Excel</p>

                                <div class="alert alert-info" role="alert">
                                    
                                    <strong>Use la plantilla disponible para ajustar sus datos.</strong>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12">
                                <a href="public/clientes.xlsx" class="btn btn-default" download><i class='fa fa-cloud-download'></i> Plantilla</a>
                            </div>

                            <div class="col-sm-12 col-md-12 mg16">
                                
                                <input type="file" class="form-control" name="fileClients" required>

                            </div>                           

                        </div>

                    </div>

                </div>

                <!--=======================
                PIE MODAL
                =======================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-primary"> Cargar</button>

                </div>

                 <!--FUNCION DEL CONTROLADOR QUE PERMITE CARGAR MASIVAMENTE LOS CLIENTES-->
                <?php 

                   $cargaItems = new ControladorClientes();
                   $cargaItems -> ctrCargaMasivaClientes();

                ?>  

            </form>

        </div>

    </div>

</div>


<?php 

        $eliminarCliente = new ControladorClientes();
        $eliminarCliente -> ctrEliminarCliente();

?>


<style type="text/css">

.breadcrumb {
    padding: 8px 15px;
    margin-bottom: 10px;
    list-style: none;
    background-color: #ffffff;
    border-radius: 8px;
}

ol, ul {
    margin-top: 0;
    margin-bottom: 10px;
}


</style>