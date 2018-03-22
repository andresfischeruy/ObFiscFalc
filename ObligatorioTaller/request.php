<?php

require_once 'config/configuracion.php';
require_once 'obtenerDatos.php';
$especie = $_GET['esp'];
$smarty = getSmarty();
$smarty->assign("razas", obtenerRazas($especie));
$smarty->display("comboRazasConAjax.tpl");