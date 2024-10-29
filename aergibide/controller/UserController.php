<?php

require_once "model/User.php";

class UserController {
    public $page_title;
    public $view;
    public $model;

    public function __construct(){
        $this->view = "";
        $this->page_title = "";
        $this->model = new User();
    }

    public function register(){
        $this->view = "registro";
        $this->page_title = "Crea tu cuenta";
        $id = $this->model->register();
        if ($id > 0){
            // Redirigir al login después de un registro exitoso
            header('Location: index.php?controller=user&action=login');
            exit(); // Evitar ejecución posterior al redireccionamiento
        }
        return;
    }

    public function login(){
        $this->view = "login";
        if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']){
            $row = $this->model->login();
            if ($row){
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "idUsuario" => $row['idUsuario'],
                    "nombre" => $row['nombre'],
                    "apellido" => $row['apellidos'],
                    "nickname" => $row['nickname'],
                    "tipo" => $row['tipo'],
                    "correo" => $row['correo']
                );
                header('Location: index.php?controller=pregunta&action=list');
                exit();
            } else {
                $this->view = "login";
                return ["error" => "Correo o contraseña incorrectos"];
            }
        }
        header('Location: index.php?controller=pregunta&action=list');
        exit();
    }

    public function logout(){
        // Limpiar la sesión del usuario
        unset($_SESSION['is_logged_in'  ]);
        unset($_SESSION['user_data']);
        session_destroy();
        // Redirigir a la página principal después del logout
        header('Location: index.php');
        exit();
    }
}
