<?php

require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\controllers\marcaVentasController.php';
require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\controllers\cantRestanteController.php';
require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\controllers\topVentasController.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = trim($_SERVER['PATH_INFO'], '/');

if ($path == "marca_ventas"){

    $objetosMarcaVentas = new marcaVentasController();

    switch($method) {
        case 'GET':
            $objetosMarcaVentas->get();
            break;
        default:
            include "error/response.html";
    }
}
elseif ($path == "cantidad_restante"){

    $objetosCantRestante = new cantRestanteController();

    switch($method) {
        case 'GET':
            $objetosCantRestante->get();
            break;
        default:
            include "error/response.html";
    }
}
elseif ($path == "top_ventas"){

    $objetosTopVentas = new topVentasController();

    switch($method) {
        case 'GET':
            $objetosTopVentas->get();
            break;
        default:
            include "error/response.html";
    }
}

// SI NO SE CUMPLE NINGUNO DE LOS ANTERIORES TIRA ERROR
else {
    include "error/response.html";
}

?>