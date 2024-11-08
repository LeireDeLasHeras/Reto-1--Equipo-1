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

    public function getPreguntasByFecha($order) {
        $sql = "SELECT idPregunta, titulo, descripcion, fecha, nickname, Pregunta.idUsuario FROM Pregunta, Usuario WHERE Pregunta.idUsuario = Usuario.idUsuario ORDER BY fecha $order";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPreguntasByLikes(){
        $sql = "SELECT p.titulo, p.descripcion, p.fecha, u.nickname, pf.idPregunta, pf.idUsuario FROM PreguntasFavoritas pf JOIN Pregunta p ON pf.idPregunta = p.idPregunta JOIN Usuario u ON p.idUsuario = u.idUsuario GROUP BY pf.idPregunta ORDER BY COUNT(pf.idPregunta) DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll();
        return !empty($resultados) ? $resultados : null;
    }

    public function getRespuestasByPreguntaId($idPregunta){
        $sql = "SELECT r.idRespuesta, r.descripcion, r.fecha, u.nickname, r.idUsuario, r.fichero, COUNT(rf.idRespuesta) AS popularidad
                FROM Respuesta r 
                INNER JOIN Usuario u ON r.idUsuario = u.idUsuario 
                LEFT JOIN RespuestasFavoritas rf ON r.idRespuesta = rf.idRespuesta
                WHERE r.idPregunta = ?
                GROUP BY r.idRespuesta
                ORDER BY popularidad DESC, r.fecha DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$idPregunta]);
        return $stmt->fetchAll();
    }

    public function getRespuestasGuardadasUsuario(){
        $sql = "SELECT idRespuesta FROM RespuestasGuardadas WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario']]);
        return $stmt->fetchAll();
    }

    public function getRespuestasFavoritasUsuario(){
        $sql = "SELECT idRespuesta FROM RespuestasFavoritas WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario']]);
        return $stmt->fetchAll();
    }

    public function getPreguntasGuardadasUsuario(){
        $sql = "SELECT idPregunta FROM PreguntasGuardadas WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario']]);
        return $stmt->fetchAll();
    } 

    public function getPreguntasFavoritasUsuario(){
        $sql = "SELECT idPregunta FROM PreguntasFavoritas WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario']]);
        return $stmt->fetchAll();
    }

    public function getPreguntasFavoritasGenerales(){
        $sql = "SELECT idPregunta FROM PreguntasFavoritas";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
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
                    header('Location: index.php?controller=pregunta&action=view&id=' . $this->connection->lastInsertId()    );
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

    

    public function getPreguntasGuardadasByUserId($userId) {
        $sql = "SELECT Pregunta.* 
        FROM PreguntasGuardadas 
        JOIN Pregunta ON PreguntasGuardadas.idPregunta = Pregunta.idPregunta 
        WHERE PreguntasGuardadas.idUsuario = ?
        ";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function isSaved($id){
        $sql = "SELECT * FROM PreguntasGuardadas WHERE idPregunta = ? AND idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id,$_SESSION['user_data']['idUsuario']]);
        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function isLiked($id){
        $sql = "SELECT * FROM PreguntasFavoritas WHERE idPregunta = ? AND idUsuario = ?";  
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id,$_SESSION['user_data']['idUsuario']]);
        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function save($idUsuario, $idPregunta){
        $sql = 'INSERT INTO PreguntasGuardadas (idUsuario, idPregunta) VALUES (?,?)';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idPregunta]);
    }

    public function unsave($idUsuario, $idPregunta){
        $sql = 'DELETE FROM PreguntasGuardadas WHERE idUsuario = ? AND idPregunta = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idPregunta]);
    }

    public function like($idUsuario, $idPregunta) {
        $sql = 'INSERT INTO PreguntasFavoritas (idUsuario, idPregunta) VALUES (?,?)';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idPregunta]);
    } 

    public function unlike($idUsuario, $idPregunta) {
        $sql = 'DELETE FROM PreguntasFavoritas WHERE idUsuario = ? AND idPregunta = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idPregunta]);
    }
}