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

function devolverCantidadXTipoEspecieEstado($cantReg, $tipo, $estado) {
    for ($i = 1; $i < $cantReg; $i++) {
        $cn = getConexion();
        $cn->consulta(
                "select count(*) as cant from publicaciones where tipo=:tipo and especie_id=:esp and abierto=:estado", array(
            array('tipo', $tipo, 'char'),
            array('esp', $i, 'int'),
            array('estado', $estado, 'int')
        ));
        $contador[$i] = $cn->siguienteRegistro();
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
$contadorXespEAb = devolverCantidadXTipoEspecieEstado($contadorE,'E', 1);
$contadorXespPAb = devolverCantidadXTipoEspecieEstado($contadorP,'P', 1);
$contadorXespECer = devolverCantidadXTipoEspecieEstado($contadorE,'E', 0);
$contadorXespPCer = devolverCantidadXTipoEspecieEstado($contadorP,'P', 0);
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

$miSmarty->display("header.tpl");
$miSmarty->display('estadisticas.tpl');
$miSmarty->display("footer.tpl");

