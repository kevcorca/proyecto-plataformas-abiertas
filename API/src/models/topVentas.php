<?php

require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\db\database.php';

// TERCER ENDPOINT SELECCIONA LAS TOP 5 MARCAS
class topVentas {
    private $db;
    public function __construct(){
        $this->db = Database::connect();
    }

    public function obtenerTopVentas(){
        $stmt = $this->db->query("SELECT * FROM top_ventas");
        return $stmt->fetchAll();
    }
}