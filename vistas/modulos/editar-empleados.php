<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-pencil-square-o" ></i>&nbsp;Editar Empleado</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"><a href="empleados" >Empleados</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Empleado</li>
                </ol>
          </nav>

      <!-- Default box -->

          <div class="panel box-box col-md-3">

            <div class="panel box-box">

              <form role="form" method="post" class="formularioEmpleados">
          
                  <div class="col-md-2"><h3>General</h3></div>

                    <?php

                          $item = "idEmpleado";
                          $valor = $_GET["idItem"];
                          $empleados = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);
                                                              
                    ?>
           
                    <div class="col-md-12" style="margin-top: 16px">
                        <label for="editarEmpleado">Codigo</label>              
                        <div class="form-group has-feedback">
                                        
                              <input type="text" class="form-control" id="editarEmpleado" name="editarEmpleado" value="<?php echo $empleados[0]["idEmpleado"]; ?>"  readonly>
                              <input type="hidden" id="idItem" name="idItem" value="<?php echo $empleados[0]["idEmpleado"]; ?>">
                        </div>

                    </div>


                    <div class="col-md-12" style="margin-top: 16px">
                        <label for="editarDocumentoId">Empleado</label>             
                        <div class="form-group has-feedback">

                              <input type="text" class="form-control" min="0" id="editarNombre" name="editarNombre" value="<?php echo $empleados[0]["nombre"]; ?>" required>
                              <input type="hidden" name="idItem" value="<?php echo $empleados[0]["idEmpleado"]; ?>">
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 16px">
                        <label for="editarCliente">Documento</label>              
                        <div class="form-group has-feedback">
                                        
                              <!-- <span class="input-group-addon"><i class="fa fa-user"></i></span> -->
                              <input type="text" class="form-control" id="editarDocumentoId" name="editarDocumentoId" value="<?php echo $empleados[0]["documento"]; ?>" required>
                              <input type="hidden" id="idItem" name="idItem" value="<?php echo $empleados[0]["idEmpleado"]; ?>">
                        </div>

                    </div>


                    <div class="col-md-12" style="margin-top: 16px">
                        <label for="editarEmail">Telefono</label>             
                        <div class="form-group has-feedback">

                              <input type="text" class="form-control" id="editarTelefono" name="editarTelefono" value="<?php echo $empleados[0]["telefono"]; ?>" required>
                              <input type="hidden" name="idItem" value="<?php echo $empleados[0]["idEmpleado"]; ?>">
                            
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 16px">
                        <label for="editarEmail">Area</label>             
                        <div class="form-group has-feedback">

                              <input type="text" class="form-control" id="editarArea" name="editarArea" value="<?php echo $empleados[0]["area"]; ?>" required>
                              <input type="hidden" name="idItem" value="<?php echo $empleados[0]["idEmpleado"]; ?>">
                            
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 16px">
                        <label for="editarEmail">Cargo</label>             
                        <div class="form-group has-feedback">

                              <input type="text" class="form-control" id="editarCargo" name="editarCargo" value="<?php echo $empleados[0]["cargo"]; ?>" required>
                              <input type="hidden" name="idItem" value="<?php echo $empleados[0]["idEmpleado"]; ?>">
                            
                        </div>
                    </div>

                
                  </div>

                    <div class="modal-footer" style="margin-top: 16px !important;">

                      <button type="submit" class="btn btn-primary">Guardar</button>

                    </div>

                </form>
                <?php 

                    $editarEmpleados = new ControladorEmpleados();
                    $editarEmpleados -> ctrEditarEmpleado();

                ?>

                </div>



        
              <!-- Tabla con datos de Inventario -->

              

              <div class="col-md-9">

                <div class="panel box-box d-flex">

                  <div class="box-header with-border">

                    <div class="col-md-2"><h3>Inventario</h3></div>
                    <div class="col-md-10" style="margin-top: 16px;">
                    
                    </div>

                </div>

                <form role="form" method="post" class="formularioInventario">

                  <div class="box-body d-flex">

                    <table class="table table-bordered table-striped dt-responsive tablas">
                
                      <thead>
                        
                        <tr>
                  
                              <th style="width: 10px">#</th>
                              <th>Empleado</th>
                              <th>Tipo de Activo</th>  
                              <th>Serial</th>
                              <th>Notas</th>
                              <th></th>
                        </tr>


                      </thead>

                      <tbody>


                        <?php

                          $idPropietario = $_GET['idItem'];

                          $item = "propietario";
                          $valor = $idPropietario;

                          $inventario = ControladorInventario::ctrMostrarItems($item, $valor);

                          foreach ($inventario as $key => $value) {

                              $item = "idEmpleado";
                              $valor = $value["propietario"]; 

                              $empleado = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                              $nombrePropietario = $empleado[0]["nombre"];

                              echo '<tr>
                                  <td>'.($key+1).'</td>
                                  <td><a href="#" class="btnEditarItem" idInventario="'.$value["idInventario"].'">'.strtoupper($nombrePropietario).'</a></td>
                                  <td>'.$value["tipoActivo"].'</td>
                                  <td>'.$value["serial"].'</td>
                                  <td>'.$value["notas"].'</td>
                                  <td>
                                      <div class="btn-group">
                                          <!-- Aquí puedes agregar los botones de acciones adicionales -->
                                      </div>
                                  </td>
                              </tr>';
                          }

                      ?>
                      
                  </tbody>

                </table>

            </div>

        </form>

    </div>

</div>

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