<?php

require_once 'obtenerDatos.php';
$id = 1;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$logueado = login($usuario, $clave);

if($logueado){
    header('location:details.php?id='.$id);
}


