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
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario()
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            }
            else if($_GET['tema'] == 'MasAntiguos'){
                $data = [
                    'pregunta' => $this->model->getPreguntasByFecha('ASC'),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario()
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            }
            else {
                $data = [
                    'pregunta' => $this->model->getPreguntasByTema(),
                    'guardadas' => $this->model->getPreguntasGuardadasUsuario()
                    'favoritas' => $this->model->getPreguntasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getPreguntasFavoritasGenerales()
                ];
            }
        } else {
            $data = [
                'pregunta' => $this->model->getPreguntasByTema(),
                'guardadas' => $this->model->getPreguntasGuardadasUsuario()
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

    public function save(){
        $id = $_GET["id"];
        return $this->model->guardarPregunta($id);
    }

    public function unsave(){
        $id = $_GET["id"];
        return $this->model->borrarGuardada($id);
    }

    public function like(){
        $id = $_GET["id"];
        return $this->model->like($id);
    }

    public function unlike(){
        $id = $_GET["id"];
        return $this->model->unlike($id);
    }
}