<?php

require_once "model/Tutorial.php";

class TutorialController {
    public $view;
    public $model;

    public function __construct(){
        $this->view = "tutorial";
        $this->model = new Tutorial();
    }
    public function list(){
        $this->view= "list";

        if(isset($_GET['tema'])){
            if($_GET['tema'] == 'MasRecientes'){
                $data = [
                    'tutorial' => $this->model->getTutorialesByFecha('DESC'),
                    'guardados' => $this->model->getTutorialesGuardadosUsuario(),
                    'favoritos' => $this->model->getTutorialesFavoritosUsuario(),
                    'favoritosGenerales' => $this->model->getTutorialesFavoritosGenerales()
                ];
            }
            else if($_GET['tema'] == 'MasAntiguos'){
                $data = [
                    'tutorial' => $this->model->getTutorialesByFecha('ASC'),
                    'guardados' => $this->model->getTutorialesGuardadosUsuario(),
                    'favoritos' => $this->model->getTutorialesFavoritosUsuario(),
                    'favoritosGenerales' => $this->model->getTutorialesFavoritosGenerales()
                ];
            }
            else if($_GET['tema'] == 'MasPopulares'){
                $data = [
                    'tutorial' => $this->model->getTutorialesByLikes(),
                    'guardados' => $this->model->getTutorialesGuardadosUsuario(),
                    'favoritos' => $this->model->getTutorialesFavoritosUsuario(),
                    'favoritosGenerales' => $this->model->getTutorialesFavoritosGenerales()
                ];
            }
            else {
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
   
    public function create(){
        $this->view= "create";
        return $this->model->crearTutorial();
    }
    public function delete(){
        $this->view= "delete";
        $id = $_GET["id"];
        return $this->model->borrarTutorial($id);
    }

    public function view(){
        $this->view= "view";
        $id = $_GET["id"];
        $data = [
            'tutorial' => $this->model->getTutorialById($id),
            'isSaved' => $this->model->isSaved($id),
            'isLiked' => $this->model->isLiked($id)
        ];
        return $data;
    }

    
    public function save() {
        $idTutorial = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this -> model -> save($idUsuario, $idTutorial);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }

    public function unsave(){
        $idTutorial = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this -> model -> unsave($idUsuario, $idTutorial);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }

    public function like(){
        $idTutorial = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this -> model -> like($idUsuario, $idTutorial);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }

    public function unlike(){
        $idTutorial = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this -> model -> unlike($idUsuario, $idTutorial);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }
}
