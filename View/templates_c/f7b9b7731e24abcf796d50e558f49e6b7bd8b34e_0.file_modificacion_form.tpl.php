<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:13:05
  from 'file:animales/modificacion_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a5e51a0fa58_31844550',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7b9b7731e24abcf796d50e558f49e6b7bd8b34e' => 
    array (
      0 => 'animales/modificacion_form.tpl',
      1 => 1762205785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5e51a0fa58_31844550 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\animales';
?><div class="formulario-registro">
    <h2>Modificar Animal: <?php echo $_smarty_tpl->getValue('animal')->getNombre();?>
</h2>

        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
        <p class="alerta error">❌ Error: <?php echo $_smarty_tpl->getValue('error');?>
</p>
    <?php }?>

    <form method="POST" action="index.php?action=modificarAnimal&id=<?php echo $_smarty_tpl->getValue('animal')->getId();?>
">
        
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('animal')->getId();?>
">

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $_smarty_tpl->getValue('animal')->getNombre();?>
" required><br><br>
        
        <label for="especie">Especie:</label><br>
        <input type="text" id="especie" name="especie" value="<?php echo $_smarty_tpl->getValue('animal')->getEspecie();?>
" required><br><br>
        
        <label for="raza">Raza:</label><br>
        <input type="text" id="raza" name="raza" value="<?php echo $_smarty_tpl->getValue('animal')->getRaza();?>
"><br><br>
        
        <label for="edad">Edad (años):</label><br>
        <input type="number" id="edad" name="edad" value="<?php echo $_smarty_tpl->getValue('animal')->getEdad();?>
" required min="0"><br><br>
        
        <label for="sexo">Sexo (M/H):</label><br>
        <input type="text" id="sexo" name="sexo" value="<?php echo $_smarty_tpl->getValue('animal')->getSexo();?>
" maxlength="1"><br><br>
        
        <label for="caracteristicasFisicas">Características Físicas:</label><br>
        <textarea id="caracteristicasFisicas" name="caracteristicasFisicas"><?php echo $_smarty_tpl->getValue('animal')->getCaracteristicasFisicas();?>
</textarea><br><br>
        
        <label for="estado">Estado de Adopción:</label><br>
        <select id="estado" name="estado">
            <option value="Listo para adopcion" <?php if ($_smarty_tpl->getValue('animal')->getEstado() == 'Listo para adopcion') {?>selected<?php }?>>Listo para adopción</option>
            <option value="En proceso" <?php if ($_smarty_tpl->getValue('animal')->getEstado() == 'En proceso') {?>selected<?php }?>>En proceso</option>
            <option value="Adoptado" <?php if ($_smarty_tpl->getValue('animal')->getEstado() == 'Adoptado') {?>selected<?php }?>>Adoptado</option>
            <option value="En tratamiento" <?php if ($_smarty_tpl->getValue('animal')->getEstado() == 'En tratamiento') {?>selected<?php }?>>En tratamiento</option>
        </select><br><br>

        <button type="submit" class="btn-primary">Actualizar Animal</button>
        
        <a href="index.php?action=listarAnimales" class="btn-secondary">Cancelar y Volver al Listado</a>
    </form>
</div><?php }
}
