<?php

$item = null;
$valor = null;


$operaciones = ControladorOperaciones::ctrMostrarOperacion($item, $valor);
$totalNumeraciones = 0; 

foreach ($operaciones as $operacion) {

    if ($operacion['estado'] == 1) {

        $totalNumeraciones++;
    }
}

?>

<!-- ./col -->
<div class="col-lg-3 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-blue">
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




