<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<?php

include "controlador/crm-controlador.php";

$db = mysqli_select_db( $conexion, $basededatos ) or die ("no se ha podido conectar a la base de datos");


$idCrm = $_GET["id"];

//****** CONSULTAMOS EL CLIENTE A PARTIR DEL ID DE CRM **********************************************
$consultaCliente = "SELECT * FROM clientes WHERE id_crm = $idCrm";
$resultCliente = mysqli_query($conexion,$consultaCliente);

if(!$resultCliente){

	echo "Error en la consulta del cliente";

}else{

	foreach ($resultCliente as $keyCliente => $valueCliente){

		$idCliente = $valueCliente["id"];

	}

}



// ***************  CONSULTAMOS LOS TICKETS ASOCIADOS AL CLIENTE ***********************************++


$consulta = "SELECT * FROM ventas WHERE id_cliente = $idCliente";

$result = mysqli_query($conexion,$consulta);

?>
<div class="box-body" style="font-family: sans-serif; font-size: 20px; width: 100%; margin: 45px">

	<h5>Tickets del cliente</h5>

	<table class="table" style="width: 100%; text-align: left; border-collapse: separate;" cellspacing="2" cellpadding="10">

		<thead>
	         
		      <tr>
		       
		       <th style="border-bottom: 1px solid #fff; color: #666666">#</th>
		       <th style="border-bottom: 1px solid #fff; color: #666666;">ticket</th>
		       <th style="border-bottom: 1px solid #fff; color: #666666;">Categoría</th>
		       <th style="border-bottom: 1px solid #fff; color: #666666;">Tipo</th>
		       <th style="border-bottom: 1px solid #fff; color: #666666;">Estado</th>
		       <th style="border-bottom: 1px solid #fff; color: #666666;">Fecha vencimiento</th>
		       <th style="border-bottom: 1px solid #fff; color: #666666;">Fecha cierre</th>
		       
		      </tr> 

	     </thead>

	     <tbody>

	    <?php 

	    if(!$result){
	    	echo "Error en la consulta";
	    }else{

	    	//*********************** GENERA ARRAY CON LOS DATOS DE LA TABLA ***********************************

			// while ($fila = $result->fetch_assoc()) {

			// 	$array[] = $fila;

			// }

			// echo '<pre>';
			// print_r($array);
			// echo '</pre>';

			 foreach ($result as $key => $value){

			 	//****** CONSULTAMOS LA CATEGORIA *************************
			 	$idCategoria = $value["id_categoria"];
			 	$consultaCat = "SELECT * FROM productos WHERE id = $idCategoria";
				$resultCat = mysqli_query($conexion,$consultaCat);

				if(!$resultCat){
			    	echo "Error en la consulta de categoria";
			    }else{

			    	foreach ($resultCat as $keyCat => $valueCat){
			    		$categoria = $valueCat["descripcion"];
			    	}


			    }


			    //****** CONSULTAMOS EL TIPO *************************
			 	$idTipo = $value["id_tipo"];
			 	$consultaTipo = "SELECT * FROM tipos WHERE id = $idTipo";
				$resultTipo = mysqli_query($conexion,$consultaTipo);

				if(!$resultTipo){
			    	echo "Error en la consulta de tipo";
			    }else{

			    	foreach ($resultTipo as $keyTipo => $valueTipo){
			    		$tipo = $valueTipo["tipo"];
			    	}


			    }

			 	echo '

			 	<tr>
			 		<td style="padding 8px; border-top: 1px solid transparent;">'.($key+1).'</td>
			 		<td style="padding 8px; border-top: 1px solid transparent;">'.$value["codigo"].'</td>
			 		<td style="padding 8px; border-top: 1px solid transparent;">'.$categoria.'</td>
			 		<td style="padding 8px; border-top: 1px solid transparent;">'.$tipo.'</td>
			 		<td style="padding 8px; border-top: 1px solid transparent;">'.$value["estado"].'</td>
			 		<td style="padding 8px; border-top: 1px solid transparent;">'.$value["fecha_vencimiento"].'</td>
			 		<td style="padding 8px; border-top: 1px solid transparent;">'.$value["fecha_cierre"].'</td>
			 	</tr>

			 	';

			 }
		

	    }

	    ?>

		</tbody>

	</table>

</div>
