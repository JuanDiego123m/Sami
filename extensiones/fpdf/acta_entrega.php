<?php

require('./fpdf.php');
// Crear la clase PDF que hereda de FPDF
class PDF extends FPDF
{
   // Cabecera de página
 function Header()
{
   // Agregar el logo de la empresa
   $logoEmpresa = 'logo.png';
   $this->Image($logoEmpresa, 165, 0, 40);


   $this->SetFont('Arial', 'B', 14);
   $this->Cell(0, 30, utf8_decode('Acta de entrega activos Tecnología'), 0, 1, 'C');


   $this->SetFont('Arial', 'B', 12);
   $this->Cell(40, 10, 'Fecha: '. date('d/m/Y'), 0, 0);
  

   $this->Ln(15); // Espacio en blanco después del logo
   }

   // Contenido del acta
   function Content()
   {
      $this->SetFont('Arial', '', 12);

      $empresaEntrega = 'Soluciones BPO';
      require_once "conect.php";
      
      $id = $_GET['id']; // Obtener el ID de la URL

      $consulta = "SELECT actas.*, empleados.nombre AS nombre 
                  FROM actas
                  INNER JOIN empleados ON actas.id_empleado = empleados.idEmpleado
                  WHERE actas.id = $id";
                  

      $resultado = $mysqli->query($consulta);

      while ($row = $resultado->fetch_assoc()) {
         $empleado = $row['nombre']; // Asignar el nombre del empleado obtenido de la base de datos
         // Resto del código del bucle
      }

      

      $this->SetFont('Arial', '', 12);
      $this->Cell(0, 6, utf8_decode("La empresa $empresaEntrega hace entrega de Computador a $empleado el cual"), 0, 1);
      $this->Cell(0, 6, utf8_decode("debe ser usado exclusivamente como herramienta de trabajo, esta será responsabilidad del empleado"), 0, 1);
      $this->Cell(0, 6, utf8_decode("mientras se encuentre en la compañía y cualquier daño ó imperfecto no especificado en el apartado"), 0, 1);
      $this->Cell(0, 6, utf8_decode('"' . trim('Condiciones funcionales del activo') . '"'." y que no sea deterioro natural por uso de está será cobrado"), 0, 1);     
      $this->Cell(0, 6, utf8_decode(trim("al empleado.")), 0, 1);


      $this->Ln(5);
      $this->SetFont('Arial', 'B', 12);
      $this->Ln(5);

  
      // Datos anexados en forma de tabla
      $this->SetFont('Arial', 'B', 12);

      $this->Cell(60,10,"Empleado" , 0, 0, 'C', 0);
      $this->Cell(55,10,"               Activo" , 0, 0, 'C', 0);
      $this->Cell(75,10,utf8_decode("Descripción") , 0, 1, 'C', 0);
      

      $this->SetFont('Arial', '', 12, '', true, 'UTF-8');

      require_once "conect.php";
      $id = $_GET['id']; // Obtener el ID de la URL
      
      $consulta = "SELECT actas.*, empleados.nombre AS nombre 
      FROM actas
      INNER JOIN empleados ON actas.id_empleado = empleados.idEmpleado
      WHERE actas.id = $id";

      $resultado = $mysqli->query($consulta);
      while ($row = $resultado->fetch_assoc()) {
         $this->Cell(70, 10, utf8_decode($row['nombre']), 0, 0, 'C', 0);
         $id_inventario = $row['id_inventario'];
         $id_inventario = json_decode($id_inventario, true); 

         // Guardar la posición Y antes de entrar al bucle foreach
         $posicionYInicial = $this->GetY();

         foreach ($id_inventario as $item) {
            $activo = $item['activo'];
            $serial = $item['serial'];
            $inventarioTexto = $activo . ' / ' . $serial;
            $this->MultiCell(55, 10, $inventarioTexto, 0, 'C', false);
            $this->SetX($this->GetX() + 70); // Establecer la posición X para la siguiente celda
         }

         // Restaurar la posición Y después del bucle foreach
         $this->SetXY($this->GetX() + 63, $posicionYInicial);

         $this->Cell(40, 10, utf8_decode($row['descripcion']), 0, 1, 'C', 0);
      }


     
     
     
      

      $this->Ln(18);

         
      $this->SetFont('Arial', 'B', 12);
      $this->Cell(0, 10, utf8_decode('Condiciones funcionales del activo:'), 0, 1);
      $this->Ln(5);
      
      $this->SetFont('Arial', 'B', 12);
      $this->Cell(63, 10, utf8_decode('Descripción'), 1);
      $this->Cell(63, 10, 'Estado', 1);
      $this->Cell(63, 10, 'Observaciones', 1);
      $this->Ln();
      // Datos anexados en forma de tabla
      $this->SetFont('Arial', '', 12);

      $datos = array(
         // array(utf8_decode('Descripción'), 'Estado', 'Observaciones'),
         array('Nueva / Usada', 'Usado', 'Usado'),
         array('Teclado', utf8_decode('Sin daños físicos'), ''),
         array('Touch Pad', utf8_decode('Sin daños físicos'), ''),
         array('Cargador', utf8_decode('Sin daños físicos'), ''),
         array(utf8_decode('Condiciones Físicas'), utf8_decode('En buenas condiciones físicas'), '')
      );

      $cellWidth = 63; // Ancho de cada celda
      $cellHeight = 10; // Alto de cada celda

      foreach ($datos as $row) {

         foreach ($row as $col) {

            $this->Cell($cellWidth, $cellHeight, $col, 1);
         }

         $this->Ln();
      }

      $this->Ln(47);


      // Obtener la posición actual de la celda
      $yPos = $this->GetY();



      $this->SetFont('Arial', '', 12);
      foreach ($resultado as $item) {
         $imagenmesa = $item['firma_mesa'];
         $this->Image($imagenmesa, 20, 228, 50);
      }
      
       // Firmas de responsables e involucrados
       $responsableEntrega = array(
         'Nombre' => 'Mesa de Servicios Soluciones BPO	',
         'Cedula' => '',
         'Empresa' => ''
      );
      foreach ($resultado as $item) {
         $imagen = $item['firma_empleado'];
         $this->Image($imagen, 145, 228, 50);
      }

      $responsableReceptor = array(
         'Nombre' => utf8_decode('Firma y Cédula del Empleado'),
         'Cedula' => '',
         'Empresa' => ' '
      );

  

      // Firmante 1 (Responsable de entrega)
      $this->Cell(40, 10, $responsableEntrega['Nombre'], 0, 0);
      $this->Cell(0, 10, $responsableEntrega['Empresa'], 0, 0);

      // Dibujar línea para firma del firmante 1
      $this->SetLineWidth(0.5);
      $this->Line(11, $yPos - 2, 76, $yPos - 2); // Ajusta los valores según sea necesario



      // Firmante 2 (Responsable receptor)
      $this->SetX($this->GetPageWidth() - 50); // Ajusta el valor según sea necesario
      $this->Cell(40, 10, $responsableReceptor['Nombre'], 0, 0, 'R');
      $this->Cell(0, 10, $responsableReceptor['Empresa'], 0, 1, 'R');

      // Dibujar línea para firma del firmante 2
      $this->SetLineWidth(0.5);
      $lineXStart = $this->GetPageWidth() - 67; // Ajusta los valores según sea necesario
      $lineXEnd = $this->GetPageWidth() - 12; // Ajusta los valores según sea necesario
      $this->Line($lineXStart, $yPos - 2, $lineXEnd, $yPos - 2);

      // Restaurar el valor de la línea por defecto
      $this->SetLineWidth(0.2);
   }

   function Footer()
   {  
      $medellin = '+ 57 (4) 5 600 400'; // Número de teléfono de Medellín
      $whatsapp = '+57 310 500 7418';
      $correo = 'ventas@solucionesbpo.com'; // Dirección de correo electrónico
      $direccion = 'Cr. 52 #29a111, Centro Mercantil, Bodega 316. Medellín-Colombia';
      $this->SetTextColor(11, 82, 143);
      $this->SetY(-25); // Posiciona el pie de página a 25 mm del borde inferior
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(0, 8, utf8_decode('Correo electrónico: ' . $correo), 0, 1, 'C');
      $this->Cell(0, 8, utf8_decode('Teléfonos:      '.'Medellín: ' . $medellin.'    WhatsApp: ' . $whatsapp), 0, 1, 'C');
      $this->Cell(0, 8, utf8_decode('Dirección: ' . $direccion), 0, 1, 'C');
   }
   
}


   $pdf = new PDF();
   $pdf->AliasNbPages();
   $pdf->AddPage();
   $pdf->Content();
   $pdf->Output('Acta_Entrega.pdf', 'I');