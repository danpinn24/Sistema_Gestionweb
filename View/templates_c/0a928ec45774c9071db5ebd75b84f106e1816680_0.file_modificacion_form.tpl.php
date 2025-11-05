<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:24:44
  from 'file:adoptantes/modificacion_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a610c5c2d23_45166280',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a928ec45774c9071db5ebd75b84f106e1816680' => 
    array (
      0 => 'adoptantes/modificacion_form.tpl',
      1 => 1762287880,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a610c5c2d23_45166280 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adoptantes';
?><div class="formulario-registro">
    <h2>Modificar Adoptante: <?php echo $_smarty_tpl->getValue('adoptante')->getNombre();?>
</h2>

        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
        <p class="alerta error">❌ Error: <?php echo $_smarty_tpl->getValue('error');?>
</p>
    <?php }?>

    <form method="POST" action="index.php?action=modificarAdoptante&id=<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
">
        
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
">

        <label for="nombre">Nombre Completo:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $_smarty_tpl->getValue('adoptante')->getNombre();?>
" required><br><br>
        
        <label for="dni">DNI/Identificación:</label><br>
        <input type="text" id="dni" name="dni" value="<?php echo $_smarty_tpl->getValue('adoptante')->getDni();?>
" required><br><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $_smarty_tpl->getValue('adoptante')->getTelefono();?>
" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $_smarty_tpl->getValue('adoptante')->getEmail();?>
"><br><br>
        
        <label for="direccion">Dirección:</label><br>
        <textarea id="direccion" name="direccion"><?php echo $_smarty_tpl->getValue('adoptante')->getDireccion();?>
</textarea><br><br>

        <label for="requisitosCumplidos">¿Cumple Requisitos para Adopción (Habilitado)?</label><br>
        <input type="checkbox" id="requisitosCumplidos" name="requisitosCumplidos" 
            <?php if ($_smarty_tpl->getValue('adoptante')->cumpleRequisitos()) {?>checked<?php }?>
        ><br><br>

        <button type="submit" class="btn-primary">Actualizar Adoptante</button>
        
        <a href="index.php?action=listarAdoptantes" class="btn-secondary">Cancelar y Volver al Listado</a>
    </form>
</div><?php }
}
