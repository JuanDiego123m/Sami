<div class="content" style="background-color: #EBEBEB">

<h4><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Empleados</h4>
   
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Empleados</li>
                </ol>
            </nav>  

      <div class="panel box-box">
        <div class="box-header with-border">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado"><i class='fa fa-plus-circle'></i>
              Nuevo
            </button>

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCargarItemsEmpleado"><i class='fa fa-upload'></i>
             Importar
            </button>    

    
        </div>


        <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablas"  >
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">ID</th>
                <th>Nombre</th>  
                <th>Documento</th>
                <th>Telefono</th>
                <th>Area</th>
                <th>Cargo</th>
                <th>Acciones</th>
                <th></th>
                


              </tr>


            </thead>

            <tbody>

            <?php
                $item = null;
                $valor = null;

                $empleado = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                foreach ($empleado as $key => $value) {
                    
                    if ($value["idEmpleado"] == 0) {
                        continue; 
                    }

                    echo '<tr>
                        <td>'.($key+0).'</td>
                        <td><a href="#" class="btnEditarEmpleado" idEmpleado="'.$value["idEmpleado"].'">'.strtoupper($value["nombre"]).'</a></td>
                        <td>'.$value["documento"].'</td>
                        <td>'.$value["telefono"].'</td>
                        <td>'.$value["area"].'</td>
                        <td>'.$value["cargo"].'</td>';

                    echo '
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-primary btnEditarEmpleado" idEmpleado="'.$value["idEmpleado"].'"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btnEliminarEmpleados" idEmplea="'.$value["idEmpleado"].'" ><i class="fa fa-trash-alt"></i></button>';

                    if($value["estado"] != 0){
                        echo '<td><button class="btn btn-cr btn-sm btnActivarE" idEmpleado="'.$value["idEmpleado"].'" estadoEmpleado="0">Habilitado</button></td>';
                    } else {
                        echo '<td><button class="btn btn-danger btn-sm btnActivarE" idEmpleado="'.$value["idEmpleado"].'" estadoEmpleado="1">Deshabilitado</button></td>';
                    }

                    echo '</div>
                        </td>
                    </tr>';
                }
              ?>



          </tbody>


          </table>

        </div>
        
      </div>
    
    </section>

  </div>

   <!--=======================
    MODAL AGREGAR EMPLEADO
    =======================-->

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">

<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content" style="border-radius: 8px !important">

      <form role="form" method="post">

        <!--=======================
    CABEZA MODAL
    =======================-->

      <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">

        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>

        <h4 class="modal-title">Agregar Empleado</h4>

      </div>

      <!--=======================
    CUERPO MODAL
    =======================-->

      <div class="modal-body">

        <div class="box-body">

          <!--ENTRADA NOMBRE-->
          
          <div class="form-group">
            
            <div class="form-group has-feedback">
              
              <input type="text" class="form-control" name="nuevoEmpleado" placeholder="Nombre" required>
              

            </div>

          </div>

          <!--ENTRADA DOCUMENTO-->
          
          <div class="form-group">
            
            <div class="form-group has-feedback">
              
              <input type="number" class="form-control"name="nuevoDocumento" placeholder="Documento" required>
             
            </div>

          </div>

             <!--ENTRADA TELEFONO-->
          
             <div class="form-group">
            
            <div class="form-group has-feedback">
              
              <input type="text" class="form-control" name="nuevoTelefono" placeholder="Telefono" required>
              
            </div>

          </div>

             <!--ENTRADA AREA-->
          
             <div class="form-group">
            
            <div class="form-group has-feedback">
              
              <input type="text" class="form-control" name="nuevaArea" placeholder="Area" required>
              

            </div>

          </div>
             <!--ENTRADA CARGO-->
          
             <div class="form-group">
            
            <div class="form-group has-feedback">
              
              <input type="text" class="form-control" name="nuevoCargo" placeholder="Cargo" required>
              
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

        $crearEmpleado = new ControladorEmpleados();
        $crearEmpleado -> ctrCrearEmpleado();

      ?>

    </form>

   </div>

  </div>

</div>


<!--=======================
MODAL CARGA ITEMS
=======================-->

<div id="modalCargarItemsEmpleado" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 8px !important">
            
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=======================
                  CABEZA MODAL
                  =======================-->

                <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">

                <h4 class="modal-title">Cargar Empleados</h4>

                  <button type="button" class="btn-close" data-dismiss="modal"></button>

                </div>

                <!--=======================
                  CUERPO MODAL
                  =======================-->

                <div class="modal-body">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-sm-12 col-md-12">

                                <p>Carga items de forma masiva mediante un archivo de Excel</p>

                                <div class="alert alert-info" role="alert">
                                    <strong>Use la plantilla disponible para ajustar sus datos.</strong>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12">
                              
                                <a href="public/empleados.xlsx" class="btn btn-default" download><i class='fa fa-cloud-download'></i> Plantilla</a>
                                <br>

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

                <button type="submit" class="btn btn-primary">Cargar</button>

                </div>

                <?php 

                   $cargaItems = new ControladorEmpleados();
                   $cargaItems -> ctrCargaMasivaItems();

                ?> 

            </form>

        </div>

    </div>

</div>
       

<?php 

    $eliminarEmpleado = new ControladorEmpleados();
    $eliminarEmpleado -> ctrEliminarEmpleado();

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
 