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

    // Constructor que inicializa la vista y el modelo de Usuario
    public function __construct()
    {
        $this->view = "";
        $this->model = new User();
    }

    // Registro de un nuevo usuario
    public function register()
    {
        $this->view = "registro";
        $id = $this->model->register();
        if ($id > 0) {
            // Redirige al login después de un registro exitoso
            header('Location: index.php?controller=user&action=login');
            exit(); // Evita ejecución posterior al redireccionamiento
        }
        return;
    }

    // Login de un usuario, verifica las credenciales y crea la sesión
    public function login()
    {
        $this->view = "login";
        // Si no está logueado, realiza el login
        if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
            $row = $this->model->login();
            if ($row) {
                // Inicia sesión y redirige a la lista de preguntas
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
                // Si el login falla, muestra un mensaje de error
                $this->view = "login";
                return ["error" => "Correo o contraseña incorrectos"];
            }
        }
        // Si ya está logueado, lo redirige automáticamente
        header('Location: index.php?controller=pregunta&action=list');
        exit();
    }

    // Edita los datos de un usuario, obtiene la información por ID
    public function edit()
    {
        $this->view = "edit";

        // Si se proporciona un idUsuario, muestra los datos del usuario
        if (isset($_GET["idUsuario"])) {
            $idUsuario = $_GET["idUsuario"];
            return $this->model->getUserById($idUsuario);
        }

        return null; // Retorna null si no se pasa un idUsuario
    }

    // Actualiza la información de un usuario
    public function update()
    {
        $this->view = 'edit';

        // Llama al método de actualización y obtiene el usuario actualizado
        $idUsuario = $this->model->update($_POST);
        $result = $this->model->getUserById($idUsuario);
        $_GET["response"] = true;

        return $result;
    }

    // Muestra las publicaciones de un usuario
    public function publicaciones()
    {
        $this->view = 'publicaciones';

        // Obtiene el ID del usuario desde la URL o de la sesión
        $userId = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : $_SESSION['user_data']['idUsuario'];

        $usuario = $this->model->getUserById($userId);

        // Crea instancias de los modelos para obtener las publicaciones del usuario
        $preguntaModel = new Pregunta();
        $guiaModel = new Guia();
        $tutorialModel = new Tutorial();
        $respuestaModel = new Respuesta();

        // Obtiene las preguntas, guías, tutoriales y respuestas publicadas por el usuario
        $preguntasPublicadas = $preguntaModel->getPreguntasByUserId($userId);
        $guiasPublicadas = $guiaModel->getGuiasByUserId($userId);
        $tutorialesPublicados = $tutorialModel->getTutorialesByUserId($userId);
        $respuestasPublicadas = $respuestaModel->getRespuestasByUserId($userId);

        return [
            'preguntas' => $preguntasPublicadas,
            'guias' => $guiasPublicadas,
            'tutoriales' => $tutorialesPublicados,
            'respuestas' => $respuestasPublicadas,
            'usuario' => $usuario
        ];
    }

    // Muestra las publicaciones guardadas por el usuario
    public function guardadas()
    {
        $this->view = 'guardadas';
        $userId = $_SESSION['user_data']['idUsuario'];

        // Obtiene las publicaciones guardadas por el usuario
        $preguntaModel = new Pregunta();
        $guiaModel = new Guia();
        $tutorialModel = new Tutorial();
        $respuestaModel = new Respuesta();

        // Obtiene las preguntas, guías, tutoriales y respuestas guardadas
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

    // Lista todos los usuarios
    public function list()
    {
        $this->view = 'list';
        return $this->model->getUsuarios();
    }

    // Asigna el rol de administrador a un usuario
    public function admin()
    {
        $id = $_GET["id"];
        return $this->model->hacerAdmin($id);
    }

    // Asigna el rol de usuario normal a un usuario
    public function normal()
    {
        $id = $_GET["id"];
        return $this->model->hacerNormal($id);
    }

    // Elimina un usuario por su ID
    public function delete()
    {
        $this->view = "delete";
        $id = $_GET["id"];
        return $this->model->borrarUsuario($id);
    }

    // Cierra la sesión del usuario y lo redirige a la página principal
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
