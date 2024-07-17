<?php

// ARREGLAR EL PATH (POR ALGUNA RAZON NO DEJA ../db/database.php)
require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\db\database.php';

// ESPERA POR METODO URL Y RECORTA QUITANDO LOS SIMBOLOS DE BARRA INCLINADA
$method = $_SERVER['REQUEST_METHOD'];
$path = trim($_SERVER['PATH_INFO'], '/');
// var_dump($path);

// FUNCION QUE EJECUTA CONSULKTA DE SQL
function executeQuery($conn, $query) {
    try {
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}

// PRIMER ENDPOINT SELECCIONA MARCA CON MINIMO 1 VENTA
if ($path == "marca_ventas"){
    switch($method) {
        case 'GET':
            $query = "SELECT * FROM marcas_ventas";
            executeQuery($conn, $query);
            break;
        default:
            include "error/response.html";
    }
}

// SEGUNDO ENDPOINT SELECCIONA LA CANTIDAD VENDIDA Y CANTIDAD RESTANTE DE LOS ARTICULOS
elseif($path == "cantidad_restante"){
    switch($method) {
        case 'GET':
            $query = "SELECT * FROM ventas_cantrestante";
            executeQuery($conn, $query);
            break;
        default:
            include "error/response.html";
    }
}

// TERCER ENDPOINT SELECCIONA LAS TOP 5 MARCAS MAS VENDIDAS
elseif($path == "top_ventas"){
    switch($method) {
        case 'GET':
            $query = "SELECT * FROM top_ventas";
            executeQuery($conn, $query);
            break;
        default:
            include "error/response.html";
    }
}

// PROBANDO PUT
/* elseif ($path == "actualizar_articulo"){
    switch($method) {
        case 'PUT':
            $query = "UPDATE articulo SET cantidad_articulo = 10 WHERE id = 1";
        default:
            include "error/response.html";
    }
}
*/

// PROBANDO DELETE
/* elseif ($path == "eliminar_venta"){
    switch($method) {
        case 'DELETE':
            $query_venta = "DELETE FROM venta WHERE articulo_id = :articulo_id";
            $query_articulo = "DELETE FROM articulo WHERE id = :articulo_id";
        default:
            include "error/response.html";
    }
}

else{
    include "error/response.html";
}
*/
?>