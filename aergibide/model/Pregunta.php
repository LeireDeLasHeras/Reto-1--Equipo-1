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

    public function getAllPreguntas()
    {

        $sql = "SELECT titulo, descripcion, fecha, nickname FROM Pregunta, Usuario WHERE Pregunta.idUsuario = Usuario.idUsuario";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getPreguntaById($id){
        $sql = "SELECT * FROM " . $this->table . " WHERE idPregunta = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }   
}
