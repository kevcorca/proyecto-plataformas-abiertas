<?php

require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\db\database.php';

// SEGUNDO ENDPOINT SELECCIONA CANTIDAD VENDIDA Y CANTIDAD RESTANTE EN STOCK
class cantRestante {
    private $db;
    public function __construct(){
        $this->db = Database::connect();
    }

    public function obtenerCantRestante(){
        $stmt = $this->db->query("SELECT * FROM ventas_cantRestante");
        return $stmt->fetchAll();
    }
}