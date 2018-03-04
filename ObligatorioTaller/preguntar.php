<?php

require_once 'obtenerDatos.php';



function guardarPregunta($usuario, $pregunta, $idPublicacion) {

    $sql = "INSERT INTO preguntas (id, id_publicacion, texto, respuesta, usuario_id)";
    $sql .= " VALUES (:id, :publi, :pregunta, :resp, :usuario)";


    $cn = getConexion();
    $cn->consulta($sql, array(
        array("id", '', 'int'),
        array("publi", $idPublicacion, 'int'),
        array("pregunta", $pregunta, 'string'),
        array("resp", '', 'string'),
        array("usuario", $usuario, 'int')
            )
    );
}

