<?php

require_once 'obtenerDatos.php';
require_once 'funcionesPDF.php';
require_once 'libs/Smarty.class.php';
require_once 'libs/fpdf/fpdf.php';


$idPublicacion = strlen($_POST["id"]) ? $_POST["id"] : $_GET["id"];

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
configurarPDF($pdf, $idPublicacion);
$fotos = levantarImagenesParaPdf('./fotos/', $idPublicacion);
imprimirFotos($fotos, $pdf);
$pdf->Output('d', utf8_decode('Publicación_' . $idPublicacion) . '.pdf');
?>