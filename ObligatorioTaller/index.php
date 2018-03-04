<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';



if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}

if (isset($_GET['especie'])) {
    $especie = $_GET['especie'];
}

if (isset($_GET['raza'])) {
    $raza = $_GET['raza'];
}

if (isset($_GET['barrio'])) {
    $barrio = $_GET['barrio'];
}

$miSmarty = getSmarty();



$miSmarty->assign("tipo", $tipo);
$miSmarty->assign("raza", $raza);
$miSmarty->assign("especie", $especie);
$miSmarty->assign("barrio", $barrio);


//Carga de SideBar
$miSmarty->assign("especies", obtenerEspecies());
$miSmarty->assign("razas", obtenerRazas($especie));
$miSmarty->assign("barrios", obtenerBarrios());


//Carga de Publicaciones
$publicaciones = obtenerPublicacionPorTipo($tipo, $especie, $raza, $barrio);
$miSmarty->assign("publicaciones", $publicaciones);
$miSmarty->assign('fotos', levantarImagenes("./fotos/",4));

    
$miSmarty->display('header.tpl');
$miSmarty->display('index.tpl');
$miSmarty->display('footer.tpl');


