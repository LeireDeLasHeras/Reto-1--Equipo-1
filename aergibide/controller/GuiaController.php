<?php

require_once "model/Guia.php";

class GuiaController {
    public $view;
    public $model;

    public function __construct(){
        $this->view = "";
        $this->model = new Guia();
    }

    public function list(){
        $this->view = "list";
    }
}
