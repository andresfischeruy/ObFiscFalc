<?php

require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';

//Conexión a la BDD
function getConexion() {
    $cn = new ConexionBD(
            "mysql", "localhost", "mascotas", "root", "root");

    $cn->conectar();
    return $cn;
}

////////////////////////////////////////
//Carga de elementos del SideBar
function obtenerEspecies() {
    $cn = getConexion();
    $cn->consulta("select * from especies");
    return $cn->restantesRegistros();
}

function obtenerRazas($esp) {
    $cn = getConexion();
    $cn->consulta("select * from razas where especie_id=:esp", array(
        array("esp", $esp, 'int')
    ));
    return $cn->restantesRegistros();
}

//TEMPORAL

function obtenerRazasSinParam() {
    $cn = getConexion();
    $cn->consulta("select * from razas");
    return $cn->restantesRegistros();
}

function obtenerBarrios() {
    $cn = getConexion();
    $cn->consulta("select * from barrios");
    return $cn->restantesRegistros();
}

////////////////////////////////////////
//Carga de Publicaciones

function obtenerTodasLasPublicaciones() {
    $cn = getConexion();
    $cn->consulta("select * from publicaciones");
    return $cn->restantesRegistros();
}

function obtenerTodasLasPublicacionesAbiertas() {
    $cn = getConexion();
    $cn->consulta("select * from publicaciones where abierto=1");
    return $cn->restantesRegistros();
}

function obtenerPublicaciones($tipo, $especie, $raza, $barrio) {
    $sql = "select * from publicaciones where abierto=1";
    $param = array();

    $cn = getConexion();

    if (!empty($tipo)) {
        $sql .= " and tipo=:tipo";
        $param [] = array("tipo", $tipo, 'char');
    }


    if (!empty($barrio)) {
        $sql .= " and barrio_id=:barrio";
        $param [] = array("barrio", $barrio, 'int');
    }

    if (!empty($especie)) {
        $sql .= " and especie_id=:especie";
        $param [] = array("especie", $especie, 'int');

        if (!empty($raza)) {
            $sql .= " and raza_id=:raza";
            $param [] = array("raza", $raza, 'int');
        }
    }
    
    $cn->consulta($sql, $param);
    return $cn->restantesRegistros();
}

function obtenerPublicacionesPaginadas($pagina, $tamano_pagina, $tipo, $especie, $raza, $barrio) {
    
    $sql = "select * from publicaciones where abierto=1";
    $concatenar = '';
    $sqlCantidad = "select count(*) as total from publicaciones where abierto=1";
    $param = array();
    
    $cn = getConexion();
    
    //FILTROS
    if (!empty($tipo)) {
        $concatenar .= " and tipo=:tipo";
        $param [] = array("tipo", $tipo, 'char');
    }

    if (!empty($barrio)) {
        $concatenar .= " and barrio_id=:barrio";
        $param [] = array("barrio", $barrio, 'int');
    }

    if (!empty($especie)) {
        $concatenar .= " and especie_id=:especie";
        $param [] = array("especie", $especie, 'int');

        if (!empty($raza)) {
            $concatenar .= " and raza_id=:raza";
            $param [] = array("raza", $raza, 'int');
        }
    }
    
    $sql .= $concatenar;
    $sql .= " limit :offset, :limit";

    $sqlCantidad .= $concatenar;
    
    $param [] = array("limit", $tamano_pagina, 'int');
    $param [] = array("offset", ($pagina * $tamano_pagina), 'int');
            
    $cn->consulta($sqlCantidad);
    $total = $cn->siguienteRegistro()["total"];
    
    $cn->consulta($sql, $param);
    $publicaciones =  $cn->restantesRegistros();
    
    return array(
        "total" => $total,
        "publicaciones" => $publicaciones,
    );
}

function obtenerFotos($publicaciones){
    while (list($k,$valor) = each($publicaciones)) {
        $publicaciones[$k]['fotos'] = levantarImagenes("./fotos/" , $valor["id"]);
    }    
   
    reset ($publicaciones);
    return $publicaciones;
}



function obtenerPublicacionesAbiertasPorUsuario($usr) {
    $cn = getConexion();
    $cn->consulta(
            "select titulo from publicaciones where usuario_id=:usr AND abierto=1", array(
        array("usr", $usr, 'int')
    ));

    return $cn->restantesRegistros();
}

function obtenerPublicacionPorID($iden) {
    $cn = getConexion();
    $cn->consulta(
            "select * from publicaciones where id=:iden", array(
        array("iden", $iden, 'int')
    ));

    return $cn->siguienteRegistro();
}

function obtenerPreguntasSinRespuesta($idP) {
    $cn = getConexion();
    $cn->consulta(
            "select texto from preguntas where respuesta='' and id_publicacion=:id", array(
        array('id', $idP, 'int')));
    return $cn->restantesRegistros();
}

////////////////////////////////////////
//Login de Usuario
function login($usuario, $clave) {

    $cn = getConexion();
    $cn->consulta(
            "select * from usuarios where email=:nom and password=:cla", array(
        array("nom", $usuario, 'string'),
        array("cla", $clave, 'string')
    ));

    $usr = $cn->siguienteRegistro();
    if ($usr != null) {
        session_start();
        $_SESSION["usuario"] = $usr;
    }

    return $usr;
}

