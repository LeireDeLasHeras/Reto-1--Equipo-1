<?php

class Respuesta{
    private $table = "Respuesta";
    private $connection;

    public function __construct(){
        $this->getConection();
    }

    public function getConection(){
        $dbObj = new Db();
        $this->connection = $dbObj->conection;
    }

        public function crearRespuesta($param){
            $respuesta = isset($param['respuesta']) ? $param['respuesta'] : '';
            $filePath = isset($param['file_path']) ? $param['file_path'] : ''; 

        if(isset($_POST['respuesta'])){
            try {
                $stmt = $this->connection->prepare("INSERT INTO Respuesta (fecha, descripcion, fichero, idUsuario, idPregunta) VALUES (:fecha, :descripcion, :fichero, :idUsuario, :idPregunta)");
                $result = $stmt->execute([
                    ':fecha' => date('Y-m-d'), 
                    ':descripcion' => $_POST['respuesta'],
                    ':fichero' => $filePath,
                    ':idUsuario' => $_SESSION['user_data']['idUsuario'],
                    ':idPregunta' => $_GET['id']
                ]);
                
                if($result) {
                    header('Location: index.php?controller=pregunta&action=view&id=' . $_GET['id']);
                    exit();
                }
                return false;
            } catch(PDOException $e) {
                return false;
            }
        }
        return false;
    }
}