<?php

require_once 'config/configuracion.php';
require_once 'obtenerDatos.php';

$pagina = 0;
$tamano = 10;

if (isset($_GET['tipo'])) {
    $tipoP = $_GET['tipo'];
}

if (isset($_GET['especie'])) {
    $especieP = $_GET['especie'];
}

if (isset($_GET['raza'])) {
    $razaP = $_GET['raza'];
}

if (isset($_GET['barrio'])) {
    $barrioP = $_GET['barrio'];
}

if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

if (isset($_GET["buscador"])) {
    $buscador = $_GET["buscador"];
}



$info = obtenerPublicacionesPaginadasConCombos($pagina, $tamano, $tipoP, $especieP, $razaP, $barrioP,$buscador);
$publicacionesConFoto = obtenerFotos($info["publicaciones"]);
$smarty = getSmarty();

$smarty->assign("mostrarAnterior", $pagina > 0);
$smarty->assign("mostrarSiguiente", $pagina < ($info["total"] / $tamano)-1);
$smarty->assign("publicaciones", $publicacionesConFoto);
$smarty->display("paginaPublicaciones.tpl");

