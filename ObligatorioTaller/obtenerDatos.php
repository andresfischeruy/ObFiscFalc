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
    if($usr!=null) {
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
    $cn->consulta( $sql, array(
        array("id", '', 'int'),
        array("email", $email, 'string'),
        array("nombre", $nombre, 'string'),
        array("pass", $password, 'string')
            )
    );
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
