<?php 

$item = null;
$valor = null;

$DID = ControladorDID::ctrMostrarDID($item, $valor);
$totalDID = count($DID);

$empleados = ControladorEmpleados::CtrMostrarEmpleados($item, $valor);

$totalEmpleados = 0; 

foreach ($empleados as $empleado) {
    if ($empleado['idEmpleado'] != 0) {
        $totalEmpleados++; 
    }
}

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$operaciones = ControladorOperaciones::ctrMostrarOperacion($item, $valor);
$totalNumeraciones = count($operaciones);

$inventario = ControladorInventario::ctrMostrarItems($item, $valor);
$totalInventario = count($inventario);

$acta = ControladorActa::ctrMostrarActa($item, $valor);
$totalActa = count($acta);
?>


<div class="row">
  <div class="col-lg-12">
    <!-- Caja grande -->
    <div class="small-box bg-white">
      <div class="inner">
        <h4 style="color: black;">Hola <?php echo $_SESSION["nombre"]; ?> bienvenid@ de nuevo 👋👋</h4>
      </div>
      <div class="icon">
        <ion-icon name="large-icon"></ion-icon>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo number_format($totalEmpleados); ?></h3>
        <p>Empleados  </p>
      </div>
      <div class="icon">
        <ion-icon name="people-outline"></ion-icon>
      </div>
      <a href="empleados" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-blue">
      <div class="inner">
        <h3><?php echo number_format($totalInventario); ?></h3>

        <p>Inventario</p>
      </div>
      <div class="icon">
        <ion-icon name="layers-outline" ></ion-icon>
      </div>
      <a href="inventario" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- DID -->

  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">

       <h3><?php echo number_format($totalDID); ?></h3>

        <p>DID</p>
      </div>
      <div class="icon">
       <ion-icon name="call-outline"></ion-icon>
      </div>
      <a href="DID" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <!-- ./col -->
  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo number_format($totalNumeraciones); ?></h3>

        <p>Operaciones</p>
      </div>
      <div class="icon">
        <ion-icon name="construct-outline"></ion-icon>
      </div>
      <a href="operaciones" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <!-- ./col -->
  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo number_format($totalClientes); ?></h3>

        <p>Clientes</p>
      </div>
      <div class="icon">
        <ion-icon name="person-add-outline"></ion-icon>
      </div>
      <a href="clientes" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <!-- ./col -->
  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-purple">
      <div class="inner">
        <h3><?php echo number_format($totalActa); ?></h3>

        <p>Actas</p>
      </div>
      <div class="icon">
        <ion-icon name="documents-outline"></ion-icon>
      </div>
      <a href="acta" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>



<div class="small-box bg-white">
    <div class="chart-container">
        <br>
        <h4 style="color: black;"> &nbsp;&nbsp;&nbsp;Gráfico con la cantidad de activos en stock📊🖥️
        <button type="button" class="btn btn-success pull-right">Exportar Reporte <i class="fa fa-cloud-download" aria-hidden="true"></i></button></h4>
        <br>
        <canvas id="inventarioChart"></canvas>
    </div>
  </div>

