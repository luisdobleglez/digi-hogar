<?php
session_start(); // Iniciar la sesión

// Borrar todas las variables de sesión
$_SESSION = array();

// Si deseas eliminar la cookie de la sesión (opcional)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio o de login
header("Location: ../login.php");
exit();
