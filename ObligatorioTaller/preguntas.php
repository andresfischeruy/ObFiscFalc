<?php

require_once 'obtenerDatos.php';

$id=1;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$usuario = usuarioLogueado();
$idUsuario = devolverIdUsuario($usuario);
$texto = $_POST['pregunta'];


if(strlen($texto)!= 0){
    guardarPregunta($idUsuario, $texto, $id);
    header('location:details.php?id='.$id.'&err=0&tipo=preg');
}else{
    header('location:details.php?id='.$id.'&err=1&tipo=preg');
}


function guardarPregunta($usuario, $pregunta, $idPublicacion) {

    $sql = "INSERT INTO preguntas (id, id_publicacion, texto, respuesta, usuario_id)";
    $sql .= " VALUES (:id, :publi, :pregunta, :resp, :usuario)";

    $cn = getConexion();
    return $cn->consulta($sql, array(
        array("id", '', 'int'),
        array("publi", $idPublicacion, 'int'),
        array("pregunta", $pregunta, 'string'),
        array("resp", '', 'string'),
        array("usuario", $usuario, 'int')
            )
    );
}



