<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:12:56
  from 'file:animales/detalles.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a5e48ec3e54_25736319',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e7050e21e5aedc14587e6da91e5b6f32266fe0c' => 
    array (
      0 => 'animales/detalles.tpl',
      1 => 1762205753,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5e48ec3e54_25736319 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\animales';
?><div class="detalles-animal">
    <h2>Detalles de <?php echo $_smarty_tpl->getValue('animal')->getNombre();?>
</h2>

    <p><strong>ID:</strong> <?php echo $_smarty_tpl->getValue('animal')->getId();?>
</p>
    <p><strong>Especie:</strong> <?php echo $_smarty_tpl->getValue('animal')->getEspecie();?>
</p>
    <p><strong>Raza:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('animal')->getRaza() ?? null)===null||$tmp==='' ? '(No especificada)' ?? null : $tmp);?>
</p>
    <p><strong>Edad:</strong> <?php echo $_smarty_tpl->getValue('animal')->getEdad();?>
 años</p>
    <p><strong>Sexo:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('animal')->getSexo() ?? null)===null||$tmp==='' ? '(No especificado)' ?? null : $tmp);?>
</p>
    <p><strong>Estado:</strong> **<?php echo $_smarty_tpl->getValue('animal')->getEstado();?>
**</p>
    <p><strong>Fecha de Ingreso:</strong> <?php echo $_smarty_tpl->getValue('animal')->getFechaIngreso();?>
</p>
    <p><strong>Características Físicas:</strong> 
        <?php echo (($tmp = $_smarty_tpl->getValue('animal')->getCaracteristicasFisicas() ?? null)===null||$tmp==='' ? '(No hay descripción)' ?? null : $tmp);?>

    </p>

    <a href="index.php?action=modificarAnimal&id=<?php echo $_smarty_tpl->getValue('animal')->getId();?>
" class="btn-primary">Modificar Animal</a>
    <a href="index.php?action=listarAnimales" class="btn-secondary">Volver al Listado</a>
</div><?php }
}
