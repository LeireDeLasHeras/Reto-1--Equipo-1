<?php
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['username'];
    $contrasena = $_POST['password'];

    if (empty($usuario) || empty($contrasena)) {
        die("Por favor, completa todos los campos.");
    }

    try {
        $conexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM Usuario WHERE nickname = :usuario";
        $stmt = $conexion->prepare($sql);
        
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario_db && password_verify($contrasena, $usuario_db['contrasena'])) {
            echo "Inicio de sesión exitoso. Bienvenido, " . $usuario . "!";
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
