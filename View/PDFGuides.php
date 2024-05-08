<?php
// Include the FPDF library
require('../PDF/fpdf.php');
// Include the GuideC class
require_once('../Controller/GuideC.php');

// Create a new instance of the GuideC class
$guideC = new functions();

// Retrieve the table data from the database or any other source
$tableData = $guideC->listGuide();

// Create a new instance of FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Add content to the PDF using the table data
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Guide Table', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'ID', 1, 0, 'C');
$pdf->Cell(30, 10, 'Nom', 1, 0, 'C');
$pdf->Cell(30, 10, 'Prenom', 1, 0, 'C');
$pdf->Cell(20, 10, 'Age', 1, 0, 'C');
$pdf->Cell(30, 10, 'numTel', 1, 0, 'C');
$pdf->Cell(40, 10, 'Email', 1, 0, 'C');
$pdf->Cell(30, 10, 'nbvoyages', 1, 0, 'C');
$pdf->Cell(20, 10, 'ID_pays', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
foreach ($tableData as $row) {
    $pdf->Cell(20, 10, $row['ID_guide'], 1, 0);
    $pdf->Cell(30, 10, $row['Nom'], 1, 0);
    $pdf->Cell(30, 10, $row['Prenom'], 1, 0);
    $pdf->Cell(20, 10, $row['Age'], 1, 0);
    $pdf->Cell(30, 10, $row['numTel'], 1, 0);
    $pdf->Cell(40, 10, $row['Email'], 1, 0);
    $pdf->Cell(30, 10, $row['nbvoyages'], 1, 0);
    $pdf->Cell(20, 10, $row['ID_pays'], 1, 1);
}

// Generate the PDF in a variable
ob_start();
$pdf->Output();
$pdfContent = ob_get_clean();

// Set the appropriate headers for PDF download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="GuideTable.pdf"');

// Send the PDF content to the browser
echo $pdfContent;
?>