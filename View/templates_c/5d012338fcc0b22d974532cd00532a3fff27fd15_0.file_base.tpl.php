<?php
/* Smarty version 5.5.1, created on 2025-11-04 00:37:59
  from 'file:base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_69093cd7d64ce9_31500292',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d012338fcc0b22d974532cd00532a3fff27fd15' => 
    array (
      0 => 'base.tpl',
      1 => 1762213070,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69093cd7d64ce9_31500292 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates';
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (($tmp = $_smarty_tpl->getValue('titulo') ?? null)===null||$tmp==='' ? "Refugio de Adopciones" ?? null : $tmp);?>
</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('CSS_PATH');?>
"> 
</head>
<body>
    <header>
                <h1>Sistema de Gestión de Animales</h1> 
        <nav>
            <ul>
                    
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('nav_items'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
                    <li><a href="<?php echo $_smarty_tpl->getValue('item')['url'];?>
"><?php echo $_smarty_tpl->getValue('item')['nombre'];?>
</a></li>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </ul>
        </nav>
    </header>

    <main class="main-content-container"> 
        <?php if ((true && (true && null !== ($_GET['msg'] ?? null)))) {?>
         
   <p class="alerta exito"><?php echo $_GET['msg'];?>
</p>
        <?php }?>
        
        <?php $_smarty_tpl->renderSubTemplate($_smarty_tpl->getValue('contenido_tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </main>

    <footer>
        <p>&copy;
2025. Gestión de Adopciones.</p>
    </footer>
</body>
</html><?php }
}
