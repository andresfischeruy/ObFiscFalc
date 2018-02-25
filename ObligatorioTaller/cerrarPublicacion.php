<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';


$miSmarty = getSmarty();




//Carga de mis publicaciones
$usuarioLog = usuarioLogueado();
$idUsr = (int)devolverIdUsuario($usuarioLog);

$miSmarty->assign("publicaciones", obtenerPublicacionesAbiertasPorUsuario($idUsr));



$publi = $_POST['comboPublicaciones'];
$publiID = (int)devolverIdPublicacion($publi);

function publicacionConExito() {
    $valorExito = $_POST[Tipo];
    if($valorExito == 'Reunido')
        return 1;
    else
        return 0;
}

cerrarPublicacion($publiID,publicacionConExito());

function publicacionCerrada($publiID){
    $cn = getConexion();
    $cn->consulta(
            "select abierto from publicaciones where id=:id", array(
        array("id", $publiID, 'int')
    ));
    $abierto = $cn->siguienteRegistro();
    return abierto == 0;
}



if(publicacionCerrada($publiID)){
    $miSmarty->assign("tipoAlerta", "alert alert-success");
    $miSmarty->assign("mensajeAlerta", "Publicacion cerrada con exito.");
}



$miSmarty->display('cerrarPublicacion.tpl');

