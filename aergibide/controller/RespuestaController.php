<?php

require_once "model/Respuesta.php";

class RespuestaController{
    public $view;
    public $model;

    public function __construct(){
        $this->view = "";
        $this->model = new Respuesta();
    }

    

    public function create(){
        $this->view = "create";
        return $this->model->crearRespuesta();
    }
}
