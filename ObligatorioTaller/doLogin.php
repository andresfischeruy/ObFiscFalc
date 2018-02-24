<?php

require_once 'obtenerDatos.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$logueado = login($usuario, $clave);

if($logueado != null) {
    header('location:bien.php');
} else {
    header('location:mal.php');
}

