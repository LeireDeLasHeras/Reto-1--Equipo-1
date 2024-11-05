<?php

require_once "model/Tutorial.php";

class TutorialController {
    public $view;
    public $model;

    public function __construct(){
        $this->view = "";
        $this->model = new Tutorial();
    }
    public function list(){
        $this->view= "list";
        return $this->model->getTutorialesByTema();
    }
    public function create(){
        $this->view= "create";
        return ;
    }
    public function save(){
        $this->view= "create";
        return $this->model->crearTutorial();
    }
    public function delete(){
        $this->view= "delete";
        $id = $_GET["id"];
        return $this->model->borrarTutorial($id);
    }
    
}
