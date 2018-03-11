<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';

require_once('libs/fpdf/fpdf.php');



$publicacion = strlen($_POST["id"]) ? $_POST["id"] : $_GET["id"];


class PDF extends FPDF {

// Cabecera de página
    function Header() {
// Arial bold 15
        $this->SetFont('Arial', 'B', 15);
// Movernos a la derecha
        $this->Cell(80);
// Título
        $this->Cell(60, 10, utf8_decode('Ficha de publicacion'), 1, 0, 'C');
// Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer() {
// Posición: a 1,5 cm del final
        $this->SetY(-15);
// Arial italic 8
        $this->SetFont('Arial', 'I', 8);
// Número de página
        $this->Cell(0, 10, 'Pag ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

// Carga de datos desde la base
  $conn = getConexion();

$sql = "select * from publicaciones where id = :publicacion";
$param = array(array("publicacion", $publicacion, "int"));
$conn->consulta($sql, $param);

$res = $conn->siguienteRegistro();

$conn->desconectar();

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);



$tipo = $res["tipo"] == 'E' ? "Encontrado" : "Perdido";
$especie = devolverNombreEspecie($res["especie_id"]) ['nombre'];
$raza = devolverNombreRaza($res["raza_id"]) ['nombre'];

$descripcion = ($res["descripcion"]);

$pdf->Cell(0, 10, utf8_decode('Titulo de publicacion: ' . $res["titulo"]), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Estado: ' . $tipo), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Especie: ' . $especie), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Raza: ' . $raza), 0, 1);
$pdf->MultiCell(0, 10, utf8_decode('Descripcion: ' . $descripcion), 0, 1);



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
        $pdf->Image($fotos[$i],20, ($i + 3) * 40,0,30);
    }
}

$fotos = levantarImagenesParaPdf('./fotos/', $publicacion);
imprimirFotos($fotos, $pdf);
$pdf->Output('d', 'publicacion_' . $publicacion . '.pdf');
?>