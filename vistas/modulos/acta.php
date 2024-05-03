<div class="content" style="background-color: #EBEBEB">

<h4><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;Actas de Entrega</h4>
   
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Actas</li>
                </ol>
            </nav>  

      <div class="panel box-box">

        <div class="box-header with-border">

        <button type="button" class="btn btn-primary" id="ActaEntrega" onClick="location.href='acta-2'">
          Crear
        </button>

        </div>


        <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablas"  >
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">Codigo</th> 
                <th>Empleado</th>
                <th>Activo</th>
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Acciones</th>
                


              </tr>


            </thead>

            <tbody>

              <?php
              $item = null;
              $valor = null;

              $acta = ControladorActa::ctrMostrarActa($item, $valor);

              foreach ($acta as $key => $value) {

                $id_actas = $value["id"];

                $item = "idEmpleado";
                $valor = $value["id_empleado"];

                $empleado = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);

                $nombreEmpleado = $empleado[0]["nombre"];

                $id_inventario = $value["id_inventario"];

                if (is_string($value["id_inventario"])) {

                  $id_inventario = json_decode($value["id_inventario"], true);

                }

                echo '<tr>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$nombreEmpleado.'</td>
                  <td>';

                if (is_array($id_inventario)) {
                  foreach ($id_inventario as $item) {
                    echo $item['activo'].' - '.$item['serial'].'<br>';
                  }
                } else {
                  echo $id_inventario;
                }

                echo '</td>
                 
                  <td>'.$value["fecha"].'</td>
                  <td>'.$value["descripcion"].'</td>
                  <td>
                    <div class="btn-group">
                      <a href="extensiones/fpdf/acta_entrega.php?id='.$id_actas.'" target="_blank" role="button" aria-pressed="true" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                      <button class="btn btn-danger btnEliminarActa" idActa="'.$value["id"].'" ><i class="fa fa-trash-alt"></i></button>
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

   </div>

  </div>

</div>
       

<?php 

    $eliminarActa = new ControladorActa();
    $eliminarActa -> ctrEliminarActa();

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
  
  
  .btn-group .btn {
   
    margin-right: 5px; /* Añade espacio derecho entre los botones */
  }

  .btn-success {
    /* box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .40); */
    background: #fff;
    border: 1px solid #54c57a !important;
    border-radius: 50px;
    color: #54c57a;
    margin-right: 5px;
}


</style>
 