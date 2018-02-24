<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';

$tipoPubli = 'E';

if (isset($_GET['tipo'])) {
    $tipoPubli = $_GET['tipo'];
}


$miSmarty = getSmarty();


//Carga de SideBar
$miSmarty->assign("especies", obtenerEspecies());
$miSmarty->assign("razas", obtenerRazas());
$miSmarty->assign("barrios", obtenerBarrios());


//Carga de Publicaciones
$miSmarty->assign("publicaciones", obtenerPublicacionPorTipo($tipoPubli));




$miSmarty->display('index.tpl');

