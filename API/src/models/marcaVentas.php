<?php

require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\db\database.php';

// PRIMER ENDPOINT SELECCIONA MARCA CON MINIMO 1 VENTA
class marcaVentas {
    private $db;
    public function __construct(){
        $this->db = Database::connect();
    }

    public function obtenerMarcaVentas(){
        $stmt = $this->db->query("SELECT * FROM marcas_ventas");
        return $stmt->fetchAll();
    }
}