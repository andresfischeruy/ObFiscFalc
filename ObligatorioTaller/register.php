<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';


$nombre = $_POST["nombre"];
$email = $_POST["email"];
$password = $_POST["password"];

$miSmarty = getSmarty();

if(strlen($password)==0 || strlen($nombre)==0 || strlen($email)==0){
     $miSmarty->assign("divAlerta", "<div  class='alert alert-warning'>".
                                "<button type='button' class='close' data-dismiss='alert'>×</button>".
                                "(*) Campos requeridos" .
                                "</div>");
}else if (!validarPass($password)) {
    $miSmarty->assign("divAlerta", "<div  class='alert alert-danger'>".
                                "<button type='button' class='close' data-dismiss='alert'>×</button>".
                                "Complejidad de contraseña esperada: 8 caracteres, al menos un numero y al menos una letra." .
                                "</div>");
} else {
    $miSmarty->assign("divAlerta", "<div  class='alert alert-success'>".
                                "<button type='button' class='close' data-dismiss='alert'>×</button>".
                                "Registro exitoso." .
                                "</div>");
    guardarUsuario($nombre, $email, $password);
}


$miSmarty->display("registro.tpl");


