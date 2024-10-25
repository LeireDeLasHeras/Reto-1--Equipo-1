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
    //index.php?controller=pregunta&action=view&id=8
    public function view() {
        $this->view= "view";
        $id = $_GET["id"];
        return $this->model->getPreguntaById($id);
    }

}

