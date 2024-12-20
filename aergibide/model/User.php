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
    public function getUserById($idUsuario)
    {
        if (is_null($idUsuario)) return false;

        $sql = "SELECT * FROM " . $this->table . " WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$idUsuario]);

        return $stmt->fetch();
    }

    public function getUserByEmail($correo)
    {
        if (is_null($correo)) return false;

        $sql = "SELECT * FROM " . $this->table . " WHERE correo = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch();
    }

    public function register()
    {
        if (isset($_POST['submit'])) {
            if ($this->getUserByEmail($_POST['correo'])) {
                return "El correo ya está registrado.";
            }

            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $stmt = $this->connection->prepare(
                'INSERT INTO `Usuario` (`nombre`, `apellido`, `nickname`, `contrasena`, `tipo`, `correo`) 
                 VALUES (:nombre, :apellido, :nickname, :contrasena, "normal", :correo)'
            );

            $stmt->execute([
                ':nombre' => $_POST['nombre'],
                ':apellido' => $_POST['apellido'],
                ':nickname' => $_POST['nickname'],
                ':contrasena' => $hashedPassword,
                ':correo' => $_POST['correo']
            ]);

            // Confirmar que el registro fue exitoso
            if ($this->connection->lastInsertId()) {
                return $this->connection->lastInsertId();
            }
        }
        return false;
    }
    public function update($param)
    {
        $nombre = $apellido = $nickname = $correo = "";
        $exists = false;

        // Cogemos de BD el objeto usuario si existe
        if (isset($param["idUsuario"]) && $param["idUsuario"] != '') {
            $actualUser = $this->getUserById($param["idUsuario"]);
            if (isset($actualUser["idUsuario"])) {
                $exists = true;
                $idUsuario = $param["idUsuario"];
                $nombre = $actualUser["nombre"];
                $apellido = $actualUser["apellido"];
                $nickname = $actualUser["nickname"];
                $correo = $actualUser["correo"];
            }
        }

        // Sobreescribimos los campos cambiados que nos vengan vía POST
        if (isset($param["nombre"])) $nombre = $param["nombre"];
        if (isset($param["apellido"])) $apellido = $param["apellido"];
        if (isset($param["nickname"])) $nickname = $param["nickname"];

        // Si se proporciona una nueva contraseña, la hasheamos
        $passwordUpdate = "";
        if (isset($param["password"]) && !empty($param["password"])) {
            $passwordUpdate = ", contrasena = ?";
            $hashedPassword = password_hash($param["password"], PASSWORD_DEFAULT);
        }

        if ($exists) {
            $sql = "UPDATE " . $this->table . " SET nombre = ?, apellido = ?, nickname = ?" . $passwordUpdate . " WHERE idUsuario = ?";
            $stmt = $this->connection->prepare($sql);

            $params = [$nombre, $apellido, $nickname];
            if ($passwordUpdate) {
                $params[] = $hashedPassword;
            }
            $params[] = $idUsuario;

            $res = $stmt->execute($params);

            // Si la actualización fue exitosa, actualizamos la sesión
            if ($res) {
                $_SESSION['user_data'] = array(
                    "idUsuario" => $idUsuario,
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "nickname" => $nickname,
                    "tipo" => $_SESSION['user_data']['tipo'], // Mantener el tipo de usuario
                    "correo" => $_SESSION['user_data']['correo'] //Mantener el correo
                );
            }
        }

        return $idUsuario;
    }

    public function getUsuarios()
    {
        $sql = "SELECT * FROM Usuario";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function hacerAdmin($id)
    {
        $sql = "UPDATE Usuario SET tipo = 'admin' WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        header('Location: index.php?controller=user&action=list' . '#scrollPosition');
        exit();
    }

    public function hacerNormal($id)
    {
        $sql = "UPDATE Usuario SET tipo = 'normal' WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        header('Location: index.php?controller=user&action=list' . '#scrollPosition');
        exit();
    }
    public function borrarUsuario($id)
    {
        if (isset($_POST['delete'])) {
            $sql = "DELETE FROM Usuario WHERE idUsuario = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            header('Location: index.php?controller=user&action=list' . '#scrollPosition');
            exit();
        }
    }
    public function login()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($post['submit'])) {
            $storedUser = $this->getUserByEmail($post['correo']);
            if ($storedUser && password_verify($post['password'], $storedUser['contrasena'])) {
                return $storedUser;
            }
        }
        return null;
    }
}
