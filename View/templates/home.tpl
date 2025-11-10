<div class="landing-page">
    <div class="welcome-section">
        {* Bloque de Bienvenida y Fotografía *}
        <div class="visual-intro">
            <img src="https://s3.amazonaws.com/static.om.anigamy.net/static.selecciones.com.ar/App/Article/4370-560df2d4e6e55.jpg" alt="Mascotas mirando a cámara"> 
            
            <h2 class="welcome-title">Bienvenidos a Huellitas Perdidas</h2>
            <p>Sistema de Gestión para adopción de animales</p>
        </div>
   
     
        <div class="features-list">
            {* Las características clave no están en la imagen de login, 
               puedes mantener o eliminar esta sección según necesites.
*}
        </div>
    </div>

    <div class="login-section">
        <h3>🔑 Inicio de sesión</h3>
        
        {if isset($error_login)}
            <p class="alerta peligro">❌ Error de Acceso: {$error_login}</p>
        {/if}

        <form method="POST" action="index.php?action=login">
            <label for="username" class="sr-only">Usuario</label>
    
        <input type="text" id="username" name="username" required placeholder="Usuario"><br>
            
            <label for="password" class="sr-only">Contraseña</label>
            <input type="password" id="password" name="password" required placeholder="Contraseña"><br><br>
            
            <button type="submit" class="btn-login-modern full-width">Iniciar sesión</button>
        </form>
        
    </div>
</div>