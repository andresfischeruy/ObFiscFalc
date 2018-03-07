<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';


$miSmarty = getSmarty();

//Funciones Estadísticas
function devolverCantidadDePubliXTipo($tipo) {
    $cn = getConexion();
    $cn->consulta(
            "select count(*) as cant from publicaciones where tipo=:tipo", array(
        array('tipo', $tipo, 'char')
    ));
    $contador = $cn->siguienteRegistro();
    return $contador['cant'];
}

function cantidadDeEspecies() {
    $cn = getConexion();
    $cn->consulta(
            "select count(*) as cant from especies");
    $contador = $cn->siguienteRegistro();
    return $contador['cant'];
}


function devolverCantidadXTipoEspecieEstado($tipo, $estado) {
   $contador = array();
    for ($i = 1; $i <= cantidadDeEspecies(); $i++) {
        $cn = getConexion();
        $cn->consulta(
                "select count(*) as cant from publicaciones where tipo=:tipo and especie_id=:esp and abierto=:estado", array(
            array('tipo', $tipo, 'char'),
            array('esp', $i, 'int'),
            array('estado', $estado, 'int')
        ));
        $contador[$i]['cantidad'] = $cn->siguienteRegistro()['cant'];
        $contador[$i]['nombreEspecie'] = devolverNombreEspecie($i)['nombre'];
    }
    return $contador;
}

function devolverCantidadSegunEstadoYExito($exito) {
    $cn = getConexion();
    $cn->consulta(
            "select count(*) as cant from publicaciones where abierto=0 and exitoso=:exito", array(
        array('exito', $exito, 'int')));
    $contador = $cn->siguienteRegistro();
    
    return $contador['cant'];
}


//Variables para estadísticas
$contadorE = devolverCantidadDePubliXTipo('E');
$contadorP = devolverCantidadDePubliXTipo('P');
$contadorXespEAb = devolverCantidadXTipoEspecieEstado('E', 1);
$contadorXespPAb = devolverCantidadXTipoEspecieEstado('P', 1);
$contadorXespECer = devolverCantidadXTipoEspecieEstado('E', 0);
$contadorXespPCer = devolverCantidadXTipoEspecieEstado('P', 0);
$contadorExitosas = devolverCantidadSegunEstadoYExito(1);
$contadorNoExitosas = devolverCantidadSegunEstadoYExito(0);

$miSmarty->assign("contadorEncontradas",$contadorE );
$miSmarty->assign("contadorPerdidas", $contadorP);
$miSmarty->assign("arrayEncAbiertas",$contadorXespEAb );
$miSmarty->assign("arrayPerdAbiertas", $contadorXespPAb);
$miSmarty->assign("arrayEncCerradas",$contadorXespECer );
$miSmarty->assign("arrayPerdCerradas", $contadorXespPCer);
$miSmarty->assign("contadorExitosas", $contadorExitosas);
$miSmarty->assign("contadorNoExitosas", $contadorNoExitosas);

$miSmarty->display('estadisticas.tpl');

