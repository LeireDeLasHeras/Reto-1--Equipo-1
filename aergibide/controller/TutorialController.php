<?php

require_once "model/Tutorial.php";

class TutorialController
{
    public $view;
    public $model;

    // Constructor que inicializa la vista y el modelo de Tutorial
    public function __construct()
    {
        $this->view = "tutorial";
        $this->model = new Tutorial();
    }

    // Listado de tutoriales, filtrados según el parámetro 'tema' si existe
    public function list()
    {
        $this->view = "list";

        // Si existe el parámetro 'tema' en la URL, aplica el filtro correspondiente
        if (isset($_GET['tema'])) {
            if ($_GET['tema'] == 'MasRecientes') {
                $data = [
                    'tutorial' => $this->model->getTutorialesByFecha('DESC'),
                    'guardados' => $this->model->getTutorialesGuardadosUsuario(),
                    'favoritos' => $this->model->getTutorialesFavoritosUsuario(),
                    'favoritosGenerales' => $this->model->getTutorialesFavoritosGenerales()
                ];
            } else if ($_GET['tema'] == 'MasAntiguos') {
                $data = [
                    'tutorial' => $this->model->getTutorialesByFecha('ASC'),
                    'guardados' => $this->model->getTutorialesGuardadosUsuario(),
                    'favoritos' => $this->model->getTutorialesFavoritosUsuario(),
                    'favoritosGenerales' => $this->model->getTutorialesFavoritosGenerales()
                ];
            } else if ($_GET['tema'] == 'MasPopulares') {
                $data = [
                    'tutorial' => $this->model->getTutorialesByLikes(),
                    'guardados' => $this->model->getTutorialesGuardadosUsuario(),
                    'favoritos' => $this->model->getTutorialesFavoritosUsuario(),
                    'favoritosGenerales' => $this->model->getTutorialesFavoritosGenerales()
                ];
            } else {
                $data = [
                    'tutorial' => $this->model->getTutorialesByTema(),
                    'guardados' => $this->model->getTutorialesGuardadosUsuario(),
                    'favoritos' => $this->model->getTutorialesFavoritosUsuario(),
                    'favoritosGenerales' => $this->model->getTutorialesFavoritosGenerales()
                ];
            }
        } else {
            $data = [
                'tutorial' => $this->model->getTutorialesByTema(),
                'guardados' => $this->model->getTutorialesGuardadosUsuario(),
                'favoritos' => $this->model->getTutorialesFavoritosUsuario(),
                'favoritosGenerales' => $this->model->getTutorialesFavoritosGenerales()
            ];
        }
        return $data;
    }

    // Crea un nuevo tutorial
    public function create()
    {
        $this->view = "create";
        return $this->model->crearTutorial();
    }

    // Elimina un tutorial por su ID
    public function delete()
    {
        $this->view = "delete";
        $id = $_GET["id"];
        return $this->model->borrarTutorial($id);
    }

    // Muestra un tutorial específico por su ID
    public function view()
    {
        $this->view = "view";
        $id = $_GET["id"];
        $data = [
            'tutorial' => $this->model->getTutorialById($id),
            'isSaved' => $this->model->isSaved($id),
            'isLiked' => $this->model->isLiked($id)
        ];
        return $data;
    }

    // Guarda un tutorial como favorito para el usuario
    public function save()
    {
        $idTutorial = $_GET['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->save($idUsuario, $idTutorial);
        $response  = [
            'success' => $result
        ];

        return json_encode($response);
    }

    // Elimina un tutorial de los guardados por el usuario
    public function unsave()
    {
        $idTutorial = $_GET['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->unsave($idUsuario, $idTutorial);
        $response  = [
            'success' => $result
        ];

        return json_encode($response);
    }

    // Marca un tutorial con "like"
    public function like()
    {
        $idTutorial = $_POST['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->like($idUsuario, $idTutorial);
        $newLikeCount = $this->model->getLikeCount($idTutorial); // Método que obtendrá el nuevo conteo de likes
        $response  = [
            'success' => $result,
            'newLikeCount' => $newLikeCount
        ];

        return $response;
    }

    // Elimina el "like" de un tutorial
    public function unlike()
    {
        $idTutorial = $_POST['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->unlike($idUsuario, $idTutorial);
        $newLikeCount = $this->model->getLikeCount($idTutorial); // Método que obtendrá el nuevo conteo de likes
        $response  = [
            'success' => $result,
            'newLikeCount' => $newLikeCount
        ];

        return $response;
    }
}
