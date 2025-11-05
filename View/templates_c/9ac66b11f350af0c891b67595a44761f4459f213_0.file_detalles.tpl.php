<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:25:59
  from 'file:adoptantes/detalles.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a61576c70b0_33439012',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ac66b11f350af0c891b67595a44761f4459f213' => 
    array (
      0 => 'adoptantes/detalles.tpl',
      1 => 1762287938,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a61576c70b0_33439012 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adoptantes';
?><div class="detalles-adoptante">
    <h2>Detalles del Adoptante: <?php echo $_smarty_tpl->getValue('adoptante')->getNombre();?>
</h2>

    <p><strong>ID de Adoptante:</strong> <?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
</p>
    <p><strong>DNI/Identificación:</strong> <?php echo $_smarty_tpl->getValue('adoptante')->getDni();?>
</p>
    <p><strong>Teléfono:</strong> <?php echo $_smarty_tpl->getValue('adoptante')->getTelefono();?>
</p>
    <p><strong>Email:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('adoptante')->getEmail() ?? null)===null||$tmp==='' ? '(No especificado)' ?? null : $tmp);?>
</p>
    <p><strong>Dirección:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('adoptante')->getDireccion() ?? null)===null||$tmp==='' ? '(No especificada)' ?? null : $tmp);?>
</p>
    
    <p>
        <strong>Estado de Habilitación:</strong> 
        <?php if ($_smarty_tpl->getValue('adoptante')->cumpleRequisitos()) {?>
            <span style="color: green; font-weight: 700;">✅ HABILITADO</span>
        <?php } else { ?>
            <span style="color: red; font-weight: 700;">❌ NO HABILITADO</span>
        <?php }?>
    </p>

    <div style="margin-top: 30px;">
        <a href="index.php?action=modificarAdoptante&id=<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
" class="btn-primary">Modificar Adoptante</a>
        <a href="index.php?action=listarAdoptantes" class="btn-secondary" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</div><?php }
}
