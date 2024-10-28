<?php

require_once "model/Pregunta.php";

class PreguntaController {
    public $view;
    public $model;

    public function __construct(){
        $this->view= "";
        $this->model= new Pregunta();
    }

    public function list(){
        $this->view= "list";
        return $this->model->getAllPreguntas();
    }

    public function view() {
        $this->view= "view";
        $id = $_GET["id"];
        return $this->model->getPreguntaById($id);
    }

    public function create(){
        $this->view= "create";
        return $this->model->crearPregunta();
    }

}

