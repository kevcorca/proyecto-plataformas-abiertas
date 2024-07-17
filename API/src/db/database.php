<?php

class Database {
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo === null) {
            $host = 'localhost';
            $db   = 'tiendaropa';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$pdo = new PDO($dsn, $user, $pass, $options);
                
                // CREA VIEWS SI NO EXOISTEN
                self::createViews();

            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$pdo;
    }

    private static function createViews() {
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

        try {
            $pdo = self::connect();

            // CREAR VISTAS
            $pdo->exec($marcaVentas);
            $pdo->exec($cantRestante);
            $pdo->exec($topVentas);

        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}