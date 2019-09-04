<?php

use Spipu\Html2Pdf\Html2Pdf;

require '../../vendor/autoload.php';

$html2pdf = new Html2Pdf();

// Recoger la vista A Imprimir
ob_start();
require_once 'html.php';
$html = ob_get_clean();

$html2pdf->writeHTML($html);
$html2pdf->output("Stock.pdf");
