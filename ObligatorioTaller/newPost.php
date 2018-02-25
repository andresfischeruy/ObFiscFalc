<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';

$miSmarty = getSmarty();
$miSmarty->assign("especies", obtenerEspecies());
$miSmarty->assign("razas", obtenerRazas());
$miSmarty->assign("barrios", obtenerBarrios());

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$tipo = $_POST['tipo'];
$especie = $_POST['comboEspecies'];
$especieID = (int)devolverIdEspecie($especie);
$raza = $_POST['comboRazas'];
$razaID = (int)devolverIdRaza($raza);
$barrio = $_POST['comboBarrios'];
$barrioID = (int)devolverIdBarrio($barrio);
$abierto = 1;
$usuario = 13;



if(strlen($titulo) == 0 || strlen($descripcion) == 0){
    $miSmarty->assign("tipoAlerta", "alert alert-warning");
    $miSmarty->assign("mensajeAlerta", "(*) Campos requeridos");
} else {
    $miSmarty->assign("tipoAlerta", "alert alert-success");
    $miSmarty->assign("mensajeAlerta", "Registro exitoso.");
    guardarPublicacion($titulo, $descripcion, $tipo, $especieID, $razaID, $barrioID, $abierto, $usuario);
}



$miSmarty->display("nuevaPublicacion.tpl");

