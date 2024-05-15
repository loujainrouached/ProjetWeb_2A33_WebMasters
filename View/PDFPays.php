<?php
// Include the FPDF library
require('../PDF/fpdf.php');
// Include the GuideC class
require_once('../Controller/PaysC.php');

// Create a new instance of the GuideC class
$paysC = new functions();

// Retrieve the table data from the database or any other source
$tableData = $paysC->listPays();

// Create a new instance of FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Add content to the PDF using the table data
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Pays Table', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'ID_pays', 1, 0, 'C');
$pdf->Cell(30, 10, 'NomP', 1, 0, 'C');
$pdf->Cell(30, 10, 'Capital', 1, 0, 'C');
$pdf->Cell(20, 10, 'monuments', 1, 1, 'C'); // Added line break
$pdf->SetFont('Arial', '', 12);
foreach ($tableData as $row) {
    $pdf->Cell(20, 10, $row['ID_pays'], 1, 0);
    $pdf->Cell(30, 10, $row['NomP'], 1, 0);
    $pdf->Cell(30, 10, $row['Capital'], 1, 0);
    $pdf->Cell(20, 10, $row['monuments'], 1, 1); // Added line break
}

// Generate the PDF in a variable
ob_start();
$pdf->Output();
$pdfContent = ob_get_clean();

// Set the appropriate headers for PDF download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="PaysTable.pdf"');

// Send the PDF content to the browser
echo $pdfContent;
?>