<script>
    // Obtén los datos del inventario
    var inventarioData = <?php echo json_encode($inventario); ?>;
    
    // Crea un objeto para almacenar el conteo de activos por tipo
    var conteoActivos = {};
    
    // Recorre los datos del inventario y cuenta la cantidad de activos por tipo que estén en estado "stock"
    inventarioData.forEach(function(item) {
        var tipoActivo = item.tipoActivo;
        var estado = item.estado;
        
        // Verifica si el estado del activo es "stock"
        if (estado === "En stock") {
            if (conteoActivos[tipoActivo]) {
                conteoActivos[tipoActivo]++;
            } else {
                conteoActivos[tipoActivo] = 1;
            }
        }
    });
    
    // Crea dos arrays para almacenar las etiquetas y los valores del gráfico
    var labels = Object.keys(conteoActivos);
    var data = Object.values(conteoActivos);
    
    // Obtén el canvas del gráfico por su ID
    var inventarioCanvas = document.getElementById("inventarioChart").getContext("2d");
    
    // Crea el gráfico utilizando Chart.js
    var inventarioChart = new Chart(inventarioCanvas, {
        type: "bar", // Tipo de gráfico (puedes cambiarlo a "line", "pie", etc.)
        data: {
            labels: labels, // Etiquetas del gráfico
            datasets: [{
                data: data, // Valores del gráfico
                backgroundColor: [
                    "rgba(75, 100, 192, 0.5)",
                    "rgba(255, 99, 132, 0.5)",
                    "rgba(55, 255, 0, 0.5)",
                    "rgba(255, 205, 86, 0.5)",
                    "rgba(153, 102, 255, 0.5)",
                    // Agrega más colores si tienes más tipos de activos
                ], // Colores de fondo del gráfico
                borderColor: [
                    "rgba(75, 192, 192, 1)",
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 205, 86, 1)",
                    "rgba(153, 102, 255, 1)",
                    
                ], // Colores del borde del gráfico
                borderWidth: 0 // Ancho del borde del gráfico
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0, // Mostrar números enteros sin decimales
                        maxTicksLimit: 5, // Limitar el número de líneas de números en el eje Y
                        padding: 10 // Espaciado entre los números en el eje Y
                    },
                    grid: {
                        drawBorder: false // Ocultar las líneas del grid en el eje Y
                    }
                },
                x: {
                    barPercentage: 0.7, // Ajustar el ancho de las barras (valor entre 0 y 1)
                    categoryPercentage: 0.8 // Ajustar el espaciado entre las barras (valor entre 0 y 1)
                }
            },
            plugins: {
                legend: {
                    display: false // Ocultar la leyenda del gráfico
                }
            },
            onClick: function(event, elements) {
                if (elements.length > 0) {
                    var index = elements[0].index;
                    var tipoActivo = labels[index];

                    // Redirecciona a la página de inventario pasando el tipo de activo como parámetro
                    var urlParams = new URLSearchParams(window.location.search);
                    var currentTipoActivo = urlParams.get('tipoActivo');
                    var newUrl = "/solucionesbpo/inventario?tipoActivo=" + tipoActivo;

                    // Verifica si ya hay un tipoActivo en la URL actual y reemplázalo con el nuevo tipoActivo
                    if (currentTipoActivo) {
                        newUrl = window.location.href.replace("tipoActivo=" + currentTipoActivo, "tipoActivo=" + tipoActivo);
                    }

                    window.location.href = newUrl;
                }
            }

        }
    });

    // Obtén el botón de exportar por su clase
var exportButton = document.querySelector(".btn-success");

// Agrega un evento de clic al botón de exportar
exportButton.addEventListener("click", function() {
    // Crea un nuevo libro de Excel
    var workbook = XLSX.utils.book_new();

    // Crea una hoja de cálculo
    var worksheet = XLSX.utils.aoa_to_sheet([labels, data]);

    // Agrega la hoja de cálculo al libro
    XLSX.utils.book_append_sheet(workbook, worksheet, "Reporte");

    // Convierte el libro de Excel a un archivo binario
    var excelData = XLSX.write(workbook, { type: "binary" });

    // Crea un objeto Blob con el archivo binario
    var blob = new Blob([s2ab(excelData)], { type: "application/octet-stream" });

    // Crea un enlace para descargar el archivo
    var downloadLink = document.createElement("a");
    downloadLink.href = URL.createObjectURL(blob);
    downloadLink.download = "reporte.xlsx";

    // Simula un clic en el enlace para iniciar la descarga
    downloadLink.click();
});

// Función para convertir una cadena a una matriz de bytes
function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i < s.length; i++) {
        view[i] = s.charCodeAt(i) & 0xFF;
    }
    return buf;
}

</script>





<style> 

ion-icon {
  font-size: 64px;
}

.chart-container {
    height: 450px; /* Altura deseada del contenedor */
    width: 50%; /* Ancho deseado del contenedor */
}


</style>
