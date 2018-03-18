<?php

require_once 'obtenerDatos.php';

require_once 'libs/Smarty.class.php';

require('libs/fpdf/fpdf.php');

$id=1;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$usuario = usuarioLogueado();
$idUsuario = devolverIdUsuario($usuario);
$texto = $_POST['pregunta'];
$arrayFotos = levantarImagenes("./fotos/",$id);
$miSmarty = getSmarty();


//Carga de preguntas
$preguntas = obtenerPreguntas($id);




//Carga de publicacion
$publicacion = obtenerPublicacionPorID($id);
$miSmarty->assign("publicacion", $publicacion);
$miSmarty->assign("especie", devolverNombreEspecie($publicacion['especie_id']));
$miSmarty->assign("raza", devolverNombreRaza($publicacion['raza_id']));

//Obtener Preguntas
function obtenerPreguntas($idP) {
    $cn = getConexion();
    $cn->consulta(
            "select * from preguntas where id_publicacion=:id", array(
        array("id", $idP, 'int')
    ));

    return $cn->restantesRegistros();
}

//guardarPregunta($idUsuario, $texto, $id);


$pregunta = $_POST['comboPreguntas'];
$idPregunta = (int) devolverIdPregunta($pregunta);
$respuesta = $_POST['respuesta'];

//responderPregunta($idPregunta, $respuesta);

$miSmarty->assign("preguntas", $preguntas);
$miSmarty->assign("preguntasSinRespuesta", obtenerPreguntasSinRespuesta($id));
$miSmarty->assign("usuarioPublicador", $publicacion['usuario_id']);
$miSmarty->assign('primerFoto', $arrayFotos[0] );
$miSmarty->assign('fotos', devolverFotosSinLaPrimera($arrayFotos) );
$miSmarty->display('details.tpl');