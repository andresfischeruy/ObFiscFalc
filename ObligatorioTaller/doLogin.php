<?php

require_once 'obtenerDatos.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$logueado = login($usuario, $clave);

header('location:index.php');

