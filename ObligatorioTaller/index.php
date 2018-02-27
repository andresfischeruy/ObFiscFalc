<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';

$tipo = 'E';
$especie = 1;





if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}

if (isset($_GET['especie'])) {
    $especie = $_GET['especie'];
}



$miSmarty = getSmarty();


//Carga de SideBar
 $miSmarty->assign("tipo", $tipo);
$miSmarty->assign("especies", obtenerEspecies());
$miSmarty->assign("razas", obtenerRazas($especie));
$miSmarty->assign("barrios", obtenerBarrios());


//Carga de Publicaciones
$miSmarty->assign("publicaciones", obtenerPublicacionPorTipo($tipo, $especie));




$miSmarty->display('index.tpl');

