<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';


$miSmarty = getSmarty();

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


$miSmarty->display('estadisticas.tpl');

