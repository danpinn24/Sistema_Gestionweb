<?php
/* Smarty version 5.5.1, created on 2025-11-07 01:36:39
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690d3f172a1f72_35271660',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '090c06de9b8be6aa4ee2838e9db70397be8426d7' => 
    array (
      0 => 'home.tpl',
      1 => 1762475790,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690d3f172a1f72_35271660 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates';
?><div class="landing-page">
    <div class="welcome-section">
                <div class="visual-intro">
            <img src="https://s3.amazonaws.com/static.om.anigamy.net/static.selecciones.com.ar/App/Article/4370-560df2d4e6e55.jpg" alt="Mascotas mirando a cámara"> 
            
            <h2 class="welcome-title">Bienvenidos a Huellitas Perdidas</h2>
            <p>Sistema de Gestión para adopción de animales</p>
        </div>
   
     
        <div class="features-list">
                    </div>
    </div>

    <div class="login-section">
        <h3>🔑 Inicio de sesión</h3>
        
        <?php if ((true && ($_smarty_tpl->hasVariable('error_login') && null !== ($_smarty_tpl->getValue('error_login') ?? null)))) {?>
            <p class="alerta peligro">❌ Error de Acceso: <?php echo $_smarty_tpl->getValue('error_login');?>
</p>
        <?php }?>

        <form method="POST" action="index.php?action=login">
            <label for="username" class="sr-only">Usuario</label>
    
        <input type="text" id="username" name="username" required placeholder="Usuario"><br>
            
            <label for="password" class="sr-only">Contraseña</label>
            <input type="password" id="password" name="password" required placeholder="Contraseña"><br><br>
            
            <button type="submit" class="btn-login-modern full-width">Iniciar sesión</button>
        </form>
        
    </div>
</div><?php }
}
