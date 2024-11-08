<?php

require_once "model/Respuesta.php";

class RespuestaController{
    public $view;
    public $model;

    public function __construct(){
        $this->view = "";
        $this->model = new Respuesta();
    }

    

    public function create(){
        $this->view = "create";
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filePath = null;
          
            if (isset($_FILES['archivos']) && $_FILES['archivos']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['archivos']['tmp_name'];
                $fileName = $_FILES['archivos']['name'];
                $uploadFileDir = './uploads/respuestas/pdf/';
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
            $id = $this->model->crearRespuesta($param);
    
            if ($id) {
                $_GET["response"] = true;
            } else {
                $_GET["response"] = false;
            }
            return $id;
        }
    }
    
}
