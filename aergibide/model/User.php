<?php

class User
{
    private $table = "Usuario";
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

    public function getUserByEmail($correo)
    {
        if (is_null($correo)) return false;

        $sql = "SELECT * FROM " . $this->table . " WHERE correo = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch();
    }

    public function register(){
        if(isset($_POST['submit'])){
    
                if ($this->getUserByEmail($_POST['correo'])) {
                return "El correo ya está registrado.";
            }
    
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            $stmt=$this->connection->prepare('INSERT INTO `Usuario` (`nombre`, `apellido`, `nickname`, `contrasena`, `tipo`, `correo`) VALUES (:nombre, :apellido, :nickname, :contrasena, "normal", :correo)');
    
            $stmt->execute([
                ':nombre' => $_POST['nombre'],
                ':apellido' => $_POST['apellido'],
                ':nickname' => $_POST['nickname'],
                ':contrasena' => $hashedPassword,
                ':correo' => $_POST['correo']
            ]);
    
            if ($this->connection->lastInsertId()){
                return $this->connection->lastInsertId();
            }
        }
        return false;
    }
    

    public function login(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($post['submit'])){
            $storedUser= $this->getUserByEmail($post['correo']);
            if (isset($storedUser['correo']) && password_verify($post['password'], $storedUser['contrasena'])){
                return $storedUser;
            }
        }
        return;
    }
}
