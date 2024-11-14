<?php
require_once "model/Pregunta.php";

class PreguntaController
{
    public $view;
    public $model;

    // Constructor que inicializa la vista y el modelo.
    public function __construct()
    {
        $this->view = "";
        $this->model = new Pregunta();
    }

    // Función que lista las preguntas según el filtro de tema.
    public function list()
    {
        $this->view = "list";

        if (isset($_GET['tema'])) {
            if ($_GET['tema'] == 'MasRecientes') {
                $data = [
                    'pregunta' => $this->model->getPreguntasByFecha('DESC'),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            } else if ($_GET['tema'] == 'MasAntiguos') {
                $data = [
                    'pregunta' => $this->model->getPreguntasByFecha('ASC'),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            } else if ($_GET['tema'] == 'MasPopulares') {
                $data = [
                    'pregunta' => $this->model->getPreguntasByLikes(),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            } else {
                $data = [
                    'pregunta' => $this->model->getPreguntasByTema(),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            }
        } else {
            // Si no se especifica un tema, se muestra por defecto según el tema general
            $data = [
                'pregunta' => $this->model->getPreguntasByTema(),
                'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
            ];
        }
        return $data;
    }

    // Función que muestra los detalles de una pregunta específica.
    public function view()
    {
        $this->view = "view";
        $id = $_GET["id"];

        $data = [
            'pregunta' => $this->model->getPreguntaById($id),
            'isSaved' => $this->model->isSaved($id),
            'isLiked' => $this->model->isLiked($id),
        ];

        return $data;
    }

    // Función que crea una nueva pregunta.
    public function create()
    {
        $this->view = "create";
        return $this->model->crearPregunta();
    }

    // Función que elimina una pregunta.
    public function delete()
    {
        $this->view = "delete";
        $id = $_GET["id"];
        return $this->model->borrarPregunta($id);
    }

    // Función que guarda una pregunta como favorita para un usuario.
    public function save()
    {
        $idPregunta = $_GET['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->save($idUsuario, $idPregunta);
        $response  = [
            'success' => $result
        ];

        return json_encode($response);
    }

    // Función que elimina una pregunta de las guardadas de un usuario.
    public function unsave()
    {
        $idPregunta = $_GET['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->unsave($idUsuario, $idPregunta);
        $response  = [
            'success' => $result
        ];

        return json_encode($response);
    }

    // Función que marca una pregunta como "like" para un usuario.
    public function like()
    {
        $idPregunta = $_POST['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->like($idUsuario, $idPregunta);
        $newLikeCount = $this->model->getLikeCount($idPregunta); // Método que obtendrá el nuevo conteo de likes
        $response = [
            'success' => $result,
            'newLikeCount' => $newLikeCount
        ];

        return $response;
    }

    // Función que elimina el "like" de una pregunta.
    public function unlike()
    {
        $idPregunta = $_POST['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->unlike($idUsuario, $idPregunta);
        $newLikeCount = $this->model->getLikeCount($idPregunta); // Método que obtendrá el nuevo conteo de likes
        $response = [
            'success' => $result,
            'newLikeCount' => $newLikeCount
        ];

        return $response;
    }
}
