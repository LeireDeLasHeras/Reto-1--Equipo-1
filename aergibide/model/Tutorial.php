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
    public function crearTutorial(){
        if(isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['tema']) && isset($_POST['tema'])){
            try {
                $stmt = $this->connection->prepare("INSERT INTO Tutorial (titulo, tema, descripcion, enlace, fecha, idUsuario) VALUES (:titulo, :tema, :descripcion, :enlace, :fecha, :idUsuario)");
                $result = $stmt->execute([
                    ':titulo' => $_POST['titulo'],
                    ':tema' => $_POST['tema'],
                    ':descripcion' => $_POST['descripcion'],    
                    ':enlace' => $_POST['enlace'],    
                    ':fecha' => date('Y-m-d'),
                    ':idUsuario' => $_SESSION['user_data']['idUsuario']
                ]);
                
                if($result) {
                    header('Location: index.php?controller=tutorial&action=list');
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
