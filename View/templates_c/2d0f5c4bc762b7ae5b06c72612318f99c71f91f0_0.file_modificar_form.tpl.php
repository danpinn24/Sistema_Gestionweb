<?php
/* Smarty version 5.5.1, created on 2025-11-07 01:32:34
  from 'file:adopciones/modificar_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690d3e22421807_99299687',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d0f5c4bc762b7ae5b06c72612318f99c71f91f0' => 
    array (
      0 => 'adopciones/modificar_form.tpl',
      1 => 1762475035,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690d3e22421807_99299687 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adopciones';
?><div class="container mt-4">
    <h2><?php echo $_smarty_tpl->getValue('titulo');?>
</h2>

    <?php if ($_smarty_tpl->getValue('error')) {?>
        <div class="alert alert-danger"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
    <?php }?>

    <form action="index.php?action=modificarAdopcion" method="POST">
                <input type="hidden" name="id_adopcion" value="<?php echo $_smarty_tpl->getValue('adopcion')->getIdAdopcion();?>
">

        <div class="form-group">
            <label for="animal_id">Animal:</label>
            <select name="animal_id" id="animal_id" class="form-control" required>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('listos'), 'animal');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('animal')->value) {
$foreach0DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('animal')->getId();?>
" <?php if ($_smarty_tpl->getValue('animal')->getId() == $_smarty_tpl->getValue('adopcion')->getIdAnimal()) {?>selected<?php }?>>
                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('animal')->getNombre(), ENT_QUOTES, 'UTF-8', true);?>
 (ID: <?php echo $_smarty_tpl->getValue('animal')->getId();?>
)
                    </option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
            <small class="form-text text-muted">Incluye animales listos y el animal actualmente asignado.</small>
        </div>

        <div class="form-group">
            <label for="adoptante_id">Adoptante:</label>
            <select name="adoptante_id" id="adoptante_id" class="form-control" required>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('habilitados'), 'adoptante');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('adoptante')->value) {
$foreach1DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
" <?php if ($_smarty_tpl->getValue('adoptante')->getId() == $_smarty_tpl->getValue('adopcion')->getIdAdoptante()) {?>selected<?php }?>>
                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('adoptante')->getNombre(), ENT_QUOTES, 'UTF-8', true);?>
 (ID: <?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
)
                    </option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
            <small class="form-text text-muted">Incluye adoptantes habilitados y el adoptante actualmente asignado.</small>
        </div>
        
        <div class="form-group">
            <label for="fecha">Fecha de Adopción:</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $_smarty_tpl->getValue('adopcion')->getFechaAdopcion();?>
" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="index.php?action=verHistorialAdopciones" class="btn btn-secondary">Cancelar</a>
    </form>
</div><?php }
}
