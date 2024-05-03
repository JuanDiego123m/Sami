<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Inventario</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inventario</li>
                </ol>
          </nav>  

      <div class="panel box-box">
        <div class="box-header with-border">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarInventario"><i class='fa fa-plus-circle'></i>
              Nuevo
        </button>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCargarItemsInventario"><i class='fa fa-upload'></i>
             Importar
        </button> 

     

        <button type="button" class="btn btn-primary" id="ActaEntrega" onClick="location.href='acta-2'">
          Crear Acta
        </button>
        

        <a href="extensiones/excel/inventario_reporte.php" target="_blank" role="button" aria-pressed="true" class="btn btn-primary">
          <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
        </a>


        <a href="extensiones/excel/inventario_stock.php" target="_blank" role="button" aria-pressed="true" class="btn btn-primary ml-5">
          <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel Stock
        </a>

        </div>

        <div class="box-body" id="tabla-inventario">

        <table class="table table-bordered table-striped dt-responsive tablas" >

            <thead>
              
              <tr>
                     <th style="width: 10px">#</th>
                <th>Empleado</th>
                <th>Tipo de Activo</th>  
                <th>Serial</th>
                <th>Estado</th>
                <th>Asignado</th>
                <th>Notas</th>
                <th>Ultima Modificación</th>
                <th>Acciones</th>
                
              </tr>

            </thead>

            <tbody>

             <!-- FUNCION DEL CONTROLADOR QUE MUESTRA LA INFORMACION DEL INVENTARIO  -->
              <?php
              $item = null;
              $valor = null;

              $inventario = ControladorInventario::ctrMostrarItems($item, $valor);

              foreach ($inventario as $key => $value) {
                
                      // Obtiene y muestra el nombre del empleado dependiendo de su ID
                      $item = "idEmpleado";
                      $valor = $value["id_empleado"];
                      $empleado = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                      
                      if(!$empleado){
                          $nombreEmpleado = "NA";
                      }else{
                          $nombreEmpleado = $empleado[0]["nombre"];
                      }

                      $item = "idEmpleado";
                      $valor = $value["propietario"];
                      $empleadoPropietario = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                      
                      if(!$empleadoPropietario){
                          $nombrePropietario = "NA";
                      }else{
                          $nombrePropietario = $empleadoPropietario[0]["nombre"];
                      }

                      echo '<tr>
                            <td>'.($key+1).'</td>
                            <td><a href="#" class="btnEditarEmpleado" idEmpleado="'.$value["id_empleado"].'">'.strtoupper($nombreEmpleado).'</a></td>
                            <td>'.$value["tipoActivo"].'</td>
                            <td>'.$value["serial"].'</td>
                            <td>'.$value["estado"].'</td>
                            <td>'.$nombrePropietario.'</td>
                            <td>'.$value["notas"].'</td>
                            <td>'.$value["ultima_modificacion"].'</td>
                            <td>
                              <div class="btn-group">
                                <button class="btn btn-primary btnEditarInventario" idInventario="'.$value["idInventario"].'"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btnEliminarInventario" idInventa="'.$value["idInventario"].'" ><i class="fa fa-trash-alt"></i></button>
                              </div>
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
    MODAL AGREGAR INVENTARIO
    =======================-->
    
    <div id="modalAgregarInventario" class="modal fade" role="dialog">

     <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 8px !important">
    
          <form role="form" method="post">

            <!--=======================
            CABEZA MODAL
            =======================-->
        
              <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">
        
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
        
                <h4 class="modal-title">Agregar Inventario</h4>
        
              </div>

                  <!--=======================
                CUERPO MODAL
                =======================-->
            
                  <div class="modal-body">
            
                    <div class="box-body">
            
                      
                        <div class="modal-body">
                      
                          <!--ENTRADA ACTIVO-->
                          
                          <div class="form-group">
                            
                            <div class="form-group has-feedback">
                              
                              <input type="text" class="form-control"name="nuevotipoActivo" placeholder="Activo" required>
                             
                            </div>
                
                          </div>
            
                                     <!--ENTRADA SERIAL-->
                                  
                                <div class="form-group">
                                    
                                    <div class="form-group has-feedback">
                                      
                                      <input type="text" class="form-control" name="nuevoSerial" placeholder="Serial" required>
                                      
                                    </div>
                        
                                </div>
                        
                                  <!--ENTRADA ESTADO-->
                                  
                                  <div class="form-group">
                                    
                                    <div class="form-group has-feedback">
                                        
                                        <select id="Nombres" class="form-control " name="nuevoEstado" aria-label="Default select example" style="width: 100%">
                                            <option>Asignado</option>
                                            <option>En Stock</option>
                                        </select>
                                      
                                    </div>
                        
                                  </div>
                        
                                <!--ENTRADA EMPLEADO ASIGNADO-->
                                <div class="form-group">
                                    
                                    <div class="form-group has-feedback">
                        
                                        <select  id="nombre" class="form-control select_buscador_modal2 " name="nuevoPropietario" aria-label="Default select example" style="width: 100%">
                                          
                                            <!--TRAE EL NOMBRE DEL EMPLEADO DEPENDIENDO DE SU ID ADEMÁS DE UNA 
                                            CONDICION QUE MUESTRA A LOS EMPLEADOS QUE SOLO ESTAN HABILITADOS EN LA PAGINA-->
                                            <?php 
                                            $item = null;
                                            $valor = null;
                                
                                            $empleados = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);
                                
                                            foreach($empleados as $key => $value): 
                                
                                              if ($value["estado"] == 1):
                                
                                                echo'<option  value="'.$value["idEmpleado"].'">'.$value["nombre"].'</option>';
                                
                                              endif;
                                                
                                            endforeach; 
                                            ?>
                                          
                                        </select>
                                        
                                    </div>
                        
                                 </div>
            
                        
                                     <!--ENTRADA CARGO-->
                                  
                                <div class="form-group">
                                    
                                    <div class="form-group has-feedback">
                                      
                                      <input type="text" class="form-control" name="nuevaNota" placeholder="Notas" required>
                                      
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
                
                      </div>
                
                      <?php
                
                      $crearInventario = new ControladorInventario();
                      $crearInventario -> ctrCrearItem();
                
                      ?>
                
             </form>
                
        </div>
                
    </div>
                
</div>


<!--=======================
MODAL CARGA ITEMS
=======================-->

<div id="modalCargarItemsInventario" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 8px !important">
            
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=======================
                  CABEZA MODAL
                  =======================-->

                <div class="modal-header" >

                  <h4 class="modal-title">Cargar Inventario</h4>

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
                                <a href="public/inventario.xlsx" class="btn btn-default" download><i class='fa fa-cloud-download'></i> Plantilla</a>
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

                <?php 

                   $cargaItems = new ControladorInventario();
                   $cargaItems -> ctrCargaMasivaItems();

                ?> 

            </form>

        </div>

    </div>

</div>
       

<?php 

      $eliminarInventario = new ControladorInventario();
      $eliminarInventario -> ctrEliminarInventario();

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