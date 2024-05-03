<?php
require('./fpdf.php');

// Crear la clase PDF que hereda de FPDF
class PDF extends FPDF
{
    function __construct($orientation='P', $unit='mm', $size='A4')
    {
        parent::__construct($orientation, $unit, $size);
    }

    // Cabecera de página
    function Header()
    {
    // Establecer el margen derecho
    $rightMargin = 8;
    $logoWidth = 45; // Ancho de la imagen del logo

    // Establecer las coordenadas x para la imagen del logo
    $logoX = $this->GetPageWidth() - $logoWidth - $rightMargin;

    // Agregar el logo de la empresa
    $logoEmpresa = 'logo.png';
    $this->Image($logoEmpresa, $logoX, 0, $logoWidth);

        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 30, utf8_decode('Reporte de activos Tecnología en Stock'), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(40, 10, 'Fecha: ' . date('d/m/Y'), 0, 0);

        $this->Ln(15); // Espacio en blanco después del logo
    }

    // Contenido del Reporte
    function Content()
    {
        $this->SetFont('Arial', '', 12);

        $empresa = 'Soluciones BPO';
        require_once "conect.php";

        // Consulta para obtener los activos en stock 
        $consulta = "SELECT 
            inventario.tipoActivo, 
            inventario.serial, 
            inventario.estado, 
            empleados.nombre AS propietario, 
            inventario.notas, 
            inventario.ultima_modificacion 
        FROM 
            inventario
        LEFT JOIN 
            empleados ON inventario.id_empleado = empleados.idEmpleado
        WHERE 
            inventario.estado = 'En Stock' OR inventario.estado = 'Stock'";

        $resultado = $mysqli->query($consulta);

        $this->SetFont('Arial', '', 13.5);
        $this->Cell(0, 6, utf8_decode("Se muestran a continuación los activos que se encuentran en Stock de la empresa $empresa, se muestra el Tipo de Activo,"), 0, 1);
        $this->Cell(0, 6, utf8_decode("su Serial, su Estado, el Asignado, las Notas y la Ultima Modificación de estos."), 0, 1);

        $this->Ln(10);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, utf8_decode("Activos en Stock:"));

        $this->Ln(10);

        // Cabecera de la tabla 
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(45, 10, 'Tipo Activo', 1);
        $this->Cell(55, 10, 'Serial', 1);
        $this->Cell(25, 10, 'Estado', 1);
        $this->Cell(65, 10, 'Asignado', 1);
        $this->Cell(45, 10, 'Notas', 1);
        $this->Cell(45, 10, 'Ultima Modificacion', 1);
        $this->Ln();

        // Contenido de la tabla
        $this->SetFont('Arial', '', 12);
        while ($row = $resultado->fetch_assoc()) {
            $this->Cell(45, 10, $row['tipoActivo'], 1);
            $this->Cell(55, 10, $row['serial'], 1);
            $this->Cell(25, 10, $row['estado'], 1);
            $this->Cell(65, 10, utf8_decode($row['propietario']), 1);
            $this->Cell(45, 10, $row['notas'], 1);
            $this->Cell(45, 10, $row['ultima_modificacion'], 1);
            $this->Ln();
        }

        $this->Ln(15);
    }


    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('H:i:s');
        $this->Cell(525, 10, utf8_decode($hoy), 0, 0, 'C');
        
    }
}

$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content();
$pdf->Output('Inventario_Stock.pdf', 'I');