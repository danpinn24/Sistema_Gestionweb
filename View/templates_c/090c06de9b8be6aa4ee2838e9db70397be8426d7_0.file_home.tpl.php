<?php
/* Smarty version 5.5.1, created on 2025-11-04 00:38:00
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_69093cd84365e1_79202340',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '090c06de9b8be6aa4ee2838e9db70397be8426d7' => 
    array (
      0 => 'home.tpl',
      1 => 1762213059,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69093cd84365e1_79202340 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates';
?><div class="landing-page">
    <div class="welcome-section">
                <div class="visual-intro">
            <img src="https://s3.amazonaws.com/static.om.anigamy.net/static.selecciones.com.ar/App/Article/4370-560df2d4e6e55.jpg" alt="Mascotas mirando a cámara"> 
            
            <h2 class="welcome-title">Welcome to PetSoft</h2>
            <p>Animal Shelter Management System</p>
        </div>
   
     
        <div class="features-list">
                    </div>
    </div>

    <div class="login-section">
        <h3>🔑 Login to Your Account</h3>
        
        <?php if ((true && ($_smarty_tpl->hasVariable('error_login') && null !== ($_smarty_tpl->getValue('error_login') ?? null)))) {?>
            <p class="alerta peligro">❌ Error de Acceso: <?php echo $_smarty_tpl->getValue('error_login');?>
</p>
        <?php }?>

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
</div><?php }
}
