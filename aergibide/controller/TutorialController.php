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
        return $this->model->getAlltutoriales();
    }

    public function view() {
        $this->view= "view";
        $id = $_GET["id"];
        return $this->model->getTutorialById($id);
    }
    
}