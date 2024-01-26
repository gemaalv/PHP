<?php
include("conexion.php");
require('tcpdf/tcpdf.php');
require();

function generatePDF($data) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(0, 10, 'Datos de Personas', 0, 1, 'C');
    $pdf->Ln();

    foreach ($data as $row) {
        $pdf->Cell(50, 10, 'Nombre: ' . $row['nombre'], 0, 1);
        $pdf->Cell(50, 10, 'Fecha de Nacimiento: ' . $row['fecha_nacimiento'], 0, 1);
        $pdf->Cell(50, 10, 'Sexo: ' . $row['sexo'], 0, 1);
        $pdf->Ln();
    }

    $pdf->Output('datos_personas.pdf', 'D');
}

function generateExcel($data) {
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Nombre');
    $sheet->setCellValue('B1', 'Fecha de Nacimiento');
    $sheet->setCellValue('C1', 'Sexo');

    $rowNumber = 2;
    foreach ($data as $row) {
        $sheet->setCellValue('A' . $rowNumber, $row['nombre']);
        $sheet->setCellValue('B' . $rowNumber, $row['fecha_nacimiento']);
        $sheet->setCellValue('C' . $rowNumber, $row['sexo']);
        $rowNumber++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('datos_personas.xlsx');
}

$sql = "SELECT * FROM personas";
$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

if (isset($_POST['descargar'])) {
    generatePDF($data);
    generateExcel($data);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generar PDF y Excel</title>
</head>
<body>
    <form method="post" action="">
        <input type="submit" name="descargar" value="Descargar">
    </form>
</body>
</html>
