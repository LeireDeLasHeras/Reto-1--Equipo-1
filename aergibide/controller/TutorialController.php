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
        if(isset($_GET['tema'])){
            if($_GET['tema'] == 'MasRecientes'){
                return $this->model->getTutorialesByFecha('DESC');
            }
            else if($_GET['tema'] == 'MasAntiguos'){
                return $this->model->getTutorialesByFecha('ASC'); 
            }
        }
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

    public function view(){
        $this->view= "view";
        $id = $_GET["id"];
        return $this->model->getTutorialById($id);
    }
    
}
