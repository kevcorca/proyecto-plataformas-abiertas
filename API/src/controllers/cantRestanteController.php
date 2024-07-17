<?php

require_once 'C:\xampp\htdocs\plataformas-abiertas-proyecto\API\src\models\cantRestante.php';

class cantRestanteController{

    private $model;
    
    public function __construct(){
        $this->model = new cantRestante();
    }

    public function get(){
        echo json_encode($this->model->obtenerCantRestante());
    }
}