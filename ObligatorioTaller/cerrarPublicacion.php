<?php

require_once 'config/configuracion.php';
require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';


$miSmarty = getSmarty();

//Carga de mis publicaciones
$usuarioLog = usuarioLogueado();
$idUsr = (int) devolverIdUsuario($usuarioLog);

$miSmarty->assign("publicaciones", obtenerPublicacionesAbiertasPorUsuario($idUsr));


$miSmarty->display('cerrarPublicacion.tpl');



