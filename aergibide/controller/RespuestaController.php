<?php

require_once "model/Respuesta.php";

class RespuestaController
{
    public $view;
    public $model;

    // Inicializa la vista y el modelo de Respuesta.
    public function __construct()
    {
        $this->view = "";
        $this->model = new Respuesta();
    }

    // Crea una nueva respuesta con posible archivo adjunto.
    public function create()
    {
        $this->view = "create";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filePath = null;

            // Maneja la subida de archivos.
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

            // Recibe y procesa los datos del formulario.
            $param = $_POST;
            $param['file_path'] = $filePath;
            $id = $this->model->crearRespuesta($param);

            $_GET["response"] = $id ? true : false;
            return $id;
        }
    }

    // Elimina una respuesta específica.
    public function delete()
    {
        $this->view = "delete";
        $idRespuesta = $_GET["idRespuesta"];
        $idPregunta = $_GET["idPregunta"];
        return $this->model->borrarRespuesta($idRespuesta, $idPregunta);
    }

    // Guarda una respuesta como favorita para el usuario.
    public function save()
    {
        $idRespuesta = $_GET['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->save($idUsuario, $idRespuesta);
        return json_encode(['success' => $result]);
    }

    // Elimina una respuesta de las guardadas del usuario.
    public function unsave()
    {
        $idRespuesta = $_GET['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->unsave($idUsuario, $idRespuesta);
        return json_encode(['success' => $result]);
    }

    // Marca una respuesta con "like".
    public function like()
    {
        $idRespuesta = $_POST['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->like($idUsuario, $idRespuesta);
        return ['success' => $result];
    }

    // Elimina el "like" de una respuesta.
    public function unlike()
    {
        $idRespuesta = $_POST['id'];
        $idUsuario = $_SESSION['user_data']['idUsuario'];

        $result = $this->model->unlike($idUsuario, $idRespuesta);
        return ['success' => $result];
    }
}
