<?php

require_once 'config/configuracion.php';
require_once 'obtenerDatos.php';
require_once 'libs/Smarty.class.php';


$miSmarty = getSmarty();


$publi = $_POST['comboPublicaciones'];
$publiID = (int) devolverIdPublicacion($publi);

function publicacionConExito() {
    $valorExito = $_POST['tipo'];
    if ($valorExito == 'Reunido')
        return 1;
    else
        return 0;
}


cerrarPublicacion($publiID, publicacionConExito());
header('location:cerrarPublicacion.php');




