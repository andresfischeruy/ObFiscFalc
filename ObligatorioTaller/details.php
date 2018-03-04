<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';


$id=1;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$miSmarty = getSmarty();

//Carga de publicacion
$publicacion = obtenerPublicacionPorID($id);
$miSmarty->assign("publicacion", $publicacion);

$miSmarty->assign("especie", devolverNombreEspecie($publicacion['especie_id']));
$miSmarty->assign("raza", devolverNombreRaza($publicacion['raza_id']));

//Carga de preguntas
$preguntas = obtenerPreguntas($id);
$miSmarty->assign("preguntas", $preguntas);
$miSmarty->assign('fotos', levantarImagenes("./fotos/",$id));
$miSmarty->display("header.tpl");
$miSmarty->display('details.tpl');


//Obtener Preguntas
function obtenerPreguntas($idP) {
    $cn = getConexion();
    $cn->consulta(
            "select * from preguntas where id_publicacion=:id", array(
        array("id", $idP, 'int')
    ));

    return $cn->restantesRegistros();
}
