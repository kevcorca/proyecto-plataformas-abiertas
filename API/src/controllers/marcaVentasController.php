<?php

require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\models\marcaVentas.php';

class marcaVentasController{

    private $model;
    
    public function __construct(){
        $this->model = new marcaVentas();
    }

    public function get(){
        echo json_encode($this->model->obtenerMarcaVentas());
    }
}