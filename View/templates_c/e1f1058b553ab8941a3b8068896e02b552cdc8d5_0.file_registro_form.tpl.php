<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:14:15
  from 'file:adoptantes/registro_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a5e972447e6_24737646',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e1f1058b553ab8941a3b8068896e02b552cdc8d5' => 
    array (
      0 => 'adoptantes/registro_form.tpl',
      1 => 1762286919,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5e972447e6_24737646 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adoptantes';
?><div class="formulario-registro">
    <h2>Registrar Nuevo Adoptante</h2>

    <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
        <p class="alerta error">❌ Error: <?php echo $_smarty_tpl->getValue('error');?>
</p>
    <?php }?>

    <form method="POST" action="index.php?action=registrarAdoptante">
        
        <label for="nombre">Nombre Completo:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="dni">DNI/Identificación:</label><br>
        <input type="text" id="dni" name="dni" required><br><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="direccion">Dirección:</label><br>
        <textarea id="direccion" name="direccion"></textarea><br><br>

        <label for="requisitosCumplidos">¿Cumple Requisitos para Adopción?</label><br>
        <input type="checkbox" id="requisitosCumplidos" name="requisitosCumplidos"><br><br>

        <button type="submit" class="btn-primary">Guardar Adoptante</button>
        
        <a href="index.php?action=listarAdoptantes" class="btn-secondary">Cancelar y Volver</a>
    </form>
</div><?php }
}
