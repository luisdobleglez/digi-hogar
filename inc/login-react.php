<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
include 'db_connect.php'; // Conexión a la base de datos
//Api para react
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para obtener los datos del usuario
    $sql = "SELECT id, email, password FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Si la contraseña está cifrada, la comparamos con password_verify
        if (password_verify($contrasena, $user['password'])) {
            echo json_encode(['success' => true]);
        }
        // Si la contraseña no está cifrada, la comparamos directamente
        else if ($contrasena === $user['password']) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Contraseña incorrecta']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
    }
}