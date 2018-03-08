<?php


require_once 'obtenerDatos.php';
$especie = $_GET['esp'];
$smarty = getSmarty();
$razassssss = obtenerRazas($especie);
$smarty->assign("razas", obtenerRazas($especie));
$smarty->display("comboRazasConAjax.tpl");