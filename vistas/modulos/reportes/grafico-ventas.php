<?php

error_reporting(0);
	
if (isset($_GET["fechaInicial"])){



  $fechaInicial = $_GET["fechaInicial"];
  $fechaFinal = $_GET["fechaFinal"];

}else{

  $fechaInicial = null;
  $fechaFinal = null;

}


$respuesta = ControladorVentas::ctrRangosFechasVentas($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayVentas = array();

foreach ($respuesta as $key => $value) {

	// ** año, mes y día
	$fecha = substr($value["fecha"],0,7);

	// ** Introducir fechas en el arrayFechas
	array_push($arrayFechas, $fecha);

	// capturamos las ventas
	$arrayVentas = array($fecha => (count($respuesta)-4));

	

	// *¨Sumamos las ventas de un mismo mes
	foreach ($arrayVentas as $key => $value) {
		
		$sumaVentasMes[$key] += $value;



	}


}

// var_dump($arrayVentas);
$noRepetirFechas = array_unique($arrayFechas);


?>

<!-- ************ GRAFICO DE VENTAS ******************** -->

<div class="box box-solid bg-teal-gradient">
	
	<div class="box-header">
		
		<i class="fa fa-th"></i>

		<h3 class="box-title">Tickets por mes</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoVentas">
		
		<div class="chart" id="line-chart-ventas" style="height: 250px;"></div>

	</div>

</div>

<script>
	
 var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$key."', ventas: ".$sumaVentasMes[$key]." },";


	    }

	    echo "{y: '".$key."', ventas: ".$sumaVentasMes[$key]." }";

    }else{

       echo "{ y: '0', ventas: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });

</script>