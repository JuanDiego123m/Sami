<?php 

$item = "idDid";
$valor = $_GET["idDID"];
$DID = ControladorDID::ctrMostrarDID($item, $valor);

$itemOperacion = "id";
$valorOperacion = $DID["operacion"];
$operacion = ControladorOperaciones::ctrMostrarOperacion($itemOperacion, $valorOperacion);

$itemCliente = "idCliente";
$valorCliente = $DID["id_cliente"];
$cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
?>
<!-- VISTA PARA EDITAR LA INFORMACIÓN DE UN DID ADEMÁS SE MUESTRA LA INFORMACIÓN DE EL CLIENTE Y SU OPERACION -->
<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-pencil-square-o" ></i>&nbsp;Editar DID</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"><a href="DID" >DID</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar DID</li>
                </ol>
          </nav>

      <div>  

      <div class="panel box-box col-md-3">

        <div class="panel box-box">

          <form role="form" method="post" class="formularioDID" name="formularioDID">
            
              <div class="col-md-2"><h3>General</h3></div>

                    <!-- Entrada del DID -->

                    <div class="col-md-12" style="margin-top: 16px">

                        <label for="editarDID" >DID</label>  

                      <div class="form-group has-feedback">
                                    
                        <input type="text" class="form-control" id="editarDID" name="editarDID" value="<?php echo $DID["did"] ?>" required>
                        <input type="hidden" id="idDid" name="idDid" value="<?php echo $DID["idDid"] ?>">

                          
                      </div>
                    </div>

                    <!-- Entrada del cliente -->
                    <div class="col-md-12" style="margin-top: 16px">

                        <div class="form-group has-feedback">
                          
                            <label>Cliente</label>
                            
                            <select  id="nuevoCliente" class="form-control select_buscador" name="editarCliente" aria-label="Default select example" style="width: 100%" required>
                                
                                <option  value="<?php echo $cliente[0]["idCliente"] ?>"><?php echo $cliente[0]["nombre"] ?></option>
                                
                                <?php 
                                
                                $item = null;
                                $valor = null;
        
                                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                                
                                foreach($clientes as $key => $value): 
                                
                                    echo'
                                    <option  value="'.$value['idCliente'].'">'.$value["nombre"].'</option>';
                                
                                endforeach; 
                                
                                ?>
            
                            </select>

                        </div>
                        
                    </div>

                    <!-- Entrada de la operacion -->
                    <div class="col-md-12" style="margin-top: 16px">

                        <div class="form-group has-feedback">
                          
                            <label>Operación</label>
                            
                            <select  id="nuevaOperacion" class="form-control select_buscador" name="editarOperaciones" aria-label="Default select example" style="width: 100%" required>
                                
                                <option  value="<?php echo $operacion[0]["id"] ?>"><?php echo $operacion[0]["usuario"] ?></option>
                                
                                <?php 
                                
                                $item = null;
                                $valor = null;
        
                                $operaciones = ControladorOperaciones::ctrMostrarOperacion($item, $valor);
                                
                                foreach($operaciones as $key => $value): 
                                
                                    echo'
                                    <option  value="'.$value['id'].'">'.$value["usuario"].'</option>';
                                
                                endforeach; 
                                
                                ?>
            
                            </select>

                        </div>
                        
                    </div>

                    <!-- Entrada de los troncales -->
                    <div class="col-md-12" style="margin-top: 16px">

                      <label for="editar">Troncales</label>    

                        <div class="form-group has-feedback">

                          <input type="text" class="form-control"  id="editarTroncal" name="editarTroncal" value="<?php echo $DID["troncales"] ?>" required>

                        </div>
                    </div>


                    <!-- Entrada del proveedor -->
                    <div class="col-md-12" style="margin-top: 16px">

                      <label for="editar">Proveedor</label>          

                        <div class="form-group has-feedback">

                          <input type="text" class="form-control"  id="editarProveedor" name="editarProveedor" value="<?php echo $DID["proveedor"] ?>" required>


                        </div>
                    </div>


                     <!-- Entrada del ciudad -->
                    <div class="col-md-12" style="margin-top: 16px">

                      <label for="editar">Ciudad</label>    

                        <div class="form-group has-feedback">

                          <input type="text" class="form-control" id="editarCiudad" name="editarCiudad" value="<?php echo $DID["ciudad"] ?>" required>


                        </div>
                    </div>

              
              </div>

                <div class="modal-footer" style="margin-top: 16px !important;">

                  <button type="submit" class="btn btn-primary">Guardar</button>

                </div>

          </form>

            <?php 

              $editarDID = new ControladorDID();
              $editarDID -> ctrEditarDID();

            ?>

        </div>

      </div>


      <!-- VISTA DE LA TABLA CON LA INFORMACIÓN DE LAS OPERACIONES  -->

        <div class="col-md-9">

          <div class="panel box-box d-flex">

            <div class="box-header with-border">

                <div class="col-md-2"><h3>Operaciones</h3></div>
                <div class="col-md-10" style="margin-top: 16px;">
                  
                </div>

            </div>

            <form role="form" method="post" class="formularioOperaciones">

              <div class="box-body d-flex">

                <table class="table table-bordered table-striped dt-responsive tablas">
            
                  <thead>
                    
                    <tr>
                      
                      <th style="width: 10px">#</th>
                      <th>Cliente</th>
                      <th>Usuario</th>
                      <th>Contraseña</th>
                      <th> </th>
                    </tr>


                  </thead>

                  <tbody>

                  <!-- SE LLAMA LA FUNCIÓN DEL CONTROLADOR QUE PERMITE MOSTRAR LA OPERACION -->
                  <?php 
                  
                  //Cambio de foreach por el cliente si se encuentra Null              
                  foreach ($operacion as $key => $value) {
                    $itemCliente = "idCliente";
                    $valorCliente = $value["id_cliente"];
                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
                
                    echo '<tr>';
                    echo '<td>'.($key+1).'</td>';
                
                    if (!empty($cliente)) {
                        echo '<td><a href="#" class="btnEditarOperacion" id="'.$cliente[0]["idCliente"].'">'.strtoupper($cliente[0]["nombre"]).'</a></td>';
                    } else {
                        echo '<td>Información Vacia</td>';
                    }
                
                    echo '<td>'.$value["usuario"].'</td>';
                    echo '<td>'.$value["password"].'</td>';
                    echo '<td>';
                }
                

                  ?>
                  
                  

                </tbody>


                </table>

            
              </div>

            </form>

          </div>

        </div>


        <!-- VISTA DE LA TABLA CON LA INFORMACION DEL CLIENTE -->

        <div class="col-md-9">

          <div class="panel box-box">

             <form role="form" method="post" class="formularioClientes">

              <div class="box-body d-flex">

                <div class="box-header with-border">
              
                    <div class="col-md-2"><h3>Clientes</h3></div>
                    <div class="col-md-10" style="margin-top: 16px;">
                     
                    </div>

                </div>

                <table class="table table-bordered table-striped dt-responsive tablas">
            
                  <thead>
                    
                    <tr>
                      
                      <th style="width: 10px">#</th>
                      <th>Nombre</th>
                      <th>NIT</th>
                      <th></th>
                      


                    </tr>


                  </thead>

                  <tbody>

                  <!-- SE LLAMA LA FUNCIÓN DEL CONTROLADOR QUE PERMITE MOSTRAR EL CLIENTE -->
                   <?php 

                        foreach ($cliente as $key => $value) {
                          
                            echo '
                            <tr>
                      
                                <td>'.($key+1).'</td>
                                <td><a href="#" class="btnEditarCliente" idCliente="'.$value["idCliente"].'">'.strtoupper($value["nombre"]).'</a></td>
                                <td>'.$value["nit"].'</td>
                              
        
                       
                                <td>
        
                                  <div class="btn-group">
                                    
        
    
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