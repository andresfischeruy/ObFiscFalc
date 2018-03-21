<?php

require_once 'obtenerDatos.php';
require_once 'libs/funcionesPDF.php';
require_once 'libs/fpdf/fpdf.php';


$idPublicacion = strlen($_POST["id"]) ? $_POST["id"] : $_GET["id"];

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
configurarPDF($pdf, $idPublicacion);
$fotos = levantarImagenesParaPdf('./fotos/', $idPublicacion);
imprimirFotos($fotos, $pdf);
$pdf->Output('d', utf8_decode('Publicación_' . $idPublicacion) . '.pdf');