<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #EBEBEB">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Módulos
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Módulos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="panel box-box">
        <div class="box-header with-border">
          
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarModulo"><i class='fa fa-plus-circle'></i>
              
              Nuevo

            </button>

          
        </div>


        <div class="box-body">
          
          <table class="table table-hover table-striped dt-responsive tablas">
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>contraseña</th>
                <th style="width: 10px">Call Center</th>
                <th style="width: 10px">PBX</th>
                <th style="width: 10px">Redes</th>
                <th style="width: 30px">IP</th>
                <th>Acciones</th>
                


              </tr>


            </thead>

            <tbody>

              <?php 

                $itemb = null;
                $valorb = null;

                $modulos = ControladorModulos::ctrMostrarModulosb($itemb, $valorb);

                foreach ($modulos as $key => $value) {

                  if($_SESSION['perfil'] == 'Invitado'){

                    if($value['operacion_cc'] == 1){

                      echo '<tr>
              
                            <td>'.($key+1).'</td>
                            <td><a href="#" class="btnEditarModulo" idModulo="'.$value["id"].'">'.strtoupper($value["nombre"]).'</a></td>
                            <td>'.$value["usuario"].'</td>
                            <td>'.$value["password"].'</td>
                            <td>'.$value["lic_cc"].'</td>
                            <td>'.$value["lic_pbx"].'</td>
                            <td>'.$value["redes"].'</td>
                            <td>'.$value["ip_servidor"].'</td>

                   
                            <td>

                              <div class="btn-group">';

                                if($_SESSION['perfil'] != 'Invitado'){

                                  echo '
                                    <button class="btn btn-primary btnEditarModulo" idModulo="'.$value["id"].'"><i class="fa fa-edit"></i></button>

                                    <button class="btn btn-danger btnEliminarModulo" idModulod="'.$value["id"].'"><i class="far fa-trash-alt"></i></button>
                                  ';
                                }

                        echo '</div>


                            </td>

                          </tr>';

                    }                    

                  }else{

                    echo '<tr>
              
                          <td>'.($key+1).'</td>
                          <td><a href="#" class="btnEditarModulo" idModulo="'.$value["id"].'">'.strtoupper($value["nombre"]).'</a></td>
                          <td>'.$value["usuario"].'</td>
                          <td>'.$value["password"].'</td>
                          <td>'.$value["lic_cc"].'</td>
                          <td>'.$value["lic_pbx"].'</td>
                          <td>'.$value["redes"].'</td>
                          <td>'.$value["ip_servidor"].'</td>

                 
                          <td>

                            <div class="btn-group">';

                              if($_SESSION['perfil'] != 'Invitado'){

                                echo '
                                  <button class="btn btn-primary btnEditarModulo" idModulo="'.$value["id"].'"><i class="fa fa-edit"></i></button>

                                  <button class="btn btn-danger btnEliminarModulo" idModulod="'.$value["id"].'"><i class="far fa-trash-alt"></i></button>
                                ';
                              }

                      echo '</div>


                          </td>

                        </tr>';

                  }
                  
                  
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
    MODAL AGREGAR MODULO
    =======================-->

    
<div id="modalAgregarModulo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 8px !important">

        <form role="form" method="post">

          <!--=======================
      CABEZA MODAL
      =======================-->

        <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">

          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>

          <h4 class="modal-title">Agregar modulo</h4>

        </div>

        <!--=======================
      CUERPO MODAL
      =======================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA NOMBRE-->
            <div class="col-md-6">

              <div class="form-group has-feedback">
                

                  <input type="text" class="form-control input-lg" name="nuevoModulo" placeholder="Nombre" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>


              </div>

            </div>


            <!--ENTRADA CLIENTE-->
            <div class="col-md-6" style="margin-bottom: 16px">

              <div class="form-group has-feedback">

                   <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                         <option value="">Seleccionar cliente</option>

                                  <?php

                                    $item = null;
                                    $valor = null;

                                    $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                                      foreach ($categorias as $key => $value) {
                                        
                                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                      }

                                  ?>

                   </select>


              </div>

            </div>



            <!--ENTRADA USUARIO-->
            <div class="col-md-6">

              <div class="form-group has-feedback">
                

                  <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Usuario" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>

              </div>

            </div>
 

            <!-- ENTRADA PARA EL PASSWORD -->
            <div class="col-md-6">

              <div class="form-group has-feedback">
 

                  <input type="text" class="form-control input-lg" name="nuevaPassword" placeholder="Contraseña" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>


              </div>

            </div>


            <!--ENTRADA LICENCIAS CC-->
            <div class="col-md-6">

              <div class="form-group has-feedback">


                  <input type="number" class="form-control input-lg" name="nuevaLicc" placeholder="Licencias cc" min="0" required>
                  <span class="glyphicon glyphicon-headphones form-control-feedback"></span>


              </div>

            </div>


          <!--ENTRADA LICENCIAS PBX-->
            <div class="col-md-6">

              <div class="form-group has-feedback">


                  <input type="number" class="form-control input-lg" name="nuevaLicPbx" placeholder="Licencias pbx" min="0" required>
                  <span class="glyphicon glyphicon-earphone form-control-feedback"></span>


              </div>

            </div>


            <!--ENTRADA REDES-->
            <div class="col-md-6" style="margin-bottom: 16px">

              <div class="form-group has-feedback">
                

                   <select class="form-control" id="nuevaRedes" name="nuevaRedes" required>

                           <option value="">Integración redes</option>
                           <option value="Si">Si</option>
                           <option value="No">No</option>

                    
                   </select>



              </div>

            </div>


          <!--ENTRADA IP-->
          <div class="col-md-6">
            
            <div class="form-group has-feedback">

                <input type="text" class="form-control input-lg" name="nuevaIp" placeholder="IP del servidor" required>
                <span class="glyphicon glyphicon-tasks form-control-feedback"></span>

            </div>

          </div>




          </div>

        </div>

        <!--=======================
      PIE MODAL
      =======================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

      </form>

      <?php 

        $crearModulo = new ControladorModulos();
        $crearModulo -> ctrCrearModulo();

      ?>

    </div>

  </div>

</div>



<?php 

        $eliminarModulo = new ControladorModulos();
        $eliminarModulo -> ctrEliminarModulo();

?>