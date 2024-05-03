
<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-podcast" aria-hidden="true"></i>&nbsp;DID</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">DID</li>
                </ol>
          </nav>  

    <div class="panel box-box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDID"><i class='fa fa-plus-circle'></i>
          
          Nuevo

        </button>

        <a href="extensiones/excel/did_reporte.php" target="_blank" role="button" aria-pressed="true" class="btn btn-primary"><i class="fa fa-file-excel-o" aria-hidden="true"></i> 
            Excel
        </a>

      </div>

      <div class="box-body">
        
      <table class="table table-striped tablas" style="width: 100%">
         
        <thead>
         
          <tr>
           
           <th style="width:10px">#</th>
           <th>DID</th>
           <th>Cliente</th>
           <th>Operación</th>
           <th>Troncales</th>
           <th>Proveedor</th>
           <th>Ciudad</th>
           <th>Acciones</th>
           
          </tr> 

         </thead>

         <tbody>

       
         <!-- SE LLAMA LA FUNCIÓN DEL CONTROLADOR QUE PERMITE MOSTRAR LOS DIDS -->
         <?php 

        $item = null;
        $valor = null;

        $did = ControladorDID::ctrMostrarDID($item, $valor);

        foreach ($did as $key => $value) {

            $item = "idCliente";
            $valor = $value["id_cliente"];
            $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
            
            $itemOperacion = "id";
            $valorOperacion = $value["operacion"];
            $operacion = ControladorOperaciones::ctrMostrarOperacion($itemOperacion, $valorOperacion);
            
            echo '
            
            <tr>
                <td>'.($key+1).'</td>
                <td><a href="#" class="btnEditarDID" idDID="'.$value["idDid"].'">'.$value["did"].'</a></td>
                <td><a href="index.php?ruta=editar-cliente&idCliente='.$value["id_cliente"].'" class="">'.strtoupper($cliente[0]["nombre"]).'</a></td>
                <td>'.$operacion[0]["usuario"].'</td>
                <td>'.$value["troncales"].'</td>
                <td>'.$value["proveedor"].'</td>
                <td>'.$value["ciudad"].'</td>
    
    
                <td>
        
                  <div class="btn-group">
                    
                    <button class="btn btn-primary btnEditarDID" idDid="'.$value["idDid"].'"><i class="fa fa-edit"></i></button>
        
                    <button class="btn btn-danger btnEliminarDID" idD="'.$value["idDid"].'" ><i class="fa fa-trash-alt"></i></button>
        
        
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
MODAL AGREGAR DID
=======================-->

    
<div id="modalAgregarDID" class="modal fade" role="dialog">

    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content" style="border-radius: 8px !important">
    
            <form role="form" method="post" enctype="multipart/form-data">
    
                <!--=======================
                CABEZA MODAL
                =======================-->
                <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">
                    
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar DID</h4>
        
                </div>
        
                <!--=======================
                 CUERPO MODAL
                =======================-->
        
                <div class="modal-body">
        
                    <!--ENTRADA NOMBRE-->
                  
                    <?php
                    $item = null;
                    $valor = null;
        
                    $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                    ?>
                    
                    <div class="form-group">
                      
                        <div class="form-group has-feedback">
                        
                            <input type="number" class="form-control" name="nuevoDid" placeholder="DID" required>
                     
                        </div>
        
                    </div>
        
                    <div class="form-group">
                      
                        <div class="form-group has-feedback">
                            
                            <label>Cliente</label>
        
                            <select  id="nuevoCliente" class="form-control select_buscador_modal" name="nuevoCliente" aria-label="Default select example" style="width: 100%">
            
                                <?php foreach($clientes as $key => $value): ?>
                                
                                <option  value="<?= $value['idCliente'] ?>"><?= $value["nombre"] ?></option>
                                <?php endforeach; ?>
            
                            </select>
                     
                        </div>
        
                    </div>
        
                    <!--ENTRADA OPERACION-->
        
                    <div class="form-group">
                      
                        <div class="form-group has-feedback">
                            
                            <label>Operación</label>
                            
                            <select  id="nuevaOperacion" class="form-control select_buscador_modal" name="nuevaOperacion" aria-label="Default select example" style="width: 100%">
            
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
        
                     <!--ENTRADA TRONCALES-->
        
                    <div class="form-group">
                      
                        <div class="form-group has-feedback">
                          
                            <label>Cantidad troncales</label>
                        
                            <input type="number" class="form-control" name="nuevoTroncal" placeholder="Troncales" required>
                     
                        </div>
        
                    </div>
                    
        
                    <!--ENTRADA PROVEEDOR-->
                    <div class="form-group">
                      
                      <div class="form-group has-feedback">
                        
                        <input type="text" class="form-control" name="nuevoProveedor" placeholder="Nombre Proveedor" required>
                     
                      </div>
        
                    </div>
        
                    <!--ENTRADA CIUDAD-->
        
                    <div class="form-group">
                      
                        <div class="form-group has-feedback">
                            
                            <label>Ciudad</label>
                        
                            <input type="text" class="form-control" name="nuevaCiudad" placeholder="Ciudad" required>
                     
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
              
            </form>
        
            <?php
        
              $crearDID = new ControladorDID();
              $crearDID -> ctrCrearDID();
        
            ?> 
    
        </div>
    
    </div>

</div>

<?php

$eliminarDID = new ControladorDID();
$eliminarDID -> ctrEliminarDID();

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
 
 