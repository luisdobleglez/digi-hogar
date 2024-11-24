<?php
// Incluir la configuración de la base de datos
include 'db_connect.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Usamos la contraseña tal cual se envía
    $telefono = $_POST['telefono'];

    // Si no se sube ninguna imagen, asignamos una cadena vacía
    $targetFile = '';  // Deja el campo vacío si no se sube una imagen

    // Procesar la imagen (si se sube una)
    if (isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] === UPLOAD_ERR_OK) {
        $imagenPerfil = $_FILES['imagen_perfil'];
        $targetDir = "/subida/"; // Asegúrate de que esta carpeta exista
        $fileName = basename($imagenPerfil['name']);
        $targetFile = $targetDir . $fileName;

        // Mover el archivo subido a la carpeta de destino
        if (!move_uploaded_file($imagenPerfil['tmp_name'], $targetFile)) {
            echo "Error al subir la imagen.";
        }
    }

    // Encriptar la contraseña antes de insertarla
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL
    $sql = "INSERT INTO usuarios (nombre, email, password, telefono, imagen_perfil) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Verificar si la consulta se preparó correctamente
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    // Ejecutar la consulta con los parámetros
    $stmt->bind_param("sssss", $nombre, $email, $hashedPassword, $telefono, $targetFile);
    
    if ($stmt->execute()) {
        echo "Usuario registrado con éxito!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}

