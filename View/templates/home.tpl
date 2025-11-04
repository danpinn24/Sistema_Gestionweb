<div class="landing-page">
    <div class="welcome-section">
        {* Bloque de Bienvenida y Fotografía *}
        <div class="visual-intro">
            <img src="https://s3.amazonaws.com/static.om.anigamy.net/static.selecciones.com.ar/App/Article/4370-560df2d4e6e55.jpg" alt="Mascotas mirando a cámara"> 
            
            <h2 class="welcome-title">Welcome to PetSoft</h2>
            <p>Animal Shelter Management System</p>
        </div>
   
     
        <div class="features-list">
            {* Las características clave no están en la imagen de login, 
               puedes mantener o eliminar esta sección según necesites.
*}
        </div>
    </div>

    <div class="login-section">
        <h3>🔑 Login to Your Account</h3>
        
        {if isset($error_login)}
            <p class="alerta peligro">❌ Error de Acceso: {$error_login}</p>
        {/if}

        <form method="POST" action="index.php?action=login">
            <label for="username" class="sr-only">Username</label>
    
        <input type="text" id="username" name="username" required placeholder="Username"><br>
            
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" required placeholder="Password"><br><br>
            
            <button type="submit" class="btn-login-modern full-width">Secure Login</button>
        </form>
        

        <div class="info-link">
            <a href="#">Forgot Password?</a>
        </div>
    </div>
</div>