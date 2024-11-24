<?php 
$h1 = "Login";
include 'inc/cabecera.php'; 
?>
<main class="formulario">
    <form id="loginForm" method="POST" novalidate>
        <div>
            <label for="email">Email</label>
            <input type="text"  class="detexto" id="email" name="email" placeholder="Escribe tu email" required>
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password"  class="detexto" id="password" name="password" placeholder="Escribe la contraseña" required>
        </div>
        
        <button type="button" onclick="login()">Entrar</button>
    </form>
  <!--  <div id="mensaje"></div> -->
   <p>Si aún no te has registrado, <a href="registro.php">puedes hacerlo ahora</a></p>
</main>

    


<script>
function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const mensaje = document.getElementById('mensaje');

    fetch('inc/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la red');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
           // mensaje.innerHTML = '<p>Acceso correcto. Redirigiendo...</p>';
          
           quitaPonMensaje('Acceso correcto. Redirigiendo...',5000,true)

            setTimeout(() => {
                window.location.href = "index.php";
            },2000);
        } else {
           // mensaje.textContent = data.error || 'Acceso denegado';
            quitaPonMensaje('Acceso denegado',5000,false)
        }
    })
    .catch(error => {
        console.error('Error:', error);
        //mensaje.textContent = 'Hubo un problema al procesar tu solicitud';
        quitaPonMensaje('Hubo un problema al procesar su solicitud...',5000,false)
    });
}
</script>

<?php include 'inc/pie.php'; ?>