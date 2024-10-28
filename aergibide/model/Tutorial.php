<?php

class Tutorial
{
    private $table = "Tutorial";
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

    public function getAlltutoriales()
    {

        $sql = "SELECT titulo, descripcion, nickname, enlace FROM Tutorial, Usuario WHERE Tutorial.idUsuario = Usuario.idUsuario";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getTutorialById($id){
        $sql = "SELECT * FROM " . $this->table . " WHERE idTutorial = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    } 
}
