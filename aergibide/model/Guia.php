<?php

class Guia
{
    private $table = "Guia";
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
    public function getAllGuias()
    {

        $sql = "SELECT titulo, descripcion, fecha, tema, nickname, fichero, Guia.idUsuario, Guia.idGuia FROM Guia, Usuario WHERE Guia.idUsuario = Usuario.idUsuario";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getGuiaById($id){
        $sql = "SELECT titulo, descripcion, fecha, tema, nickname, fichero, Guia.idUsuario, Guia.idGuia FROM Guia, Usuario WHERE Guia.idUsuario = Usuario.idUsuario AND Guia.idGuia = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function crearGuia($param) {
     
        $titulo = isset($param['titulo']) ? $param['titulo'] : '';
        $descripcion = isset($param['descripcion']) ? $param['descripcion'] : '';
        $tema = isset($param['tema']) ? $param['tema'] : '';
        $filePath = isset($param['file_path']) ? $param['file_path'] : '';

        $idUsuario = $_SESSION['user_data']['idUsuario'];
   
        try {
            $sql = "INSERT INTO Guia (titulo, descripcion, fecha, tema, idUsuario, fichero) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
    
            $fechaActual = date('Y-m-d');
            $stmt->execute([$titulo, $descripcion, $fechaActual, $tema, $idUsuario, $filePath]);
    
            $id = $this->connection->lastInsertId();
    
            return $id; 
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();  
        }
    }
    public function getGuiasByUserId($userId) {
        $sql = "SELECT * FROM Guia WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getGuiasGuardadasByUserId($userId) {
        $sql = "SELECT Guia.* 
        FROM GuiasGuardadas 
        JOIN Guia ON GuiasGuardadas.idGuia = Guia.idGuia
        WHERE GuiasGuardadas.idUsuario = ?
        ";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();

    }
    public function borrarGuia($id){
        if(isset($_POST['delete'])){
            $sql = "DELETE FROM Guia WHERE idGuia = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            header('Location: index.php?controller=guia&action=list');
            exit();
        }

    }
    public function getGuiasByTema()
    {
        if(isset($_GET['tema'])){
            $tema = $_GET['tema'];
            $sql = "SELECT idGuia, titulo, descripcion, fecha, tema, nickname, fichero, Guia.idUsuario FROM Guia, Usuario WHERE Guia.idUsuario = Usuario.idUsuario AND tema = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$tema]);
            return $stmt->fetchAll();
        }else{
            $sql = "SELECT idGuia, titulo, descripcion, fecha, tema, nickname, fichero, Guia.idUsuario FROM Guia, Usuario WHERE Guia.idUsuario = Usuario.idUsuario";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();        
        }
    }
    public function getGuiasByFecha($order) {
        $sql = "SELECT idGuia, titulo, descripcion, fecha, tema, nickname, fichero, Guia.idUsuario FROM Guia, Usuario WHERE Guia.idUsuario = Usuario.idUsuario ORDER BY fecha $order";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getGuiasGuardadasUsuario(){
        $sql = "SELECT idGuia FROM GuiasGuardadas WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario']]);
        return $stmt->fetchAll();
    } 

    public function getGuiasFavoritasUsuario(){
        $sql = "SELECT idGuia FROM GuiasFavoritas WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario']]);
        return $stmt->fetchAll();
    }

    public function getGuiasFavoritasGenerales(){
        $sql = "SELECT idGuia FROM GuiasFavoritas";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function getGuiasByLikes(){
        $sql = "SELECT g.titulo, g.descripcion, g.fecha, u.nickname, gf.idGuia, gf.idUsuario, g.tema, g.fichero FROM GuiasFavoritas gf JOIN Guia g ON gf.idGuia = g.idGuia JOIN Usuario u ON g.idUsuario = u.idUsuario GROUP BY gf.idGuia ORDER BY COUNT(gf.idGuia) DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll();    
        return !empty($resultados) ? $resultados : null;
    }   

    public function save($idUsuario, $idGuia){
        $sql = 'INSERT INTO GuiasGuardadas (idUsuario, idGuia) VALUES (?,?)';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idGuia]);
    }

    public function unsave($idUsuario, $idGuia){
        $sql = 'DELETE FROM GuiasGuardadas WHERE idUsuario = ? AND idGuia = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idGuia]);
    }

    public function like($idUsuario, $idGuia) {
        $sql = 'INSERT INTO GuiasFavoritas (idUsuario, idGuia) VALUES (?,?)';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idGuia]);
    } 

    public function unlike($idUsuario, $idGuia) {
        $sql = 'DELETE FROM GuiasFavoritas WHERE idUsuario = ? AND idGuia = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idGuia]);
    }

    public function isSaved($idGuia){
        $sql = 'SELECT * FROM GuiasGuardadas WHERE idUsuario = ? AND idGuia = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario'], $idGuia]);
        return $stmt->fetch();
    }

    public function isLiked($idGuia){
        $sql = 'SELECT * FROM GuiasFavoritas WHERE idUsuario = ? AND idGuia = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario'], $idGuia]);
        return $stmt->fetch();
    }
}
