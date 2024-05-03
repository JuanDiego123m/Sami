<div class="content" style="background-color: #EBEBEB">
    <h4><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Malla del turno</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio"><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Malla de turno</li>
        </ol>
    </nav> 

    <div class="panel box-box">
        <div class="box-header with-border">
         <!-- BOTON QUE REDIRIGE A LA VISTA DE CREAR ACTA  -->
          <button type="button" class="btn btn-primary" id="crearTurnoBtn" onClick="location.href='crear-malla'">
         Crear Malla
          </button>

        </div> 

        <div class="box-body">


          <!-- ACÁ EMPIEZA LA TABLA DONDE ESTÁ TODA LA INFORMACIÓN  -->
          <table class="table table-bordered table-striped dt-responsive tablas" >

              <thead>
                
                <tr>
                  
                  <th style="width: 10px">#</th>
                  <th>Empleado</th>
                  <th>Ver malla</th>

                </tr> 

              </thead>   

            </tbody>
            
          </table>

        </div>

    </div>

</div>

<style>
 

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