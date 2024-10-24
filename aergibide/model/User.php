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

    public function getUsuarioPor($campo, $valor)
    {
        if (is_null($valor)) return false;

        $columna = ($campo === 'email') ? 'correo' : 'nickname';
        $sql = "SELECT * FROM " . $this->table . " WHERE $columna = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$valor]);
        return $stmt->fetch();
    }

    public function register(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if(isset($post['submit'])){

            $hashedPassword = password_hash($post['password'], PASSWORD_DEFAULT);

            $stmt=$this->connection->prepare('INSERT INTO `users` (`name`, `email`, `password`) VALUES (:name, :email, :password)');

            $stmt->execute([
                ':name' => $post['name'],
                ':email' => $post['email'],
                ':password' => $hashedPassword,
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
            $storedUser= $this->getUserByEmail($post['email']);
            if (isset($storedUser['email']) && password_verify($post['password'], $storedUser['password'])){
                return $storedUser;
            }
        }
        return;
    }
}

?>
