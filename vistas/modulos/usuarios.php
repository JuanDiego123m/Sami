<div class="content" style="background-color: #EBEBEB">
    <!-- Content Header (Page header) -->
    
        <h4><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Usuarios</h4>
          
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Administrar Usuarios</li>
              </ol>
          </nav>  

        <div class="panel box-box">

        <div class="box-header with-border">
          
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"><i class='fa fa-plus-circle'></i>
              
              Nuevo

            </button>

          
        </div>


        <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablas" >
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Último ingreso</th>
                <th>Acciones</th>


              </tr>


            </thead>

            <tbody>

              <?php

                $item = null;
                $valor = null;

                $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                foreach ($usuarios as $key => $value) {
                  
                  echo '<tr>
              
                        <td>'.($key+1).'</td>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["usuario"].'</td>';

                        if($value["foto"] != ""){

                          echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                        }else{

                          echo '<td><img src="vistas/img/usuarios/user.png" class="img-thumbnail" width="40px"></td>';
                        }
                        

                        echo
                        '<td>'.$value["perfil"].'</td>';

                        if($value["estado"] != 0){

                          echo '<td><button class="btn btn-cr btn-sm btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Habilitado</button></td>';

                        }else{

                          echo '<td><button class="btn btn-danger btn-sm btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Suspendido</button></td>';

                        } 
                        

                        echo '
                        <td>'.$value["ultimo_login"].'</td>
                        <td>
                          <div class="btn-group">
                            
                            <button class="btn btn-primary btnEditarUsuario" idUsuario="'.$value["id"].'"  data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-edit"></i></button>

                            <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-trash-alt"></i></button>


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
    MODAL AGREGAR USUARIO
    =======================-->

    
<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 8px !important">

        <form role="form" method="post" enctype="multipart/form-data">

          <!--=======================
      CABEZA MODAL
      =======================-->

        <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">

          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=======================
      CUERPO MODAL
      =======================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA NOMBRE-->
            
            <div class="form-group has-feedback">

                <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre" required>

            </div>

            <!--ENTRADA USUARIO-->

            <div class="form-group has-feedback">
              
                <input type="text" class="form-control" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

            </div>

            <!--ENTRADA CONTRASEÑA-->

            <div class="form-group has-feedback">
              

                <input type="password" class="form-control" name="nuevoPassword" placeholder="Contraseña" required>
              

            </div>
            
            <!--ENTRADA PERFIL-->

            <div class="form-group has-feedback">
              

                <select class="form-control" name="nuevoPerfil">
                  
                  <option value="">Seleccionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Tecnico">Técnico</option>

                  <option value="Invitado">Invitado</option>

                </select>


            </div>

            <!--ENTRADA FOTO-->

            <div class="form-group">
              
              <div class="panel">Subir foto</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Máximo 50mb</p>

              <img src="vistas/img/usuarios/user.png" class="img-thumbnail previsualizar" width="100px">

            </div>



          </div>

        </div>

        <!--=======================
      PIE MODAL
      =======================-->

        <div class="modal-footer">

        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>

        <button type="submit" class="btn btn-primary"> Guardar</button>

        </div>

        <?php

          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=======================
    MODAL EDITAR USUARIO
    =======================-->

    
<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 8px !important">

        <form role="form" method="post" enctype="multipart/form-data">

          <!--=======================
      CABEZA MODAL
      =======================-->

        <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">

          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=======================
      CUERPO MODAL
      =======================-->

        <div class="modal-body">

          <div class="box-body">
            

            <!--ENTRADA NOMBRE-->
            
            <div class="form-group">
              
              <div class="form-group has-feedback">

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="Nombre" required>

              </div>

            </div>

            <!--ENTRADA USUARIO-->

            <div class="form-group">
              
              <div class="form-group has-feedback">
        
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!--ENTRADA CONTRASEÑA-->

            <div class="form-group">
              
              <div class="form-group has-feedback">
                
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>
            
            <!--ENTRADA PERFIL-->

            <div class="form-group">
              
              <div class="form-group has-feedback">

                <select class="form-control" name="editarPerfil">
                  
                  <option value="">Seleccionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Tecnico">Técnico</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                  <option value="Invitado">Invitado</option>

                </select>

              </div>

            </div>

            <!--ENTRADA FOTO-->

            <div class="form-group">
              
              <div class="panel">Subir foto</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Máximo 50mb</p>

              <img src="vistas/img/usuarios/user.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>



          </div>

        </div>

        <!--=======================
      PIE MODAL
      =======================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<?php
  
  $borrarUario = new ControladorUsuarios();
  $borrarUario -> ctrBorrarUsuario();

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
 