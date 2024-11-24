<?php
include 'db_connect.php';
session_start(); // Aseguramos que la sesión esté iniciada

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Comprobamos si hay datos POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $imagen_perfil = '';

    // Actualizar la imagen de perfil si se subió una nueva
    if (isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] == 0) {
        $carpeta_destino = 'subida/';
        $imagen_perfil = $carpeta_destino . basename($_FILES['imagen_perfil']['name']);
        move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $imagen_perfil);
    }

    // Preparamos la consulta SQL con el campo de imagen opcional
    $sql = "UPDATE usuarios SET nombre=?, email=?, telefono=?";
    if ($imagen_perfil) {
        $sql .= ", imagen_perfil=?";
    }
    $sql .= " WHERE id=?";
    
    $stmt = $conn->prepare($sql);

    // Vinculamos los parámetros y ejecutamos
    if ($imagen_perfil) {
        $stmt->bind_param("ssssi", $nombre, $email, $telefono, $imagen_perfil, $id);
    } else {
        $stmt->bind_param("sssi", $nombre, $email, $telefono, $id);
    }

    if ($stmt->execute()) {
        // Actualizar la variable de sesión con los nuevos valores
        $_SESSION['usuario']['nombre'] = $nombre;
        $_SESSION['usuario']['email'] = $email;
        $_SESSION['usuario']['telefono'] = $telefono;
        
        // Actualizar imagen en sesión solo si se cambió
        if ($imagen_perfil) {
            $_SESSION['usuario']['imagen_perfil'] = $imagen_perfil;
        }

        echo json_encode(["status" => "success", "message" => "Datos actualizados correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar datos"]);
    }

    $stmt->close();
}
$conn->close();