function usuarioLogueado() {
    session_start();
    if (isset($_SESSION['usuario'])) {
        return $_SESSION['usuario'];
    }

    return null;
}

//Alta usuario
function guardarUsuario($nombre, $email, $password) {

    $sql = "INSERT INTO usuarios (id, email, nombre, password)";
    $sql .= " VALUES (:id, :email, :nombre, :pass)";


    $cn = getConexion();
    $cn->consulta($sql, array(
        array("id", '', 'int'),
        array("email", $email, 'string'),
        array("nombre", $nombre, 'string'),
        array("pass", $password, 'string')
            )
    );
}

///////////////////////////////////////
//Manejo de imagenes
function guardarImagenes($titulo, $foto) {
    $exito = true;

    for ($index = 0; $index < count($foto['name']); $index++) {
        $idFoto = $titulo . " " . $foto['name'][$index];
        $directorio = "./fotos";

        if ($foto['name'][$index]) {
            $temporal = $foto['tmp_name'][$index];
            $nuevo = $directorio . "/" . $idFoto;
            if (!move_uploaded_file($temporal, $nuevo)) {
                $exito = false;
            }
        }
    }
    return $exito;
}

function levantarImagenes($directorio, $publi) {
    $fotos = array();

    if (is_dir($directorio)) {
        $d = dir($directorio);
        $idPublicacion = intval($publi, 10);
        while (false !== ($file = $d->read())) {
            $publiRecorrida = intval(obtenerIdPublicacionSegunFoto($file), 10);
            if ($file != "." && $file != ".." && $idPublicacion == $publiRecorrida) {
                $fotos[] = $directorio . $file;
            }
        }
        $d->close();
    }
    return $fotos;
}

function devolverFotosSinLaPrimera($fotos) {
    $resultado = array();
    for ($i = 1; $i < count($fotos); $i++) {
        $resultado[] = $fotos[$i];
    }
    return $resultado;
}

function obtenerIdPublicacionSegunFoto($dirFoto) {
    $idPubliFoto = explode(" ", $dirFoto);
    return $idPubliFoto[0];
}

//Cerrar publicacion
function cerrarPublicacion($idPubli, $exito) {

    $sql = "UPDATE publicaciones SET abierto=0, exitoso=:exitoso";
    $sql .= " where id=:id";
    $cn = getConexion();
    $cn->consulta($sql, array(
        array("id", $idPubli, 'int'),
        array("exitoso", $exito, 'int')));
}

///////////////////////////////////////
//Devolver id

function devolverIdEspecie($especie) {
    $cn = getConexion();
    $cn->consulta(
            "select id from especies where nombre=:especie", array(
        array("especie", $especie, 'string')
    ));
    $idEspecie = $cn->siguienteRegistro();
    return $idEspecie['id'];
}

function devolverIdRaza($raza) {
    $cn = getConexion();
    $cn->consulta(
            "select id from razas where nombre=:raza", array(
        array("raza", $raza, 'string')
    ));
    $idRaza = $cn->siguienteRegistro();
    return $idRaza['id'];
}

function devolverIdBarrio($barrio) {
    $cn = getConexion();
    $cn->consulta(
            "select id from barrios where nombre=:barrio", array(
        array("barrio", $barrio, 'string')
    ));
    $idBarrio = $cn->siguienteRegistro();
    return $idBarrio['id'];
}

function devolverIdUsuario($usuario) {
    return $usuario['id'];
}

function devolverIdPublicacion($tituloPublicacion) {
    $cn = getConexion();
    $cn->consulta(
            "select id from publicaciones where titulo=:titulo", array(
        array("titulo", $tituloPublicacion, 'string')
    ));
    $idPubli = $cn->siguienteRegistro();
    return $idPubli['id'];
}

function devolverNombreEspecie($especie) {
    $cn = getConexion();
    $cn->consulta(
            "select nombre from especies where id=:especie", array(
        array("especie", $especie, 'int')
    ));
    return $cn->siguienteRegistro();
}

function devolverNombreRaza($raza) {
    $cn = getConexion();
    $cn->consulta(
            "select nombre from razas where id=:raza", array(
        array("raza", $raza, 'int')
    ));
    return $cn->siguienteRegistro();
}

function devolverIdPregunta($textoPregunta) {
    $cn = getConexion();
    $cn->consulta(
            "select id from preguntas where texto=:texto", array(
        array("texto", $textoPregunta, 'string')
    ));
    $idPregu = $cn->siguienteRegistro();
    return $idPregu['id'];
}

// Validar password
function validarPass($clave) {
    return strlen($clave) >= 8 && preg_match('`[a-zA-Z]`', $clave) && preg_match('`[0-9]`', $clave);
}

//Validar email repetido
function existeEmail($email) {
    $cn = getConexion();
    $cn->consulta(
            "select email from usuarios where email=:email", array(
        array("email", $email, 'string')
    ));
    $usuarioEmail = $cn->siguienteRegistro();
    return $usuarioEmail != null;
}

//Configuración de Smarty
function getSmarty() {
    $miSmarty = new Smarty();
    $miSmarty->template_dir = "templates";
    $miSmarty->compile_dir = "templates_c";
    $miSmarty->cache_dir = "cache";
    $miSmarty->config_dir = "config";
    $miSmarty->assign("usuario", usuarioLogueado());
    return $miSmarty;
}
