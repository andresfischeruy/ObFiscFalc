<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';


$nombre = $_POST["nombre"];
$email = $_POST["email"];
$password = $_POST["password"];

$miSmarty = getSmarty();
$miSmarty->display('registro.tpl');

//Alta usuario
function guardarUsuario($nombre, $email, $password) {

    $cn = getConexion();
    $cn->consulta(
            "insert into usuarios"
            . "(id, email, nombre, password)"
            . " values(:id, :email, :nombre, :pass)", array(
        array("id", $cn->ultimoIdInsert()+1, 'int'),
        array("email", $email, 'string'),
        array("nombre", $nombre, 'string'),
        array("pass", $password, 'string')
            )
    );
}


guardarUsuario($nombre, $email, $password);




//header("location:index.php");