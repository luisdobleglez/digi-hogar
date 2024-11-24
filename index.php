<?php
session_start(); // Iniciar la sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php"); // Redirige a la página de inicio de sesión si no está autenticado
    exit();
}


// Cargar los datos del usuario desde la sesión
$usuario = [
    'id' => $_SESSION['usuario']['id'] ?? '',
    'nombre' => $_SESSION['usuario']['nombre'] ?? ''
];
$h1 = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 39.9 40" enable-background="new 0 0 39.9 40" xml:space="preserve"><circle cx="19.9" cy="20" r="6"/>	<path d="M20,0L0,20.3V40h39.9V20.2L20,0z M35.9,36h-32V22l16-16l16,16V36z"/></svg>';
include 'inc/cabecera.php';
?>
<main>
   <h2>Hola, <?php echo $usuario['nombre']; ?></h2>
<p>Nuestro gestor de usuarios ha sido desarrollado como una solución full-stack, combinando una interfaz intuitiva con una arquitectura robusta y segura. La tecnología detrás de esta aplicación no solo facilita la gestión de usuarios, sino que también asegura una experiencia rápida, responsiva y accesible desde cualquier dispositivo.</p><p><strong>Frontend</strong>: La capa visual ha sido creada con HTML, CSS y JavaScript, permitiendo una interacción fluida y moderna. Los formularios de edición, las notificaciones asíncronas, y la actualización en tiempo real de los datos son solo algunas de las funciones diseñadas para hacer la experiencia de usuario más intuitiva.</p><p><strong>Backend</strong>: La aplicación funciona sobre PHP y MySQL, donde los datos se manejan de manera segura. Cada interacción pasa por un proceso de verificación y seguridad, protegiendo la información de los usuarios y garantizando un manejo óptimo de la base de datos.</p><p><strong>Características destacadas</strong>:</p><ul><li><strong>Autenticación segura</strong> con sesiones de PHP.</li><li><strong>Subida y gestión de archivos</strong> para las fotos de perfil.</li><li><strong>Actualización en tiempo real</strong> usando JavaScript y llamadas AJAX.</li><li><strong>Interfaz adaptable</strong> para dispositivos móviles y de escritorio.</li></ul><p>Este proyecto refleja el potencial de las tecnologías full-stack, donde el frontend y el backend trabajan en conjunto para ofrecer una solución completa y de alto rendimiento. ¡Una herramienta poderosa para una gestión eficiente y moderna de usuarios!</p>
</main>
<?php include 'inc/pie.php'; ?>