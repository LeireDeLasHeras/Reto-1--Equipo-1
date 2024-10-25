<?php

require_once "model/User.php";

class UserController {
    public $view;
    public $model;

    public function __construct(){
        $this->view= "";
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
        if (!isset($_SESSION['is_logged_in'])||!$_SESSION['is_logged_in']){
            $row=$this->model->login();
            if ($row){
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "idUsuario" => $row['idUsuario'],
                    "nombre" => $row['nombre'],
                    "apellido" => $row['apellidos'],
                    "nickname" => $row['nickname'],
                    "contrasena" => $row['contrasena'],
                    "tipo" => $row['tipo'],
                    "correo" => $row['correo']
                );
            }else{
                $_SESSION['is_logged_in']=false;
                return;
            }
        }
    }

    public function logout(){
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        header('Location: index.php');
    }
}

