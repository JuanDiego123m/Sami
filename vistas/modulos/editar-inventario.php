<!-- VISTA PARA EDITAR LA INFORMACIÓN DEL INVENTARIO -->

<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-pencil-square-o" ></i>&nbsp;Editar Inventario</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"><a href="inventario" >Inventario</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Inventario</li>
                </ol>
          </nav>
     
            <div class="panel box-box">

                <div class="box-header py-3">
              
             
                </div>

                     <div class="box-body">

                         <form role="form" method="post" class="formularioActa">

                            <div class="box-body ">

                                <!-- SE LLAMA LA FUNCIÓN DEL CONTROLADOR QUE PERMITE MOSTRAR LA INFORMACIÓN DEL INVENTARIO A EDITAR -->
                                <?php

                                    $item = "idInventario";
                                    $valor = $_GET["idInventario"];

                                    $inventario = ControladorInventario::ctrMostrarItems($item, $valor);

                                    
                                    foreach ($inventario as $key => $value) {

                                    $item = "idEmpleado";
                                    $valor = $value["id_empleado"];
    
                                    $empleado = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);
                                    
                                    $idEmpleado = $empleado[0] ["idEmpleado"];
    
                                    $nombreEmpleado= $empleado[0] ["nombre"]; }  

                 
                                ?>

                                <!-- entrada del id  -->
                                <div class="col-md-4" style="margin-top: 16px">
                                    <label for="editar">ID</label>              
                                    <div class="form-group has-feedback">
                                                    
                                            <input type="text" class="form-control" id="editarItem" name="editarItem" value="<?php echo $inventario[0]["idInventario"]; ?>"  readonly>
                                            <input type="hidden" id="id" name="id" value="<?php echo $inventario[0]["idInventario"]; ?>">
                                    </div>
                                </div>


                                <!-- entrada del nombre del empleado  -->
                                <div class="col-md-4" style="margin-top: 16px">
                                    <label for="editarEmpleado">Empleado</label>
                                    <div class="form-group has-feedback">
                                        <select select class="form-control" id="editarPropietario" name="editarPropietario" required>
                                            <?php
                                            $item = null;
                                            $valor = null;

                                            $empleados = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);

                                            foreach ($empleados as $empleado): 
                                                if ($empleado["estado"] == 1):
                                                    $selected = ($empleado['idEmpleado'] == $idEmpleado) ? 'selected' : '';
                                                    echo '<option value="' . $empleado['idEmpleado'] . '" ' . $selected . '>' . $empleado['nombre'] . ' - ' . $empleado['idEmpleado'] . '</option>';
                                                endif;
                                            endforeach;
                                            ?>
                                        </select>
                                        <?php $id_inventario = $inventario[0]['idInventario'];?>
                                        <input type="hidden" name="id" value="<?php echo $id_inventario; ?>">
                                    </div>
                                </div>



                                <!-- entrada del tipo de activo  -->
                                <div class="col-md-4" style="margin-top: 16px">
                                    <label for="editarCliente">Tipo de Activo</label>              
                                    <div class="form-group has-feedback">
                                                    
                                        <input type="text" class="form-control" id="editarActivo" name="editarActivo" value="<?php echo $inventario[0]["tipoActivo"]; ?>" required>
                                        <input type="hidden" id="id" name="id" value="<?php echo $inventario[0]["idInventario"]; ?>">
                                    </div>
                                </div>

                                <!-- entrada del serial del activo  -->  
                                <div class="col-md-4" style="margin-top: 16px">
                                    <label for="editarEmail">Serial</label>             
                                    <div class="form-group has-feedback">

                                            <input type="text" class="form-control" id="editarSerial" name="editarSerial" value="<?php echo $inventario[0]["serial"]; ?>" required>
                                            <input type="hidden" name="id" value="<?php echo $inventario[0]["idInventario"]; ?>">
                                        
                                    </div>
                                </div>



                                <!-- entrada del estado del activo  -->
                                <div class="col-md-4" style="margin-top: 16px">
                                    <label for="editarEmail">Estado</label>             
                                    <div class="form-group has-feedback">

                                            <input type="text" class="form-control" id="editarEstado" name="editarEstado" value="<?php echo $inventario[0]["estado"]; ?>" required>
                                            <input type="hidden" name="id" value="<?php echo $inventario[0]["idInventario"]; ?>">
                                        
                                    </div>
                                </div>

                                <!-- entrada de notas  -->
                                <div class="col-md-4" style="margin-top: 16px">
                                    <label for="editarEmail">Notas</label>             
                                    <div class="form-group has-feedback">

                                            <input type="text" class="form-control" id="editarNotas" name="editarNotas" value="<?php echo $inventario[0]["notas"]; ?>" required>
                                            <input type="hidden" name="id" value="<?php echo $inventario[0]["idInventario"]; ?>">
                                        
                                    </div>
                                </div>

        
                            </div>

                        <div class="modal-footer" style="margin-top: 16px !important;">

                            <button type="submit" class="btn btn-primary" >Guardar</button>

                        </div>

                    </form>

                      <!-- SE LLAMA LA FUNCIÓN DEL CONTROLADOR QUE PERMITE EDITAR EL INVENTARIO -->
           
                        <?php 

                            $editarInventario = new ControladorInventario();
                            $editarInventario -> ctrEditarInventario();

                        ?>

                    </div>

                </div>
      
    </section>
    
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