<?php

require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\models\topVentas.php';

class topVentasController{

    private $model;
    
    public function __construct(){
        $this->model = new topVentas();
    }

    public function get(){
        echo json_encode($this->model->obtenerTopVentas());
    }
}