<?php

require_once 'configuracion.php';
require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';
require_once 'libs/class.Conexion.BD.php';


$nombre = $_POST["nombre"];
$email = $_POST["email"];
$password = $_POST["password"];

$miSmarty = getSmarty();


if(existeEmail($email)){
    $miSmarty->assign("tipoAlerta", "alert alert-danger");
    $miSmarty->assign("mensajeAlerta", "E-mail ya ingresado.");
}else if (strlen($password) == 0 || strlen($nombre) == 0 || strlen($email) == 0) {
    $miSmarty->assign("tipoAlerta", "alert alert-warning");
    $miSmarty->assign("mensajeAlerta", "(*) Campos requeridos");
} else if (!validarPass($password)) {
    $miSmarty->assign("tipoAlerta", "alert alert-danger");
    $miSmarty->assign("mensajeAlerta", "Complejidad de contraseña esperada: al menos 8 caracteres, letras y numeros.");
} else {
    $miSmarty->assign("tipoAlerta", "alert alert-success");
    $miSmarty->assign("mensajeAlerta", "Registro exitoso.");
    guardarUsuario($nombre, $email, $password);
    
}

$miSmarty->display("registro.tpl");


