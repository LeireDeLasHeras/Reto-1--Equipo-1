<?php

require_once "model/User.php";

class UserController {
    public $page_title;
    public $view;
    public $model;

    public function __construct(){
        $this->view= "";
        $this->page_title= "";
        $this->model= new User();
    }

    public function register(){
        $this->view= "registro";
        $this->page_title = "Crea tu cuenta";
        $id=$this->model->register();
        if ($id>0){
            header('Location: index.php?controller=user&action=login');
        }
        return;
    }
    public function login(){
        $this->view= "login";
        $this->page_title = "Accede a tu cuenta";
        if (!isset($_SESSION['is_logged_in'])||!$_SESSION['is_logged_in']){
            $row=$this->model->login();
            if ($row){
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "email" => $row['email']
                );
                header('Location: index.php');
            }else{
                $_SESSION['is_logged_in']=false;
                return;
            }
        }
        header('Location: index.php');
    }

    public function logout(){
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        header('Location: index.php');
    }
}

