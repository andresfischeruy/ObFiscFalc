<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$tipo = $_POST['tipo'];
$especie = $_POST['comboEspecies'];
$especieID = (int) devolverIdEspecie($especie);
$raza = $_POST['comboRazas'];
$razaID = (int) devolverIdRaza($raza);
$barrio = $_POST['comboBarrios'];
$barrioID = (int) devolverIdBarrio($barrio);
$abierto = 1;
$usuario = usuarioLogueado();
$usuarioID = (int) devolverIdUsuario($usuario);
$foto = $_FILES['img'];


$miSmarty = getSmarty();
$miSmarty->assign("especies", obtenerEspecies());
$miSmarty->assign("razas", obtenerRazasSinParam());
$miSmarty->assign("barrios", obtenerBarrios());


//Funciones Alta publicacion
function guardarPublicacion($titulo, $descripcion, $tipo, $especieid, $raza, $barrio, $abierto, $usuario, $foto) {

    $sql = "INSERT INTO publicaciones (id, titulo, descripcion, tipo, especie_id, raza_id, barrio_id, abierto, usuario_id, exitoso, latitud, longitud)";
    $sql .= " VALUES (:id, :titulo, :descripcion, :tipo, :especie_id, :raza_id, :barrio_id, :abierto, :usuario_id, :exitoso, :latitud, :longitud)";
    $cn = getConexion();
    $parametros = array(
        array("id", '', 'int'),
        array("titulo", $titulo, 'string'),
        array("descripcion", $descripcion, 'string'),
        array("tipo", $tipo, 'char'),
        array("especie_id", $especieid, 'int'),
        array("raza_id", $raza, 'int'),
        array("barrio_id", $barrio, 'int'),
        array("abierto", $abierto, 'bit'),
        array("usuario_id", $usuario, 'int'),
        array("exitoso", '', 'bit'),
        array("latitud", '', 'decimal'),
        array("longitud", '', 'decimal')
    );

    if (count($foto['name']) == 1 && strlen($foto['name'][0]) == 0) {
        return false;
    }

    if (!$cn->consulta($sql, $parametros)) {
        return false;
    }
    $idPubli = $cn->ultimoIdInsert();
    if (!guardarImagenes($idPubli, $foto)) {
        return false;
    }
    return true;
}


if (strlen($titulo) == 0 || strlen($descripcion) == 0) {
    $miSmarty->assign("tipoAlerta", "alert alert-warning");
    $miSmarty->assign("mensajeAlerta", "(*) Campos requeridos");
} else {
    if (guardarPublicacion($titulo, $descripcion, $tipo, $especieID, $razaID, $barrioID, $abierto, $usuarioID, $foto)) {
        $miSmarty->assign("tipoAlerta", "alert alert-success");
        $miSmarty->assign("mensajeAlerta", "Registro exitoso.");
    } else {
        $miSmarty->assign("tipoAlerta", "alert alert-danger");
        $miSmarty->assign("mensajeAlerta", "No se pudo realizar la publicacion.");
    }
}


$miSmarty->display("header.tpl");
$miSmarty->display("nuevaPublicacion.tpl");
$miSmarty->display("footer.tpl");

