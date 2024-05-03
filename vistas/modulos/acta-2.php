<div class="content" style="background-color: #EBEBEB">

      <h4><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Nueva Acta de Entrega</h4>
   
          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio" ><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"><a href="inventario" >Inventario</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Acta de Entrega</li>
                </ol>
          </nav>


            <div class="panel box-box">

                <div class="box-header py-3">
                                
            </div>

                <div class="box-body">
                                            

                    <form role="form" method="post" class="formularioActa" enctype="multipart/form-data">

                    <div class="card-body">

                        <div class="row">

                            <!-- CODIGO ACTA -->     
                                
                            <div class="col-md-6 col-lg-6 col-sm-6 mg16">
                                <label>Codigo Acta</label>
                                <div class="mt-3 form-floating">
                                            
                                                <?php 

                                                $item = null;
                                                $valor = null;

                                                $actas = ControladorActa::ctrMostrarUltimoCodigoActa($item, $valor);

                                                if($actas["0"] == null){

                                                    echo '<input type="text" class="form-control" name="nuevaActa" id="nuevaActa" value="10001" readonly>';

                                                }else{

                                                    foreach($actas as $key => $value){

                                                    }

                                                    $codigo = $actas["0"]+1;

                                                    echo '<input type="text" class="form-control" name="nuevaActa" id="nuevaActa" value="'.$codigo.'" readonly>';

                                                }

                                                ?>
                                        </div>
                                </div>
                                            
                                                

                                <!-- FECHA --> 

                                <div class="col-md-6 col-lg-6 col-sm-6 mg16">
                                <label>Fecha</label>
                                <div class="mt-3 form-floating">
                                        <input type="date" class="form-control" id="nuevaFecha" name="nuevaFecha"  required>
                                    </div>
                                </div>
                                

                                <!-- EMPLEADOS -->

                                <div class="col-md-6" style="margin-top: 16px">
                                    <label for="seleccionarEmpleado">Empleado</label>  
                                        <div class="form-group has-feedback d-flex">

                                            <select class="form-select select-buscador" id="seleccionarEmpleado" name="seleccionarEmpleado" style="width: 100%" required>
                                                        
                                                <option value="">Seleccionar Empleado</option>

                                                <?php
                                                    $item = null;
                                                    $valor = null;

                                                    $empleados = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);

                                                    foreach ($empleados as $key => $value) {
                                                        if ($value["estado"] == 1 && $value["idEmpleado"] != 0) {
                                                            echo '<option value="' . $value["idEmpleado"] . '">' . $value["nombre"] . '</option>';
                                                        }
                                                    }
                                                ?>

                                            </select>
                                        </div>
                                </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <label><strong>Firma Mesa de Servicios</strong></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="firmamesa" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Firma Empleado</strong></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="firmaempleado" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>                            
                            <!-- AGREGAR ACTIVO -->
                            <div class="nuevoActivo mg16">

                            </div>

                                <br>

                                    <input type="hidden" id="listaProductos" name="listaProductos">

                                        <div class="col-md-3 col-xs-3 d-lg-none mg16" style="margin-bottom: 16px">

                                            <button type="button" class="btn btn-primary btnAgregarProducto">Agregar Activo</button>

                                        </div>


                                        <!-- DESCRIPCIÓN -->                        
                                <div class="col-xs-12 col-sm-12 col-md-12 mg32">
                                    
                                    <label><strong>Descripción</strong></label>
                                        
                                    <div class="input-group">
                                
                                        <textarea type="text" class="form-control" name="nuevaDescripcion" placeholder="Escribir descripción..." rows="4"></textarea>

                                    </div>

                                </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg16">
                                        <button type="submit" class="btn btn-primary  pull-right">Guardar</button>
                                        
                                    </div>
                            </div>

                        </form> 

                                <?php


                                    $crearActa = new ControladorActa();
                                    $crearActa -> CtrcrearActa();                  
                                
                                ?>

                        </div>

                    </div>  

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