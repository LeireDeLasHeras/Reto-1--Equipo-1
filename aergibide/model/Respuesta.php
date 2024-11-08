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

        if (isset($param['respuesta'])) {
            try {
                $stmt = $this->connection->prepare("INSERT INTO Respuesta (fecha, descripcion, fichero, idUsuario, idPregunta) VALUES (:fecha, :descripcion, :fichero, :idUsuario, :idPregunta)");
    
                $result = $stmt->execute([
                    ':fecha' => date('Y-m-d'),
                    ':descripcion' => $respuesta,
                    ':fichero' => $param['file_path'], 
                    ':idUsuario' => $_SESSION['user_data']['idUsuario'],
                    ':idPregunta' => $_GET['id']
                ]);
    
                if ($result) {
                    header('Location: index.php?controller=pregunta&action=view&id=' . $_GET['id']);
                    exit();
                }
                return false;
            } catch (PDOException $e) {
                echo "Error en la base de datos: " . $e->getMessage(); 
                return false;
            }
        }
        return false;
    }
    
    public function borrarRespuesta($idRespuesta, $idPregunta){
        if(isset($_POST['delete'])){
            $sql = "DELETE FROM Respuesta WHERE idRespuesta = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$idRespuesta]);
            header('Location: index.php?controller=pregunta&action=view&id=' . $idPregunta);
            exit();
        }
    }

    public function isSaved($id){
        $sql = "SELECT * FROM RespuestasGuardadas WHERE idRespuesta = ? AND idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id,$_SESSION['user_data']['idUsuario']]);
        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function isLiked($id){
        $sql = "SELECT * FROM RespuestasFavoritas WHERE idRespuesta = ? AND idUsuario = ?";  
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id,$_SESSION['user_data']['idUsuario']]);
        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function save($idUsuario, $idRespuesta){
        $sql = 'INSERT INTO RespuestasGuardadas (idUsuario, idRespuesta) VALUES (?,?)';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idRespuesta]);
    }

    public function unsave($idUsuario, $idRespuesta){
        $sql = 'DELETE FROM RespuestasGuardadas WHERE idUsuario = ? AND idRespuesta = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idRespuesta]);
    }

    public function like($idUsuario, $idRespuesta) {
        $sql = 'INSERT INTO RespuestasFavoritas (idUsuario, idRespuesta) VALUES (?,?)';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idRespuesta]);
    } 

    public function unlike($idUsuario, $idRespuesta) {
        $sql = 'DELETE FROM RespuestasFavoritas WHERE idUsuario = ? AND idRespuesta = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idRespuesta]);
    }
}