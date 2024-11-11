<?php

require_once "model/User.php";
require_once "model/Pregunta.php";
require_once "model/Tutorial.php";
require_once "model/Guia.php";
require_once "model/Respuesta.php";

class UserController
{
    public $view;
    public $model;

    public function __construct()
    {
        $this->view = "";
        $this->model = new User();
    }

    public function register()
    {
        $this->view = "registro";
        $id = $this->model->register();
        if ($id > 0) {
            // Redirigir al login después de un registro exitoso
            header('Location: index.php?controller=user&action=login');
            exit(); // Evitar ejecución posterior al redireccionamiento
        }
        return;
    }

    public function login()
    {
        $this->view = "login";
        if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
            $row = $this->model->login();
            if ($row) {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "idUsuario" => $row['idUsuario'],
                    "nombre" => $row['nombre'],
                    "apellido" => $row['apellido'],
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
    public function edit()
    {
        $this->view = "edit";

        if (isset($_GET["idUsuario"])) {
            $idUsuario = $_GET["idUsuario"];
            return $this->model->getUserById($idUsuario);
        }

        return null; // O manejar el caso donde no se proporciona un idUsuario
    }

    public function update()
    {
        $this->view = 'edit';

        $idUsuario = $this->model->update($_POST);
        $result = $this->model->getUserById($idUsuario);
        $_GET["response"] = true;

        return $result;
    }
    public function publicaciones()
    {
        $this->view = 'publicaciones';

        $userId = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : $_SESSION['user_data']['idUsuario'];

        $usuario = $this->model->getUserById($userId);

        $preguntaModel = new Pregunta();
        $guiaModel = new Guia();
        $tutorialModel = new Tutorial();
        $respuestaModel = new Respuesta();

        $preguntasPublicadas = $preguntaModel->getPreguntasByUserId($userId);
        $guiasPublicadas = $guiaModel->getGuiasByUserId($userId);
        $tutorialesPublicados = $tutorialModel->getTutorialesByUserId($userId);
        $respuestasPublicadas = $respuestaModel->getRespuestasByUserId($userId);

        return [
            'preguntas' => $preguntasPublicadas,
            'guias' => $guiasPublicadas,
            'tutoriales' => $tutorialesPublicados,
            'respuestas'=> $respuestasPublicadas,
            'usuario' => $usuario
        ];
    }

    public function guardadas()
    {
        $this->view = 'guardadas';
        $userId = $_SESSION['user_data']['idUsuario'];
        $preguntaModel = new Pregunta();
        $guiaModel = new Guia();
        $tutorialModel = new Tutorial();
        $respuestaModel = new Respuesta();

        $preguntasGuardadas = $preguntaModel->getPreguntasGuardadasByUserId($userId);
        $guiasGuardadas = $guiaModel->getGuiasGuardadasByUserId($userId);
        $tutorialesGuardados = $tutorialModel->getTutorialesGuardadosByUserId($userId);
        $respuestasGuardadas = $respuestaModel->getRespuestasGuardadasByUserId($userId);


        return [
            'preguntas' => $preguntasGuardadas,
            'guias' => $guiasGuardadas,
            'tutoriales' => $tutorialesGuardados,
            'respuestas' => $respuestasGuardadas,
        ];
    }
    public function list()
    {
        $this->view = 'list';
        return $this->model->getUsuarios();
    }

    public function admin(){
        $id = $_GET["id"];
        return $this->model->hacerAdmin($id);
    }

    public function normal(){
        $id = $_GET["id"];
        return $this->model->hacerNormal($id);
    }
    public function delete(){
        $this->view= "delete";
        $id = $_GET["id"];
        return $this->model->borrarUsuario($id);
    }

    public function logout()
    {
        // Limpiar la sesión del usuario
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        // Redirigir a la página principal después del logout
        header('Location: index.php');
        exit();
    }
}
