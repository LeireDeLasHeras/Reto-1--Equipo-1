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
        return $this->model->getPreguntasByTema();
    }

    public function view() {
        $this->view = "view";
        $id = $_GET["id"];
        
        $data = [
            'pregunta' => $this->model->getPreguntaById($id),
            'respuestas' => $this->model->getRespuestasByPreguntaId($id)
        ];
        
        return $data;
    }

    public function create(){
        $this->view= "create";
        return $this->model->crearPregunta();
    }

    public function delete(){
        $this->view= "delete";
        $id = $_GET["id"];
        return $this->model->borrarPregunta($id);
    }
}

