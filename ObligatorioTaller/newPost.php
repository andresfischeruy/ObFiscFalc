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
$especieID = (int) devolverIdEspecie($especie);
$raza = $_POST['comboRazas'];
$razaID = (int) devolverIdRaza($raza);
$barrio = $_POST['comboBarrios'];
$barrioID = (int) devolverIdBarrio($barrio);
$abierto = 1;
$usuario = usuarioLogueado();
$usuarioID = (int) devolverIdUsuario($usuario);
$foto = $_FILES['img'];



if (strlen($titulo) == 0 || strlen($descripcion) == 0) {
    $miSmarty->assign("tipoAlerta", "alert alert-warning");
    $miSmarty->assign("mensajeAlerta", "(*) Campos requeridos");
} else {
    if (guardarPublicacion($titulo, $descripcion, $tipo, $especieID, $razaID, $barrioID, $abierto, $usuarioID, $foto)) {
        $miSmarty->assign("tipoAlerta", "alert alert-success");
        $miSmarty->assign("mensajeAlerta", "Registro exitoso.");
    } else {
        $miSmarty->assign("tipoAlerta", "alert alert-danger");
        $miSmarty->assign("mensajeAlerta", "No se pudo realizar la publicacion.");
    }
}



$miSmarty->display("nuevaPublicacion.tpl");

