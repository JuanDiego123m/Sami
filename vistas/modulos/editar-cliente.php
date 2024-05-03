<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-pencil-square-o" ></i>&nbsp;Editar Cliente</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"><a href="clientes" >Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Cliente</li>
                </ol>
          </nav>

         <div>  

          <div class="panel box-box col-md-3">

          <div class="panel box-box">
          
           <form role="form" method="post" class="formularioCliente">
            
                  <div class="col-md-2"><h3>General</h3></div>
                  

             
              <?php

              $item = "idCliente";
              $valor = $_GET["idCliente"];
              $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                                                  
              ?>

                 <!-- Entrada del cliente -->
                          <div class="col-md-12" style="margin-top: 16px">
                              <label for="editarCliente">Cliente</label>              
                              <div class="form-group has-feedback">
                                              
                                    <input type="text" class="form-control" id="editarCliente" name="editarCliente" value="<?php echo $cliente[0]["nombre"]; ?>" required>
                                    <input type="hidden" id="idCliente" name="idCliente" value="<?php echo $cliente[0]["idCliente"]; ?>">
                                  
                              </div>
                          </div>


                          <div class="col-md-12" style="margin-top: 16px">
                              <label for="editarDocumentoId">Nit</label>             
                              <div class="form-group has-feedback">

                                    <input type="number" class="form-control" min="0" id="editarNit" name="editarNit" value="<?php echo $cliente[0]["nit"]; ?>" required>
                                    <input type="hidden" name="idCliente" value="<?php echo $cliente[0]["idCliente"]; ?>">

                              </div>
                          </div>
              
              </div>

            <div class="modal-footer" style="margin-top: 16px !important;">

            <button type="submit" class="btn btn-primary">Guardar</button>

            </div>

            </form>

           <?php 

              $editarCliente = new ControladorClientes();
              $editarCliente -> ctrEditarCliente();

            ?>

          </div>

        </div>



        <!-- VISTA DE LA TABLA CON LA DID -->

        <div class="col-md-9">

          <div class="panel box-box d-flex">

            <div class="box-header with-border">

                <div class="col-md-2"><h3>DID</h3></div>
                <div class="col-md-10" style="margin-top: 16px;">
              
                </div>

            </div>

            <form role="form" method="post" class="formularioDID">

              <div class="box-body d-flex">

                <table class="table table-bordered table-striped dt-responsive tablas">
            
                  <thead>
                    
                    <tr>
                      
                      <th style="width: 10px">#</th>
                      <th>Cliente</th>
                      <th>Operacion</th>
                      <th>Troncales</th>
                      <th>Proveedor</th>
                      <th>Ciudad</th>
                      <th></th>
                      


                    </tr>


                  </thead>

                  <tbody>

                   <?php 

                    $item = "id_cliente";
                    $valor = $_GET['idCliente'];
                    $did = ControladorDID::ctrMostrarTodosLosDID($item, $valor);

                    foreach ($did as $key => $value) {

                      $item = "idCliente";
                      $valor = $value["id_cliente"];
      
                      $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
      
                      $nombreCliente = $cliente[0]["nombre"]; 

                        echo '<tr>
                        <td>'.($key+1).'</td>
                        <td><a href="#" class="btnEditarDID" idDid="'.$value["idDid"].'">'.strtoupper( $nombreCliente).'</a></td>
                        <td>'.$value["operacion"].'</td>
                        <td>'.$value["troncales"].'</td>
                        <td>'.$value["proveedor"].'</td>
                        <td>'.$value["ciudad"].'</td>

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
