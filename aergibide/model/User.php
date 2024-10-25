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
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if(isset($post['submit'])){

            $hashedPassword = password_hash($post['password'], PASSWORD_DEFAULT);

            $stmt=$this->connection->prepare('INSERT INTO `Usuario` (`nombre`, `apellido`, `nickname`, `contrasena`, `tipo`, `correo`) VALUES (:nombre, :apellido, :nickname, :contrasena, "normal", :correo)');

            $stmt->execute([
                ':nombre' => $post['nombre'],
                ':apellido' => $post['apellidos'],
                ':nickname' => $post['usuario'],
                ':contrasena' => $hashedPassword,
                ':correo' => $post['correo']
            ]);

            if ($this->connection->lastInsertId()){
                return $this->connection->lastInsertId();
            }
        }
        return;
    }

    public function login(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($post['submit'])){
            $storedUser= $this->getUserByEmail($post['correo']);
            if (isset($storedUser['correo']) && password_verify($post['password'], $storedUser['password'])){
                return $storedUser;
            }
        }
        return;
    }
}
