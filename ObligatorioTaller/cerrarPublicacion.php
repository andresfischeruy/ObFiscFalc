<?php

require_once 'configuracion.php';
require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';


$miSmarty = getSmarty();

//Carga de mis publicaciones
$usuarioLog = usuarioLogueado();
$idUsr = (int) devolverIdUsuario($usuarioLog);

$miSmarty->assign("publicaciones", obtenerPublicacionesAbiertasPorUsuario($idUsr));

$publi = $_POST['comboPublicaciones'];
$publiID = (int) devolverIdPublicacion($publi);

function publicacionConExito() {
    $valorExito = $_POST['tipo'];
    if ($valorExito == 'Reunido')
        return 1;
    else
        return 0;
}

cerrarPublicacion($publiID, publicacionConExito());
$miSmarty->display('cerrarPublicacion.tpl');



