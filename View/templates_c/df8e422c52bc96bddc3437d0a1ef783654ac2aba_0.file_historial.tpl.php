<?php
/* Smarty version 5.5.1, created on 2025-11-07 01:29:12
  from 'file:adopciones/historial.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690d3d58d24dc9_48748341',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df8e422c52bc96bddc3437d0a1ef783654ac2aba' => 
    array (
      0 => 'adopciones/historial.tpl',
      1 => 1762475339,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690d3d58d24dc9_48748341 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adopciones';
?><div class="container mt-4">
    <h2><?php echo $_smarty_tpl->getValue('titulo');?>
</h2>

        <?php if ((true && (true && null !== ($_GET['msg'] ?? null)))) {?>
        <div class="alert alert-success"><?php echo htmlspecialchars((string)$_GET['msg'], ENT_QUOTES, 'UTF-8', true);?>
</div>
    <?php }?>
    <?php if ((true && (true && null !== ($_GET['error'] ?? null)))) {?>
        <div class="alert alert-danger"><?php echo htmlspecialchars((string)$_GET['error'], ENT_QUOTES, 'UTF-8', true);?>
</div>
    <?php }?>

    <?php if (( !$_smarty_tpl->hasVariable('historial') || empty($_smarty_tpl->getValue('historial')))) {?>
        <div class="alert alert-info">Aún no se han registrado adopciones.</div>
    <?php } else { ?>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Animal</th>
                    <th>Adoptante</th>
                    <th>Fecha de Adopción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('historial'), 'adopcion');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('adopcion')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('adopcion')['animal_nombre'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('adopcion')['adoptante_nombre'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('adopcion')['fecha'],"%d-%m-%Y");?>
</td>
                    
                                        <td class="text-nowrap">
                        <a href="index.php?action=verDetallesAdopcion&id=<?php echo $_smarty_tpl->getValue('adopcion')['id'];?>
">
                            Ver
                        </a> |
                        <a href="index.php?action=modificarAdopcion&id=<?php echo $_smarty_tpl->getValue('adopcion')['id'];?>
">
                            Modificar
                        </a> |
                        <a href="index.php?action=confirmarBorradoAdopcion&id=<?php echo $_smarty_tpl->getValue('adopcion')['id'];?>
" class="btn btn-danger btn-sm">
                            Borrar
                        </a>
                    </td>
                </tr>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
    <?php }?>
    
    <a href="index.php?action=menuPrincipal" class="btn btn-secondary mt-3">Volver al Menú</a>
</div><?php }
}
