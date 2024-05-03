<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-spinner" aria-hidden="true"></i>&nbsp;Operaciones</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Operaciones</li>
                </ol>
          </nav>  

    <div class="panel box-box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarOperaciones"><i class='fa fa-plus-circle'></i>
          Nuevo
        </button>

      </div>

      <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
          <tr>
           
           <th style="width:10px">#</th>
           <th style="width:70px">Cliente</th>
           <th>Usuario</th>
           <th>Contraseña</th>
           <th>Acciones</th>
            <th></th>
           
          </tr> 

         </thead>

         <tbody>

       
         <?php 

          $item = null;
          $valor = null;

          $operacion = ControladorOperaciones::ctrMostrarOperacion($item, $valor);

          foreach ($operacion as $key => $value) {
              $item = "idCliente";
              $valor = $value["id_cliente"];

              $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
              
              if(!$cliente){
                  $nombreCliente = "NA";
              }else{
                  $nombreCliente = $cliente[0]["nombre"];
              }


              /*CONDICION QUE PERMITE VISUALIZAR LA INFORMACION DE LA 
              OPERACION DEPENDIENDO EL PERFIL INVITADO */

              if ($_SESSION["perfil"] == "Invitado" && $value["estado"] == 1) {
                
                  echo '<tr>
                      <td>'.($key+1).'</td>
                      <td><a href="#" class="btnEditarOperacion" id="'.$value["id"].'">'.strtoupper($nombreCliente).'</a></td>
                      <td>'.$value["usuario"].'</td>
                      <td>'.$value["password"].'</td>';

                  echo '<td>
                        <div class="btn-group">
                          <button class="btn btn-primary btnEditarOperacion" id="'.$value["id"].'"><i class="fa fa-edit"></i></button>';
                  
                  if ($_SESSION["perfil"] == "Invitado") {
                     
                  } else {
                      if ($value["estado"] != 0) {
                          echo '<td><input type="checkbox" class="chkActivarO" id="' . $value["id"] . '" estadoOperacion="0" checked>Call-Center</td>';
                      } else {
                          echo '<td><input type="checkbox" class="chkActivarO" id="' . $value["id"] . '" estadoOperacion="1"></td>';
                      }
                  }
                  
                  echo '</div>
                        </td>
                      </tr>';
              /*CONDICION QUE PERMITE VISUALIZAR LA INFORMACION DE LA 
              OPERACION DEPENDIENDO EL PERFIL ADMINISTRADOR */
                 } elseif ($_SESSION["perfil"] == "Administrador") {
                
                  echo '<tr>
                      <td>'.($key+1).'</td>
                      <td><a href="#" class="btnEditarOperacion" id="'.$value["id"].'">'.strtoupper($nombreCliente).'</a></td>
                      <td>'.$value["usuario"].'</td>
                      <td>'.$value["password"].'</td>';
                  
                  echo '<td>
                        <div class="btn-group">
                          <button class="btn btn-primary btnEditarOperacion" id="'.$value["id"].'"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-danger btnEliminarOperacion" idOperacion="'.$value["id"].'" ><i class="fa fa-trash-alt"></i></button>';
                  
                  if ($value["estado"] != 0) {
                      echo '<td><input type="checkbox" class="chkActivarO" id="' . $value["id"] . '" estadoOperacion="0" checked>Call-Center</td>';
                  } else {
                      echo '<td><input type="checkbox" class="chkActivarO" id="' . $value["id"] . '" estadoOperacion="1">Call-Center</td>';
                  }
                  
                  echo '</div>
                        </td>
                      </tr>';

              /*CONDICION QUE PERMITE VISUALIZAR LA INFORMACION DE LA 
              OPERACION DEPENDIENDO EL PERFIL TECNICO */

                }elseif ($_SESSION["perfil"] == "Tecnico") {
                  
                  echo '<tr>
                      <td>'.($key+1).'</td>
                      <td><a href="#" class="btnEditarOperacion" id="'.$value["id"].'">'.strtoupper($nombreCliente).'</a></td>
                      <td>'.$value["usuario"].'</td>
                      <td>'.$value["password"].'</td>';
                  
                  echo '<td>
                        <div class="btn-group">
                          <button class="btn btn-primary btnEditarOperacion" id="'.$value["id"].'"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-danger btnEliminarOperacion" idOperacion="'.$value["id"].'" ><i class="fa fa-trash-alt"></i></button>';
                  
                  if ($value["estado"] != 0) {
                      echo '<td><input type="checkbox" class="chkActivarO" id="' . $value["id"] . '" estadoOperacion="0" checked>Call-Center</td>';
                  } else {
                      echo '<td><input type="checkbox" class="chkActivarO" id="' . $value["id"] . '" estadoOperacion="1">Call-Center</td>';
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

  </section>

</div>

   <!--=======================
    MODAL AGREGAR OPERACIÓN
    =======================-->

    
    <div id="modalAgregarOperaciones" class="modal fade" role="dialog">

      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="border-radius: 8px !important">

          <form role="form" method="post" enctype="multipart/form-data" id="formularioAgregarOperaciones">

            <!--=======================
                CABEZA MODAL
            =======================-->

          <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Operación</h4>

          </div>

            <!--=======================
          CUERPO MODAL
          =======================-->

            <div class="modal-body">

              <div class="box-body">

                    <!--ENTRADA NOMBRE-->
                
                  <?php
                  $item = null;
                  $valor = null;

                  $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                  ?>

                  <div class="form-group">
                    
                    <div class="form-group has-feedback">

                      <select  id="Nombres" class="form-control select_buscador_modalOperaciones" name="nuevoCliente" aria-label="Default select example" style="width: 100%">

                        <?php foreach($clientes as $key => $value): ?>
                        <option  value="<?= $value['idCliente'] ?>"><?= $value["nombre"] ?></option>
                        <?php endforeach; ?>

                      </select>
                  
                    </div>

                  </div>

                  <!--ENTRADA USUARIO-->

                  <div class="form-group">
                      
                      <div class="form-group has-feedback">
                        
                        <input type="text" class="form-control" name="nuevoUsuario" placeholder="Usuario" required>
                    
                      </div>

                  </div>


                  <!--ENTRADA PASSWORD-->

                  <div class="form-group">
                      
                      <div class="form-group has-feedback">
                        
                        <input type="text" class="form-control" name="nuevoPassword" placeholder="Password" required>
                    
                      </div>

                  </div>

              <!--=======================
                PIE MODAL
              =======================-->

              <div class="modal-footer">

                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-primary">Guardar</button>

              </div>
                  
            </form>

          </div>

        </div>

      <?php

        $crearOperacion = new ControladorOperaciones();
        $crearOperacion -> ctrCrearOperacion();

      ?> 
     </div>

  </div>

</div>

<?php

$EliminarOperacion = new ControladorOperaciones();
$EliminarOperacion -> ctrEliminarOperacion();

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