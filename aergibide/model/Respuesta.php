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

    public function crearRespuesta(){
        if(isset($_POST['respuesta'])){
            try {
                $stmt = $this->connection->prepare("INSERT INTO Respuesta (fecha, descripcion, idUsuario, idPregunta) VALUES (:fecha, :descripcion, :idUsuario, :idPregunta)");
                $result = $stmt->execute([
                    ':fecha' => date('Y-m-d'), 
                    ':descripcion' => $_POST['respuesta'],
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