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
        $this->view = "list";
    }
    
}
