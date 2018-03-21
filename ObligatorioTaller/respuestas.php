<?php

require_once 'obtenerDatos.php';

$id=1;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


$pregunta = $_POST['comboPreguntas'];
$idPregunta = (int) devolverIdPregunta($pregunta);
$respuesta = $_POST['respuesta'];


if(strlen($respuesta)!= 0){
    responderPregunta($idPregunta, $respuesta);
    header('location:details.php?id='.$id.'&err=0&tipo=resp');
}else{
    header('location:details.php?id='.$id.'&err=1&tipo=resp');
}


function responderPregunta($idPregunta, $texto) {
    $sql = "UPDATE preguntas SET respuesta=:resp";
    $sql .= " where id=:id";
    $cn = getConexion();
    return $cn->consulta($sql, array(
        array("id", $idPregunta, 'int'),
        array("resp", $texto, 'string')));
}


