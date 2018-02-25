<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';


$nombre = $_POST["nombre"];
$email = $_POST["email"];
$password = $_POST["password"];

$miSmarty = getSmarty();
$miSmarty->display('registro.tpl');




guardarUsuario($nombre, $email, $password);


header("location:index.php");