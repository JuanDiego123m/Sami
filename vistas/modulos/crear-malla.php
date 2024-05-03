<div class="content" style="background-color: #EBEBEB">
    <h4><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Malla de turno</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio"><i class="bx bx-home-smile nav__icon"></i> Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear Malla de turno</li>
        </ol>
    </nav> 
<div id="modalCrearMalla" class="modal fade" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">

            <div class="modal-dialog">


            
        </div>
        </div>


<!-- Modal (agregar, modificar, eliminar) -->
<div class="modal fade" id="crearmalla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloMalla"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input  type="hidden" name="txtid" id="txtid">
        <input type="hidden" name="txtFecha" id="txtFecha"><br>
        <div class="form-row">  
          <div class="form-group col-md-8">
            <label for="">Actividad</label>
              <input type="text" id="txtTitulo" class="form-control" placeholder="Actividad a realizar" required>
          </div>
            <input type="hidden" id="txtHora" value="10:30:00" class="form-control"/>
          </div>
          <div class="form-group col-md-4">
            <label for="selectHorario">Selecciona un horario:</label>
            <select required id="horario" class="form-control">
              <option value="hora_entrada">Hora de Entrada</option>
              <option value="hora_salida">Hora de Salida</option>
              <option value="almuerzo">Almuerzo</option>
              <option value="break_1">Break 1</option>
              <option value="break_2">Break 2</option>
            </select>
          </div>
          <div class="form-group col-md-5">
            <label for="">Hora:</label>
            <input type="time" id="hora" class="form-control" required>
          </div> 
                <!-- ENTRADA DEL EMPLEADO -->
                <?php
                    $item = null;
                    $valor = null;

                    $empleados = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);
                ?>

                    <div class="form-group">
                        <div class="form-group col-md-6">   
                            <label for="Empleado">Empleado</label>  
                            <select select class="form-control" id="nombres" name="editarPropietario" required>
                              <?php
                              $item = null;
                              $valor = null;
                              $empleados = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);
                              foreach ($empleados as $empleado): 
                                if ($empleado["estado"] == 1):
                                    $selected = ($empleado['idEmpleado'] == $idEmpleado) ? 'selected' : '';
                                      echo '<option value="' . $empleado['idEmpleado'] . '" ' . $selected . '>' . $empleado['nombre'] .'</option>';
                                  endif;
                              endforeach;
                              ?>
                            </select>
                        </div>
                    </div>
          <div class="form-group" >
          <label >Descripcion:</label>
          <textarea id="txtDescripcion" required rows="3" class="form-control"></textarea>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnAgregar" data-dismiss="modal">Añadir</button>
        <button type="button" class="btn btn-primary" id="btnModificar" data-dismiss="modal">Modificar</button>
        <button type="button" class="btn btn-primary" id="btnEliminar" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
    <div class="panel box-box">
        <div class="box-header with-border">
            <button class="btn btn-success" data-toggle="modal" data-target="#modalCargarItemsMalla">
                <i class='fa fa-upload'></i>
                Importar
            </button>  
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        selectable: true,
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        dateClick: function(info) {
                            $('#modalCrearMalla').modal('show');
                        },
                    });

                    calendar.render();
                });
            </script>
            <div id='calendar'></div>
        </div>
    </div>
</div>
      <script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      selectable: true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      dateClick: function(info) {
        $('#btnAgregar').prop("disabled", false);
        $('#btnModificar').prop("disabled", true);
        $('#btnEliminar').prop("disabled", true);
        limpiarform();
        $('#txtFecha').val(info.dateStr);
        $('#crearmalla').modal('show');
      },
      displayEventTime: false,

      events: 'vistas/modulos/malla2.php',
      eventClick: function(info) {

        $('#btnAgregar').prop("disabled", true);
        $('#btnModificar').prop("disabled", false);
        $('#btnEliminar').prop("disabled", false);
  var calEvent = info.event;
  eventoSeleccionado = calEvent; // Almacena el evento seleccionado globalmente
  // título
  $('#tituloMalla').html(calEvent.title);
  // Información de las mallas en inputs
  descripcionSeleccionada = calEvent.extendedProps.descripcionmalla; // Almacena la descripción seleccionada
  // Actualiza solo el campo de descripción en el formulario
  $('#txtDescripcion').val(descripcionSeleccionada);
  $('#txtid').val(calEvent.id);
  // Split de la fecha y hora
  var FechaHora = calEvent.start.toISOString().slice(0, 16).replace("T", " ");
  var FechaHoraSplit = FechaHora.split(" ");
  // Actualiza los campos del formulario con los valores del evento
  $('#txtTitulo').val(calEvent.title);
  $('#txtFecha').val(FechaHoraSplit[0]);
  $('#txtHora').val(FechaHoraSplit[1]);
  // Actualiza #horario y #nombres
  $('#horario').val(calEvent.extendedProps.horario);
  $('#nombres').val(calEvent.extendedProps.id_empleado);
  $('#hora').val(calEvent.extendedProps.hora);
  // Mostrar el modal
  $('#crearmalla').modal('show');
},


