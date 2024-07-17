<?php

// CREDENCIALES DE LA BASE DE DATOS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tiendaropa";

// TRYCATCH PARA CONEXION DE BASE DE DATOS
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // VISTA PARA PRIMER ENDPOINT
    $marcaVentas = "CREATE VIEW IF NOT EXISTS marcas_ventas AS
    SELECT DISTINCT m.id, m.nombre_marca
    FROM marca m
    JOIN articulo a ON m.id = a.marca_id
    JOIN venta v ON a.id = v.articulo_id";

    // VISTA PARA SEGUNDO ENDPOINT
    $cantRestante = "CREATE VIEW IF NOT EXISTS ventas_cantRestante AS
    SELECT a.id, a.nombre_articulo, SUM(v.cantidad_total) AS cantidad_vendida, a.cantidad_articulo
    FROM articulo a
    JOIN venta v ON a.id = v.articulo_id
    GROUP BY a.id, a.nombre_articulo, a.cantidad_articulo";

    // VISTA PARA TERCER ENDPOINT
    $topVentas = "CREATE VIEW IF NOT EXISTS top_ventas AS
    SELECT m.id, m.nombre_marca, COUNT(v.id) AS cantidad_ventas
    FROM marca m
    JOIN articulo a ON m.id = a.marca_id
    JOIN venta v ON a.id = v.articulo_id
    GROUP BY m.id, m.nombre_marca
    ORDER BY cantidad_ventas DESC
    LIMIT 5";

// ERROR EN CASO DE NO PODER ESTABLECER CONEXION CON LA BASE DE DATOS
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}