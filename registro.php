<?php
$h1 = "Signup";
include 'inc/cabecera.php';
?>

<main class="formulario">
<form action="inc/registro.php" method="POST" enctype="multipart/form-data">
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text"  class="detexto" name="nombre" id="nombre" required>
    </div>
    <div>
        <label for="email">Email:</label> 
        <input type="email"  class="detexto" name="email" id="email" required>
    </div>
    <div>
        <label for="password">Contraseña:</label>
        <input type="password"  class="detexto" name="password" id="password" required>
    </div>
    <div>
        <label for="telefono">Teléfono:</label>
        <input type="text"  class="detexto" name="telefono" id="telefono">
    </div>
     <div class="cargar">
        <label for="imagen_perfil">Imagen de Perfil</label>
        <input type="file" name="imagen_perfil" id="imagen_perfil">
    </div> 
    <button type="submit">Registrar</button>
    <small>Este formulario es un trabajo en desarrollo. No tenemos ningún interés en tus datos. En cualquier caso, si el azar te ha traido hasta aquí y has insertado los datos, no los usaremos con ningún fin.</small>
    <p>Si ya te has registrado, <a href="login.php">puedes acceder ahora</a></p>
</form>
</main>
<?php include 'inc/pie.php'; ?>
