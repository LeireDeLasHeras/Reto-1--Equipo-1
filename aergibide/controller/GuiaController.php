<?php
require_once "model/Guia.php";

class GuiaController { 
    public $view;
    public $model;

    public function __construct(){
        $this->view = "";
        $this->model = new Guia();
    }

    public function list(){
        $this->view = "list";

        if(isset($_GET['tema'])){
            if($_GET['tema'] == 'MasRecientes'){
                $data = [
                    'guia' => $this->model->getGuiasByFecha('DESC'),
                    'guardadas' => $this->model->getGuiasGuardadasUsuario(),
                    'favoritas' => $this->model->getGuiasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getGuiasFavoritasGenerales()
                ];
            } else if($_GET['tema'] == 'MasAntiguos'){
                $data = [
                    'guia' => $this->model->getGuiasByFecha('ASC'),
                    'guardadas' => $this->model->getGuiasGuardadasUsuario(),
                    'favoritas' => $this->model->getGuiasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getGuiasFavoritasGenerales()
                ];
            } else if($_GET['tema'] == 'MasPopulares'){
                $data = [
                    'guia' => $this->model->getGuiasByLikes(),
                    'guardadas' => $this->model->getGuiasGuardadasUsuario(),
                    'favoritas' => $this->model->getGuiasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getGuiasFavoritasGenerales()
                ];
            } else {
                $data = [
                    'guia' => $this->model->getGuiasByTema(),
                    'guardadas' => $this->model->getGuiasGuardadasUsuario(),
                    'favoritas' => $this->model->getGuiasFavoritasUsuario(),
                    'favoritasGenerales' => $this->model->getGuiasFavoritasGenerales()
                ];
            }
        } else {
            $data = [
                'guia' => $this->model->getGuiasByTema(),
                'guardadas' => $this->model->getGuiasGuardadasUsuario(),
                'favoritas' => $this->model->getGuiasFavoritasUsuario(),
                'favoritasGenerales' => $this->model->getGuiasFavoritasGenerales()
            ];
        }
        return $data;
    }

    public function view() {
        $this->view= "view";
        $id = $_GET["id"];
        
        $data = [   
            'guia' => $this->model->getGuiaById($id),
            'isSaved' => $this->model->isSaved($id),
            'isLiked' => $this->model->isLiked($id)
        ];
        return $data;
    }

    public function create() {
        $this->view = "create";
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filePath = null;
            if (isset($_FILES['archivos']) && $_FILES['archivos']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['archivos']['tmp_name'];
                $fileName = $_FILES['archivos']['name'];
                $uploadFileDir = './uploads/guias/pdf/';
                $destPath = $uploadFileDir . $fileName;
            
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $filePath = $destPath;
                } else {
                    $_GET["response"] = false;
                    return;
                }
            }
        
            $param = $_POST;
            $param['file_path'] = $filePath;
        
            $id = $this->model->crearGuia($param);
        
            if ($id) {
                $_GET["response"] = true;
            } else {
                $_GET["response"] = false;
            }
        
            return $id;
        } else {
            return;
        }
    }

    public function delete(){
        $this->view = "delete";
        $id = $_GET["id"];
        return $this->model->borrarGuia($id);
    }

    public function save() {
        $idGuia = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->save($idUsuario, $idGuia);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }

    public function unsave(){
        $idGuia = $_GET['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->unsave($idUsuario, $idGuia);
        $response  = [
            'success' => $result
        ];  

        return json_encode($response);
    }

    public function like() {
        $idGuia = $_POST['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];
    
        $result = $this->model->like($idUsuario, $idGuia);
        $newLikeCount = $this->model->getLikeCount($idGuia); // Método para obtener el conteo actualizado
        $response = [
            'success' => $result,
            'newLikeCount' => $newLikeCount
        ];  
    
        return $response;
    }
    
    public function unlike() {
        $idGuia = $_POST['id'];    
        $idUsuario = $_SESSION['user_data']['idUsuario'];
    
        $result = $this->model->unlike($idUsuario, $idGuia);
        $newLikeCount = $this->model->getLikeCount($idGuia); // Método para obtener el conteo actualizado
        $response = [
            'success' => $result,
            'newLikeCount' => $newLikeCount
        ];  
    
        return $response;
    }

}
