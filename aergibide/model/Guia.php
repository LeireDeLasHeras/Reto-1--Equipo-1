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

        $sql = "SELECT titulo, descripcion, fecha, nickname, fichero FROM Guia, Usuario WHERE Guia.idUsuario = Usuario.idUsuario";
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
        $titulo = $descripcion = $tema = $filePath = null;
    
        if (isset($param['file_path'])) $filePath = $param['file_path'];
    
        $param = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    
        if (isset($param["titulo"])) $titulo = $param["titulo"];
        if (isset($param["descripcion"])) $descripcion = $param["descripcion"];
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
            return false;
        }
    }
    public function getAllGuiasByUserId($userId) {
        $sql = "SELECT * FROM Guia WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    
}
