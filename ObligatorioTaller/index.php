<?php

require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';

$catId = 1;

$miSmarty = getSmarty();
$miSmarty->display('index.tpl');

