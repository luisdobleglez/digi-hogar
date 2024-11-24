<?php
session_start(); // Iniciar la sesión

header("Content-Type: application/json"); // Respuesta en formato JSON
header("Access-Control-Allow-Origin: http://luisgg.com"); // Cambia a * para pruebas locales
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($email && $password) {
        // Buscar el usuario en la base de datos y obtener los campos necesarios
        $sql = "SELECT id, email, password, nombre, telefono, imagen_perfil FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Añadir los nuevos campos al bind_result
                $stmt->bind_result($id, $storedEmail, $storedPassword, $storedName, $telefono, $imagen_perfil);
                $stmt->fetch();

                // Verificar si la contraseña es correcta
                if (password_verify($password, $storedPassword)) {
                    // Iniciar la sesión y almacenar todos los datos requeridos
                    $_SESSION['autenticado'] = true;
                    $_SESSION['usuario'] = [
                        'id' => $id,
                        'nombre' => $storedName,
                        'email' => $storedEmail,
                        'telefono' => $telefono,
                        'imagen_perfil' => $imagen_perfil 
                    ];

                    // Respuesta exitosa
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Contraseña incorrecta']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Email no encontrado']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'Error en la consulta']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    }

    $conn->close();
}