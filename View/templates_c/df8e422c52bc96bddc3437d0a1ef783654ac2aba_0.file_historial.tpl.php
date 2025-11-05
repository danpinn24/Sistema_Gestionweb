<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:15:19
  from 'file:adopciones/historial.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a5ed7f02354_34848484',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df8e422c52bc96bddc3437d0a1ef783654ac2aba' => 
    array (
      0 => 'adopciones/historial.tpl',
      1 => 1762287002,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5ed7f02354_34848484 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adopciones';
?><div class="historial-adopciones">
    <h2><?php echo $_smarty_tpl->getValue('titulo');?>
</h2>

    <?php if ((true && ($_smarty_tpl->hasVariable('historial') && null !== ($_smarty_tpl->getValue('historial') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('historial')) > 0) {?>
        <table>
            <thead>
                <tr>
                    <th>ID Adopción</th>
                    <th>Animal Adoptado</th>
                    <th>Adoptante</th>
                    <th>Fecha</th>
                                    </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('historial'), 'registro');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('registro')->value) {
$foreach0DoElse = false;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->getValue('registro')['id'];?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('registro')['animal_nombre'];?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('registro')['adoptante_nombre'];?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('registro')['fecha'];?>
</td>
                    </tr>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="alerta">Aún no hay adopciones registradas en el sistema.</p>
    <?php }?>
</div><?php }
}
