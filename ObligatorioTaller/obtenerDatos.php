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

function obtenerPublicacionPorTipo($tip, $esp, $raz, $bar) {
    $cn = getConexion();
    $cn->consulta(
            "select * from publicaciones where tipo=:tip AND especie_id=:esp AND raza_id=:raz AND barrio_id=:bar", array(
        array("tip", $tip, 'char'),
        array("raz", $raz, 'int'),
        array("bar", $bar, 'int'),
        array("esp", $esp, 'int')
    ));

    return $cn->restantesRegistros();
}

function obtenerPublicacionesAbiertasPorUsuario($usr) {
    $cn = getConexion();
    $cn->consulta(
            "select titulo from publicaciones where usuario_id=:usr AND abierto=1", array(
        array("usr", $usr, 'int')
    ));

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
//Alta imagenes
function guardarImagenes($titulo, $foto) {
    //dentro de la carpeta Fotos, la idea es crear un directorio por publicacion que almacene las fotos de la misma. 
    //Crea bien de bien el directorio, reconoce la imagen, pero no la guarda en el serv. 
    $id = $titulo . " " . $foto['name'];
    $directorio = "./fotos/" . $titulo;

    if (!file_exists($directorio)) {
        mkdir($directorio, 0777);
    }

    if (isset($foto)) {
        $temporal = $foto['tmp_name'];
        $nuevo = $directorio . "/" . $id;
        move_uploaded_file($temporal, $nuevo);
    }
}

///////////////////////////////////////
//Alta publicacion
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

    guardarImagenes($titulo, $foto);

    return $cn->consulta($sql, $parametros);
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

// Validar password

function validarPass($clave) {
    return strlen($clave) > 8 && preg_match('`[a-zA-Z]`', $clave) && preg_match('`[0-9]`', $clave);
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
