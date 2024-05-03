<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-pencil-square-o" ></i>&nbsp;Editar Operación</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"><a href="operaciones" >Operaciones</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Operación</li>
                </ol>
          </nav>
     
            <div class="panel box-box">

                <div class="box-header py-3">
              
             
                </div>

                     <div class="box-body">

                         <form role="form" method="post" class="formularioActa">

                            <div class="box-body ">

                                <?php

                                $item = "id";
                                $valor = $_GET["id"];

                                $operacion = ControladorOperaciones::ctrMostrarOperacion($item, $valor);

                                foreach ($operacion as $key => $value) {

                                $item = "idCliente";
                                $valor = $value["id_cliente"];

                                $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                                
                                $idCliente = $cliente[0] ["idCliente"];

                                $nombreCliente = $cliente[0] ["nombre"]; }
                                        
                                ?>

                                <div class="col-md-6" style="margin-top: 16px">
                                    <label for="editar">ID</label>              
                                    <div class="form-group has-feedback">
                                                    
                                            <input type="text" class="form-control" id="editarId" name="editarId" value="<?php echo $operacion[0]["id"]; ?>"  readonly>
                                            <input type="hidden" id="id" name="id" value="<?php echo $operacion[0]["id"]; ?>">
                                    </div>
                                </div>


                                    <div class="col-md-6" style="margin-top: 16px">
                                        <label for="edita">Nombre</label>             
                                        <div class="form-group has-feedback">

                                                <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="<?php echo $nombreCliente?>" required>
                                                <input type="hidden" name="id" value="<?php echo $operacion[0]["id"]; ?>">
                                                <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-6" style="margin-top: 16px">
                                        <label for="editarCliente">Usuario</label>              
                                        <div class="form-group has-feedback">
                                                        
                                                <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" value="<?php echo $operacion[0]["usuario"]; ?>" required>
                                                <input type="hidden" id="id" name="id" value="<?php echo $operacion[0]["id"]; ?>">
                                        </div>
                                    </div>


                                    <div class="col-md-6" style="margin-top: 16px">
                                        <label for="editarEmail">Contraseña</label>             
                                        <div class="form-group has-feedback">

                                                <input type="text" class="form-control" id="editarPassword" name="editarPassword" value="<?php echo $operacion[0]["password"]; ?>" required>
                                                <input type="hidden" name="id" value="<?php echo $operacion[0]["id"]; ?>">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6" style="margin-top: 16px">
                                     <div class="form-group has-feedback">
                                       <?php
                                    if ($_SESSION["perfil"] == "Invitado") {
                     
                                    } else {
                                        if ($value["estado"] != 0) {
                                            echo '<td><input type="checkbox" class="chkActivarO" id="' . $value["id"] . '" estadoOperacion="0" checked>Call-Center</td>';
                                        } else {
                                            echo '<td><input type="checkbox" class="chkActivarO" id="' . $value["id"] . '" estadoOperacion="1"></td>';
                                        }
                                    }
                                    ?>
                                    </div>
                                    </div>

        
                            </div>

                        <div class="modal-footer" style="margin-top: 16px !important;">

                            <button type="submit" class="btn btn-primary" >Guardar</button>

                        </div>

                    </form>
           
                        <?php 

                            $editarOperacion = new ControladorOperaciones();
                            $editarOperacion -> ctrEditarOperacion();

                        ?>

                    </div>

                </div>
      
    </section>
    <!-- /.content -->
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