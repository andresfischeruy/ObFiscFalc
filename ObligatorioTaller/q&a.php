<?php
require_once 'obtenerDatos.php';

$id=1;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$usuario = usuarioLogueado();
$idUsuario = devolverIdUsuario($usuario);
$texto = $_POST['pregunta'];


guardarPregunta($idUsuario, $texto, $id);


$pregunta = $_POST['comboPreguntas'];
$idPregunta = (int) devolverIdPregunta($pregunta);
$respuesta = $_POST['respuesta'];

responderPregunta($idPregunta, $respuesta);



header('location:details.php?ID='.$id);


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

function responderPregunta($idPregunta, $texto) {
    $sql = "UPDATE preguntas SET respuesta=:resp";
    $sql .= " where id=:id";
    $cn = getConexion();
    return $cn->consulta($sql, array(
        array("id", $idPregunta, 'int'),
        array("resp", $texto, 'string')));
}


