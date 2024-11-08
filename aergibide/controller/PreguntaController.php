<?php
require_once "model/Pregunta.php";

class PreguntaController {
    public $view;
    public $model;

    public function __construct(){
        $this->view= "";
        $this->model= new Pregunta();
    }

    public function list(){
        $this->view= "list"; 
      
        if(isset($_GET['tema'])){
            if($_GET['tema'] == 'MasRecientes'){
                $data = [
                    'pregunta' => $this->model->getPreguntasByFecha('DESC'),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            }
            else if($_GET['tema'] == 'MasAntiguos'){
                $data = [
                    'pregunta' => $this->model->getPreguntasByFecha('ASC'),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            }
            else if($_GET['tema'] == 'MasPopulares'){
                $data = [
                    'pregunta' => $this->model->getPreguntasByLikes(),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            }
            else {
                $data = [
                    'pregunta' => $this->model->getPreguntasByTema(),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            }
        } else {
            $data = [
                'pregunta' => $this->model->getPreguntasByTema(),
                'guardadas' => $this->model->getPreguntasGuardadasUsuario(),
                'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
            ];
        }
        return $data;
    }

    public function view() {
        $this->view = "view";
        $id = $_GET["id"];
        
        $data = [
            'pregunta' => $this->model->getPreguntaById($id),
            'isSaved' => $this->model->isSaved($id),
            'isLiked' => $this->model->isLiked($id),
            'respuestasGuardadas' => $this->model->getRespuestasGuardadasUsuario(),
            'respuestasFavoritas' => $this->model->getRespuestasFavoritasUsuario(),
            'respuestas' => $this->model->getRespuestasByPreguntaId($id)
        ];
        
        return $data;
    }

    public function create(){
        $this->view= "create";
        return $this->model->crearPregunta();
    }

    public function delete(){
        $this->view= "delete";
        $id = $_GET["id"];
        return $this->model->borrarPregunta($id);
    }

    public function save() {
        $idPregunta = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this -> model -> save($idUsuario, $idPregunta);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }

    public function unsave(){
        $idPregunta = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this -> model -> unsave($idUsuario, $idPregunta);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }

    public function like(){
        $idPregunta = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this -> model -> like($idUsuario, $idPregunta);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }

    public function unlike(){
        $idPregunta = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this -> model -> unlike($idUsuario, $idPregunta);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }
}