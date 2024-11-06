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

        $sql = "SELECT titulo, descripcion, fecha, nickname, fichero, Guia.idUsuario, Guia.idGuia FROM Guia, Usuario WHERE Guia.idUsuario = Usuario.idUsuario";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getGuiaById($id){
        $sql = "SELECT * FROM " . $this->table . " WHERE idGuia = ?";
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
            $sql = "INSERT INTO Guia (titulo, descripcion, fecha, idUsuario, fichero) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
    
            $fechaActual = date('Y-m-d');
            $stmt->execute([$titulo, $descripcion, $fechaActual, $idUsuario, $filePath]);
    
            $id = $this->connection->lastInsertId();
    
            return $id; 
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();  
        }
    }
    public function getGuiasByUserId($userId) {
        $sql = "SELECT titulo FROM Guia WHERE idUsuario = ?";
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
    
}
