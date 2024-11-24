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
    'nombre' => $_SESSION['usuario']['nombre'] ?? '',
    'email' => $_SESSION['usuario']['email'] ?? '',
    'telefono' => $_SESSION['usuario']['telefono'] ?? '',
    'imagen_perfil' => $_SESSION['usuario']['imagen_perfil'] ?? ''
];
$h1 = 'Ficha de usuario';
include 'inc/cabecera.php';
?>

<main id="ficha">
        <form id="formEditarUsuario" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?php echo $usuario['id']; ?>">
            <div>
                <label for="imagen_perfil" style="display:none">Imagen de Perfil:</label>
                <figure id="perfil">
                <img src="<?php echo $usuario['imagen_perfil']; ?>" alt="Foto de perfil" id="imagen-perfil">
                <figcaption>Actualizar foto</figcaption>
                </figure>
                <input type="file" name="imagen_perfil" id="imagen_perfil" accept="image/*" >
            </div>
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" class="detexto" name="nombre" id="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email"  class="detexto" name="email" id="email" value="<?php echo $usuario['email']; ?>" required>
            </div>
            <div>
                <label for="telefono">Teléfono:</label>
                <input type="text"  class="detexto" name="telefono" id="telefono" value="<?php echo $usuario['telefono']; ?>">
            </div>
            <button type="button" id="guardarBtn">Guardar</button>
          

        </form>
        <p id="mensaje"></p>

    </main>
    <script>
// Manejar la actualización del usuario
document.getElementById("guardarBtn").addEventListener("click", async () => {
    const form = document.getElementById("formEditarUsuario");
    const formData = new FormData(form);

    try {
        const response = await fetch("inc/ficha-usuario.php", {
            method: "POST",
            body: formData
        });

        const result = await response.json();
        const mensaje = document.getElementById("mensaje");

        if (result.status === "success") {
            mensaje.textContent = "Datos actualizados correctamente.";
            mensaje.style.color = "green";
        } else {
            mensaje.textContent = "Error al actualizar los datos.";
            mensaje.style.color = "red";
        }
    } catch (error) {
        console.error("Error:", error);
        document.getElementById("mensaje").textContent = "Error al conectar con el servidor.";
    }
});
</script>
<?php include 'inc/pie.php'; ?>

