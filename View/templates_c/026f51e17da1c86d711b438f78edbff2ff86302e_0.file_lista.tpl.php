<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:12:48
  from 'file:animales/lista.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a5e40c8dc00_96604098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '026f51e17da1c86d711b438f78edbff2ff86302e' => 
    array (
      0 => 'animales/lista.tpl',
      1 => 1762205676,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5e40c8dc00_96604098 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\animales';
?><div class="listado-animales">
    <h2><?php echo $_smarty_tpl->getValue('titulo');?>
</h2>
    <p><a href="index.php?action=registrarAnimal" class="btn-primary">Registrar Nuevo Animal</a></p>

    <?php if ($_smarty_tpl->getValue('animales')) {?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
      
              <th>Especie</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
      
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('animales'), 'animal');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('animal')->value) {
$foreach0DoElse = false;
?>
                                        <?php if ($_smarty_tpl->getValue('animal')) {?> 
                    <tr>
                
        <td><?php echo $_smarty_tpl->getValue('animal')->getId();?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('animal')->getNombre();?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('animal')->getEspecie();?>
</td>
                        <td><?php echo $_smarty_tpl->getValue('animal')->getEstado();?>
</td>
                    
    <td>
                                                        <a href="index.php?action=verDetallesAnimal&id=<?php echo $_smarty_tpl->getValue('animal')->getId();?>
">Ver</a> |
                            <a href="index.php?action=modificarAnimal&id=<?php echo $_smarty_tpl->getValue('animal')->getId();?>
">Modificar</a> |
                            <a href="index.php?action=confirmarBorradoAnimal&id=<?php echo $_smarty_tpl->getValue('animal')->getId();?>
" class="btn-peligro">
                                Borrar
                            </a>
                        </td>
           
         </tr>
                    <?php }?>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="alerta">No hay animales registrados.</p>
    <?php }?>
</div>

<?php }
}
