<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';
require_once('libs/fpdf/fpdf.php');

class PDF extends FPDF {

    function Header() {
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(60);
        $this->Cell(70, 10, utf8_decode('Ficha de la publicación'), 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Pag ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

function levantarImagenesParaPdf($directorio, $publi) {
    $fotos = array();

    if (is_dir($directorio)) {
        $d = dir($directorio);
        $idPublicacion = intval($publi, 10);
        while (false !== ($file = $d->read())) {
            $publiRecorrida = intval(obtenerIdPublicacionSegunFoto($file), 10);
            if ($file != "." && $file != ".." && $idPublicacion == $publiRecorrida) {
                $fotos[] = $directorio . $file;
            }
        }
        $d->close();
    }
    return $fotos;
}

function imprimirFotos($fotos, $pdf) {
    for ($i = 0; $i < count($fotos); $i++) {
        $pdf->Image($fotos[$i], 20, ($i + 3.2) * 50, 0, 30);
    }
}

function configurarPDF($pdf, $publicacion) {
    $datos = obtenerPublicacionPorID($publicacion);
    $titulo = ($datos["titulo"]);
    $tipo = $datos["tipo"] == 'E' ? "Encontrado" : "Perdido";
    $especie = devolverNombreEspecie($datos["especie_id"]) ['nombre'];
    $raza = devolverNombreRaza($datos["raza_id"]) ['nombre'];
    $descripcion = ($datos["descripcion"]);
    
    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(72, 153, 255);
    $pdf->SetTextColor(252, 252, 252);
    $pdf->Cell(50, 15, utf8_decode('Titulo de publicación'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(60, 15, utf8_decode($titulo), 1, 0, 'L', 0);
    $pdf->Ln(15);

    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(252, 252, 252);
    $pdf->Cell(50, 15, utf8_decode('Estado'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(60, 15, $tipo, 1, 0, 'L', 0);
    $pdf->Ln(15);

    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(252, 252, 252);
    $pdf->Cell(50, 15, utf8_decode('Especie'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(60, 15, utf8_decode($especie), 1, 0, 'L', 0);
    $pdf->Ln(15);

    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(252, 252, 252);
    $pdf->Cell(50, 15, utf8_decode('Raza'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(60, 15, utf8_decode($raza), 1, 0, 'L', 0);
    $pdf->Ln(20);

    $pdf->SetFont('Arial', 'I', 12);
    $pdf->MultiCell(0, 10, utf8_decode($descripcion), 0, 1);

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, utf8_decode('Fotografías'), 0, 1);
    $pdf->Ln(10);
}
