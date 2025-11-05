<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:21:37
  from 'file:adoptantes/confirmar_borrado.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a60512d5e06_89788181',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '66e593e80ed42767adfa203dbd4e147eb4947b46' => 
    array (
      0 => 'adoptantes/confirmar_borrado.tpl',
      1 => 1762287692,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a60512d5e06_89788181 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adoptantes';
?><div class="confirmacion">
    <h2>Confirmar Borrado de Adoptante</h2>
    
    <h3>¿Estás seguro de que deseas eliminar a "<?php echo $_smarty_tpl->getValue('adoptante')->getNombre();?>
"?</h3>

    <div class="alerta peligro" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 4px; margin-top: 15px;">
        <p>Esta acción es **irreversible** y eliminará permanentemente el registro del adoptante con ID: **<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
**.</p>
    </div>

    <div class="acciones-confirmacion" style="margin-top: 20px;">
        
                <a href="index.php?action=borrarAdoptante&id=<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
" class="btn-peligro">
            Sí, Confirmar Eliminación
        </a>
        
                <a href="index.php?action=listarAdoptantes" class="btn-secondary" style="margin-left: 10px;">
            No, Cancelar y Volver
        </a>
    </div>
</div><?php }
}
