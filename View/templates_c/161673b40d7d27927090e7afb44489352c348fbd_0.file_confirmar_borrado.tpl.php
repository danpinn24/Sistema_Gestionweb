<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:14:01
  from 'file:animales/confirmar_borrado.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a5e894ac8a9_29064736',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '161673b40d7d27927090e7afb44489352c348fbd' => 
    array (
      0 => 'animales/confirmar_borrado.tpl',
      1 => 1762205709,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5e894ac8a9_29064736 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\animales';
?><div class="confirmacion">
    <h2><?php echo $_smarty_tpl->getValue('titulo');?>
</h2>
    
    <h3>¿Estás seguro de que deseas eliminar a "<?php echo $_smarty_tpl->getValue('animal')->getNombre();?>
"?</h3>

    <div class="alerta peligro" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 4px; margin-top: 15px;">
        <p>Esta acción es **irreversible** y eliminará permanentemente el registro del animal con ID: **<?php echo $_smarty_tpl->getValue('animal')->getId();?>
**.</p>
    </div>

    <div class="acciones-confirmacion" style="margin-top: 20px;">
        
                <a href="index.php?action=borrarAnimal&id=<?php echo $_smarty_tpl->getValue('animal')->getId();?>
" class="btn-peligro">
            Sí, Confirmar Eliminación
        </a>
        
                <a href="index.php?action=listarAnimales" class="btn-secondary" style="margin-left: 10px;">
            No, Cancelar y Volver
        </a>
    </div>
</div><?php }
}
