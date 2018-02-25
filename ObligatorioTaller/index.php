<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';

$tipoPubli = 'E';
$especie = "Perros";

if (isset($_GET['tipo'])) {
    $tipoPubli = $_GET['tipo'];
}

if (isset($_GET['especie'])) {
    $tipoPubli = $_GET['especie'];
}


$miSmarty = getSmarty();


//Carga de SideBar
$miSmarty->assign("especies", obtenerEspecies());
$miSmarty->assign("razas", obtenerRazas());
$miSmarty->assign("barrios", obtenerBarrios());


//Carga de Publicaciones
$miSmarty->assign("publicaciones", obtenerPublicacionPorTipo($tipoPubli));




$miSmarty->display('index.tpl');

