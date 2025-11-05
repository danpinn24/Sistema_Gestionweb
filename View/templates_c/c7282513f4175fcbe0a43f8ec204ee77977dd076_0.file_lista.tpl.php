<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:14:09
  from 'file:adoptantes/lista.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a5e91422932_64556704',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7282513f4175fcbe0a43f8ec204ee77977dd076' => 
    array (
      0 => 'adoptantes/lista.tpl',
      1 => 1762286880,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5e91422932_64556704 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adoptantes';
?><div class="listado-adoptantes">
    <h2><?php echo $_smarty_tpl->getValue('titulo');?>
</h2>
    <p><a href="index.php?action=registrarAdoptante" class="btn-primary">Registrar Nuevo Adoptante</a></p>

    <?php if ((true && ($_smarty_tpl->hasVariable('adoptantes') && null !== ($_smarty_tpl->getValue('adoptantes') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('adoptantes')) > 0) {?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Habilitado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('adoptantes'), 'adoptante');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('adoptante')->value) {
$foreach0DoElse = false;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('adoptante')->getNombre();?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('adoptante')->getDni();?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('adoptante')->getTelefono();?>
</td>
                        <td>
                            <?php if ($_smarty_tpl->getValue('adoptante')->cumpleRequisitos()) {?>
                                <span style="color: green; font-weight: bold;">✅ SÍ</span>
                            <?php } else { ?>
                                <span style="color: red; font-weight: bold;">❌ NO</span>
                            <?php }?>
                        </td>
                        <td>
                            <a href="index.php?action=verDetallesAdoptante&id=<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
">Ver</a> |
                            <a href="index.php?action=modificarAdoptante&id=<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
">Modificar</a> |
                            <a href="index.php?action=confirmarBorradoAdoptante&id=<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
" class="btn-peligro">Borrar</a>
                        </td>
                    </tr>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="alerta">No hay adoptantes registrados.</p>
    <?php }?>
</div><?php }
}
