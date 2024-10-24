<?php
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    if (empty($nombre) || empty($apellido) || empty($nickname) || empty($correo) || empty($contrasena)) {
        die("Por favor, completa todos los campos.");
    }

    try {
        $conexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Encriptar la contraseña
        $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Usuario (nombre, apellido, nickname, contrasena, tipo, correo) VALUES (:nombre, :apellido, :nickname, :contrasena, 'normal', :correo)";
        $stmt = $conexion->prepare($sql);
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':contrasena', $contrasena_encriptada);
        $stmt->bindParam(':correo', $correo);

        if ($stmt->execute()) {
            echo "Registro exitoso. Puedes iniciar sesión.";
        } else {
            echo "Error al registrar el usuario.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}