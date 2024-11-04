<?php
class Pregunta
{
    private $table = "Pregunta";
    private $connection;

    public function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = new Db();
        $this->connection = $dbObj->conection;
    }

    public function getPreguntasByTema()
    {
        if(isset($_GET['tema'])){
            $tema = $_GET['tema'];
            $sql = "SELECT idPregunta, titulo, descripcion, fecha, nickname, Pregunta.idUsuario FROM Pregunta, Usuario WHERE Pregunta.idUsuario = Usuario.idUsuario AND tema = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$tema]);
            return $stmt->fetchAll();
        }else{
            $sql = "SELECT idPregunta, titulo, descripcion, fecha, nickname, Pregunta.idUsuario FROM Pregunta, Usuario WHERE Pregunta.idUsuario = Usuario.idUsuario";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();        
        }
    }

    public function getRespuestasByPreguntaId($idPregunta){
        $sql = "SELECT r.idRespuesta, r.descripcion, r.fecha, u.nickname 
                FROM Respuesta r 
                INNER JOIN Usuario u ON r.idUsuario = u.idUsuario 
                WHERE r.idPregunta = ?
                ORDER BY r.fecha DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$idPregunta]);
        return $stmt->fetchAll();
    }
    
    public function getPreguntaById($id){
        $sql = "SELECT p.*, u.nickname FROM " . $this->table . " p JOIN Usuario u ON p.idUsuario = u.idUsuario WHERE p.idPregunta = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    public function crearPregunta(){
        if(isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['tema'])){
            try {
                $stmt = $this->connection->prepare("INSERT INTO Pregunta (titulo, descripcion, tema, fecha, idUsuario) VALUES (:titulo, :descripcion, :tema, :fecha, :idUsuario)");
                $result = $stmt->execute([
                    ':titulo' => $_POST['titulo'],
                    ':descripcion' => $_POST['descripcion'],    
                    ':tema' => $_POST['tema'],
                    ':fecha' => date('Y-m-d'),
                    ':idUsuario' => $_SESSION['user_data']['idUsuario']
                ]);
                
                if($result) {
                    header('Location: index.php?controller=pregunta&action=list');
                    exit();
                }
                return false;
            } catch(PDOException $e) {
                return false;
            }
        }
        return false;   
    }

    public function getPreguntasByUserId($userId) {
        $sql = "SELECT * FROM Pregunta WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();

    }
    public function borrarPregunta($id){
        if(isset($_POST['delete'])){
            $sql = "DELETE FROM Pregunta WHERE idPregunta = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            header('Location: index.php?controller=pregunta&action=list');
            exit();
        }

    }
}