editable: true,
eventDrop: function(info) {
  var calEvent = info.event;

  // Almacena los valores originales antes de actualizar los campos
  var originalFechaHora = calEvent.start.toISOString().slice(0, 16).replace("T", " ");
  var originalFechaHoraSplit = originalFechaHora.split(" ");

  var originalTitulo = calEvent.title;
  var originalDescripcion = calEvent.extendedProps.descripcionmalla;

  $('#txtid').val(calEvent.id);
  $('#tituloMalla').html(originalTitulo);
  $('#txtDesciption').val(originalDescripcion);ñ

  // Actualiza los campos del formulario con los valores originales
  $('#txtFecha').val(originalFechaHoraSplit[0]);
  $('#txtHora').val(originalFechaHoraSplit[1]);
  $('#txtTitulo').val(originalTitulo);
  $('#hora').val(originalhora);
  RecolectarDatosGui();
  EnviarInformacion('modificar', NuevaMalla);
}

    });

    // Inicializa el calendario
    calendar.render();

    var NuevaMalla;
    $('#btnAgregar').click(function() {
      
      RecolectarDatosGui();
      EnviarInformacion('agregar', NuevaMalla);
      // Agregar el nuevo evento al calendario
      calendar.addEvent(NuevaMalla);
    });
    $('#btnEliminar').click(function() {
      RecolectarDatosGui();
      EnviarInformacion('eliminar', NuevaMalla);
    });
    $('#btnModificar').click(function() {
      RecolectarDatosGui();
      EnviarInformacion('modificar', NuevaMalla);
    });

    function RecolectarDatosGui() {
      NuevaMalla = {
        id: $('#txtid').val(),
        title: $('#txtTitulo').val(),
        hora: $('#hora').val(),
        start: $('#txtFecha').val() + " " + $('#txtHora').val(),
        descripcionmalla: $('#txtDescripcion').val(),
        end: $('#txtFecha').val() + " " + $('#txtHora').val(),
        horario: $('#horario').val(),
        nombres: $('#nombres').val()
      };
    }


    function EnviarInformacion(accion, objEvento, modal) {
      $.ajax({
        type: 'POST',
        url: 'vistas/modulos/malla2.php?accion=' + accion,
        data: objEvento,
        success: function(msg) {
          if (msg) {
            $('#CalendarioWeb').fullCalendar('refetchEvents');
              if(!modal){
                $("#crearmalla").modal('toggle');
            }
          }
        },
        error: function() {
          alert("Hay un error");
        }
      });
    }
    
  });
</script> 
<div id='calendar'></div>
</div>
</div>
</div>

<script>
    function limpiarform() {
    $('#txtid').val('');
    $('#txtTitulo').val('');
    $('#hora').val('');
    $('#txtDescripcion').val('');
    $('#txtFecha').val('');
    $('#txtHora').val('');
    $('#horario').val('');
    $('#nombres').val('');
  }
</script>

<!--=======================
MODAL CARGA MASIVA DE EMPLEADOS POR MEDIO DE UN EXCEL
=======================-->


<div id="modalCargarItemsMalla" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content" style="border-radius: 8px !important">
            
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=======================
                  CABEZA MODAL
                =======================-->

                <div class="modal-header" style="border-radius: 8px 8px 0px 0px !important">

                <h4 class="modal-title">Cargar Información</h4>

                </div>

                <!--=======================
                  CUERPO MODAL
                  =======================-->

                <div class="modal-body">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-sm-12 col-md-12">

                                <p>Carga items de forma masiva mediante un archivo de Excel</p>

                                <div class="alert alert-info" role="alert">
                                    <strong>Use la plantilla disponible para ajustar sus datos.</strong>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12">
                                 <!--PLANTILLA PARA DESCARGAR Y LLENAR CON LOS CAMPOS NECESARIOS PARA PODER GUARDAR-->
                                <a href="public/malla.xlsx" class="btn btn-default" download><i class='fa fa-cloud-download'></i> Plantilla</a>
                                <br>

                            </div>

                            <div class="col-sm-12 col-md-12 mg16">
                                
                                <input type="file" class="form-control" name="excelFile" required>

                            </div>                           

                        </div>

                    </div>

                </div>

                <!--=======================
                PIE MODAL
                =======================-->

                <div class="modal-footer">

                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>

                <button type="submit" class="btn btn-primary">Cargar</button>

                </div>

                <!--FUNCION DEL CONTROLADOR QUE PERMITE CARGAR MASIVAMENTE LOS EMPLEADOS-->
                <?php 

                   $cargaItems = new ControladorMalla();
                   $cargaItems -> ctrCargaMasivaItems();

                ?> 

            </form>

        </div>

    </div>

</div>


<style>
  html, body {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}
#calendar {
  max-width: 1000px;
  margin: 40px auto;
}

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

.btn-success  {
  border-radius: 20px; /* Ajusta este valor según el tamaño del botón que desees */
  background-color: white;
  color: green;
  border: 2px solid green;
}

.btn-success :hover {
  background-color: #8FF555;
  color: white;
}


</style>