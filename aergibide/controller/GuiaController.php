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
        $this->view= "list";
        return $this->model->getAllGuias();
    }

    public function view() {
        $this->view= "view";
        $id = $_GET["id"];
        return $this->model->getGuiaById($id);
    }

    public function create() {
        $this->view = "create";
    
        $filePath = null;
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $uploadFileDir = './archivos/pdf';
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
    }
    
    
}
