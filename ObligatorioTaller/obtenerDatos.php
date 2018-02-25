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

function obtenerRazas() {
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

function obtenerPublicacionPorTipo($tip) {
    $cn = getConexion();
    $cn->consulta(
            "select * from publicaciones where tipo=:tip", array(
        array("tip", $tip, 'char')
    ));

    return $cn->restantesRegistros();
}

////////////////////////////////////////
//Login de Usuario
function login($usuario, $clave) {

    $cn = getConexion();
    $cn->consulta(
            "select * from usuarios where email=:nom and pass=:cla", array(
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

//Alta publicacion
function guardarPublicacion($titulo, $descripcion, $tipo, $especieid, $raza, $barrio, $abierto, $usuario) {

    $sql = "INSERT INTO publicaciones (id, titulo, descripcion, tipo, especie_id, raza_id, barrio_id, abierto, usuario_id, exitoso, latitud, longitud)";
    $sql .= " VALUES (:id, :titulo, :descripcion, :tipo, :especie_id, :raza_id, :barrio_id, :abierto, :usuario_id, :exitoso, :latitud, :longitud)";


    $cn = getConexion();
    $cn->consulta($sql, array(
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
            )
    );
}

//Devolver id

function devolverIdEspecie($especie){
    $cn = getConexion();
    $cn->consulta(
            "select id from especies where nombre=:especie", array(
        array("especie", $especie, 'string')
    ));
    $idEspecie = $cn->siguienteRegistro();
    return $idEspecie['id'];
}

function devolverIdRaza($raza){
    $cn = getConexion();
    $cn->consulta(
            "select id from razas where nombre=:raza", array(
        array("raza", $raza, 'string')
    ));
    $idRaza = $cn->siguienteRegistro();
    return $idRaza['id'];
    
}

function devolverIdBarrio($barrio){
    $cn = getConexion();
    $cn->consulta(
            "select id from barrios where nombre=:barrio", array(
        array("barrio", $barrio, 'string')
    ));
    $idBarrio = $cn->siguienteRegistro();
    return $idBarrio['id'];
}

function devolverIdUsuario($usuario){
    $cn = getConexion();
    $cn->consulta(
            "select id from usuarios where nombre=:usuario", array(
        array("usuario", $usuario, 'string')
    ));
    $idUsuario = $cn->siguienteRegistro();
    return $idUsuario['id'];
}

// Validar password

function validarPass($clave) {
    return strlen($clave) > 8 && preg_match('`[a-zA-Z]`', $clave) && preg_match('`[0-9]`', $clave);
}

//Controlar email repetido

function existeEmail($email) {
    $cn = getConexion();
    $cn->consulta(
            "select email from usuarios where email=:email", array(
        array("email", $email, 'string')
    ));
    $usuarioEmail = $cn->siguienteRegistro();
    return $usuarioEmail != null;
}

//Smarty
function getSmarty() {
    $miSmarty = new Smarty();
    $miSmarty->template_dir = "templates";
    $miSmarty->compile_dir = "templates_c";
    $miSmarty->cache_dir = "cache";
    $miSmarty->config_dir = "config";
    $miSmarty->assign("usuario", usuarioLogueado());
    return $miSmarty;
}
