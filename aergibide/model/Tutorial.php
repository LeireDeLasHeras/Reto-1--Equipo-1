<?php

class Tutorial
{

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
    public function getTutorialesByTema()
    {
        if (isset($_GET['tema'])) {
            $tema = $_GET['tema'];
            $sql = "SELECT t.idUsuario, t.idTutorial, t.titulo, t.descripcion, t.tema, t.enlace, t.fecha, u.nickname, COUNT(tf.idTutorial) as like_count
                    FROM Tutorial t
                    JOIN Usuario u ON t.idUsuario = u.idUsuario
                    LEFT JOIN TutorialesFavoritos tf ON t.idTutorial = tf.idTutorial
                    WHERE t.tema = ?
                    GROUP BY t.idTutorial";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$tema]);
            return $stmt->fetchAll();
        } else {
            $sql = "SELECT t.idUsuario, t.idTutorial, t.titulo, t.descripcion, t.tema, t.enlace, t.fecha, u.nickname, COUNT(tf.idTutorial) as like_count
                    FROM Tutorial t
                    JOIN Usuario u ON t.idUsuario = u.idUsuario
                    LEFT JOIN TutorialesFavoritos tf ON t.idTutorial = tf.idTutorial
                    GROUP BY t.idTutorial";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public function getTutorialesByFecha($order)
    {
        $sql = "SELECT t.idUsuario, t.idTutorial, t.titulo, t.descripcion, t.tema, t.enlace, t.fecha, u.nickname, COUNT(tf.idTutorial) as like_count
                FROM Tutorial t
                JOIN Usuario u ON t.idUsuario = u.idUsuario
                LEFT JOIN TutorialesFavoritos tf ON t.idTutorial = tf.idTutorial
                GROUP BY t.idTutorial
                ORDER BY t.fecha $order";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getTutorialById($id)
    {
        $sql = "SELECT t.idTutorial, t.titulo, t.descripcion, t.fecha, u.nickname, t.idUsuario, t.tema, t.enlace, COUNT(tf.idTutorial) as like_count
                FROM Tutorial t
                JOIN Usuario u ON t.idUsuario = u.idUsuario
                LEFT JOIN TutorialesFavoritos tf ON t.idTutorial = tf.idTutorial
                WHERE t.idTutorial = ?
                GROUP BY t.idTutorial";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(); // Devuelve el tutorial con el número de likes
    }

    public function crearTutorial()
    {

        if (!isset($_SESSION['user_data']) || !isset($_SESSION['user_data']['idUsuario'])) {

            return "Usuario no autenticado";
        }

        if (
            !isset($_POST['titulo']) || !isset($_POST['descripcion']) ||
            !isset($_POST['tema']) || !isset($_POST['enlace'])
        ) {

            return "Todos los campos son obligatorios";
        }

        if (
            empty($_POST['titulo']) || empty($_POST['descripcion']) ||
            empty($_POST['tema']) || empty($_POST['enlace'])
        ) {

            return "Ningún campo puede estar vacío";
        }


        $videoId = $_POST['enlace'];

        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO Tutorial (titulo, tema, descripcion, enlace, fecha, idUsuario) 
                 VALUES (:titulo, :tema, :descripcion, :enlace, :fecha, :idUsuario)"
            );

            $result = $stmt->execute([
                ':titulo' => $_POST['titulo'],
                ':tema' => $_POST['tema'],
                ':descripcion' => $_POST['descripcion'],
                ':enlace' => $videoId, // Guardamos solo el ID del video    
                ':fecha' => date('Y-m-d'),
                ':idUsuario' => $_SESSION['user_data']['idUsuario']
            ]);

            if ($result) {
                header('Location: index.php?controller=tutorial&action=view&id=' . $this->connection->lastInsertId());
                exit();
            }
            return "Error al crear el tutorial";
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function getTutorialesGuardadosByUserId($userId)
    {
        $sql = "SELECT Tutorial.* 
        FROM TutorialesGuardados 
        JOIN Tutorial ON TutorialesGuardados.idTutorial = Tutorial.idTutorial
        WHERE TutorialesGuardados.idUsuario = ?
        ";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getTutorialesByUserId($userId)
    {
        $sql = "SELECT * FROM Tutorial WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function borrarTutorial($id)
    {
        if (isset($_POST['delete'])) {
            $sql = "DELETE FROM Tutorial WHERE idTutorial = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            header('Location: index.php?controller=tutorial&action=list');
            exit();
        }
    }

    public function getTutorialesGuardadosUsuario()
    {
        $sql = "SELECT idTutorial FROM TutorialesGuardados WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario']]);
        return $stmt->fetchAll();
    }

    public function getTutorialesFavoritosUsuario()
    {
        $sql = "SELECT idTutorial FROM TutorialesFavoritos WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$_SESSION['user_data']['idUsuario']]);
        return $stmt->fetchAll();
    }

    public function getTutorialesFavoritosGenerales()
    {
        $sql = "SELECT idTutorial FROM TutorialesFavoritos";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function save($idUsuario, $idTutorial)
    {
        $sql = 'INSERT INTO TutorialesGuardados (idUsuario, idTutorial) VALUES (?,?)';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idTutorial]);
    }

    public function unsave($idUsuario, $idTutorial)
    {
        $sql = 'DELETE FROM TutorialesGuardados WHERE idUsuario = ? AND idTutorial = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idTutorial]);
    }

    public function like($idUsuario, $idTutorial)
    {
        $sql = 'INSERT INTO TutorialesFavoritos (idUsuario, idTutorial) VALUES (?,?)';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idTutorial]);
    }

    public function unlike($idUsuario, $idTutorial)
    {
        $sql = 'DELETE FROM TutorialesFavoritos WHERE idUsuario = ? AND idTutorial = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$idUsuario, $idTutorial]);
    }

    public function getTutorialesByLikes()
    {
        $sql = "SELECT t.idTutorial, t.titulo, t.descripcion, t.fecha, u.nickname, t.idUsuario, t.tema, t.enlace, COUNT(tf.idTutorial) as like_count
                FROM Tutorial t
                JOIN Usuario u ON t.idUsuario = u.idUsuario
                LEFT JOIN TutorialesFavoritos tf ON t.idTutorial = tf.idTutorial
                GROUP BY t.idTutorial
                ORDER BY like_count DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll();
        return !empty($resultados) ? $resultados : null;
    }


    public function isSaved($id)
    {
        $sql = "SELECT * FROM TutorialesGuardados WHERE idTutorial = ? AND idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id, $_SESSION['user_data']['idUsuario']]);
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function isLiked($id)
    {
        $sql = "SELECT * FROM TutorialesFavoritos WHERE idTutorial = ? AND idUsuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id, $_SESSION['user_data']['idUsuario']]);
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    public function getLikeCount($idTutorial)
    {
        $sql = "SELECT COUNT(*) as likeCount FROM TutorialesFavoritos WHERE idTutorial = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$idTutorial]);
        return $stmt->fetchColumn(); // Retorna el conteo de likes
    }
}
