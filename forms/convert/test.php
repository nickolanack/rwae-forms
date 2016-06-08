<?php

include 'vendor/autoload.php';

// initiate
$pdf = new Gufy\PdfToHtml\Pdf(__DIR__ . '/PIF_Adam.pdf');
$html = $pdf->html();

$total_pages = $pdf->getPages();
echo $total_pages;

print_r($html);
