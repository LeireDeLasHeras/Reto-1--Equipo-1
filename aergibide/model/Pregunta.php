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

    public function crearPregunta(){
        if(isset($_POST['submit'])){
            $stmt = $this->connection->prepare("INSERT INTO Pregunta (titulo, descripcion, tema, fecha, idUsuario) VALUES (:titulo, :descripcion, :tema, NULL, :idUsuario)");
            $stmt->execute([
                ':titulo' => $_POST['titulo'],
                ':descripcion' => $_POST['descripcion'],    
                ':tema' => $_POST['tema'],

                ':idUsuario' => "22"
            ]);
        }
    }
}
