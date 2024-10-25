<?php

require_once "model/Pregunta.php";

class PreguntaController {
    public $page_title;
    public $view;
    public $model;

    public function __construct(){
        $this->view= "";
        $this->page_title= "";
        $this->model= new Pregunta();
    }
    public function list(){
        $this->view= "list";
        return $this->model->getAllPreguntas();
    }
    //index.php?controller=pregunta&action=view&id=8
    public function view(): mixed{
        $this->view= "view";
        $id = $_GET["id"];
        return $this->model->getPreguntaById($id);
    }

}

