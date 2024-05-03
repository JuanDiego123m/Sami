<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Administrar usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
              
              Nuevo usuario

            </button>

          
        </div>


        <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablas">
            
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
            
            <tr>
              
              <td>1</td>
              <td>Usuario administrador</td>
              <td>admin</td>
              <td><img src="vistas/img/usuarios/user.png" class="img-thumbnail" width="40px"></td>
              <td>Administrador</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2020-01-16 21:00:21</td>
              <td>
                <div class="btn-group">
                  
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>


                </div>



              </td>


            </tr>


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

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

          <!--=======================
      CABEZA MODAL
      =======================-->

        <div class="modal-header" style="background: #00c0ef; color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=======================
      CUERPO MODAL
      =======================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA NOMBRE-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Nombre" required>

              </div>

            </div>

            <!--ENTRADA USUARIO-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Usuario" required>

              </div>

            </div>

            <!--ENTRADA CONTRASEÑA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Contraseña" required>

              </div>

            </div>
            
            <!--ENTRADA PERFIL-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Seleccionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!--ENTRADA FOTO-->

            <div class="form-group">
              
              <div class="panel">Subir foto</div>

              <input type="file" id="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Máximo 50mb</p>

              <img src="vistas/img/usuarios/user.png" class="img-thumbnail" width="100px">

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

    </div>

  </div>

</div>