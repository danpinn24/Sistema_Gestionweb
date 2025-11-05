<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:36:55
  from 'file:adopciones/realizar_adopcion_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a63e71dacf4_20936113',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd959b10b1bb289f2885be22dc7e951444dabad25' => 
    array (
      0 => 'adopciones/realizar_adopcion_form.tpl',
      1 => 1762286981,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a63e71dacf4_20936113 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adopciones';
?><div class="formulario-adopcion">
    <h2>Realizar Nueva Adopción</h2>
    
    <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
        <p class="alerta error">❌ Error: <?php echo $_smarty_tpl->getValue('error');?>
</p>
    <?php }?>

    <form method="POST" action="index.php?action=realizarAdopcion">
        
        <label for="animal_id">Seleccionar Animal (Listo para Adopción):</label><br>
        <select id="animal_id" name="animal_id" required>
            <option value="">-- Seleccione un Animal --</option>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('listos'), 'animal');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('animal')->value) {
$foreach0DoElse = false;
?>
                <option value="<?php echo $_smarty_tpl->getValue('animal')->getId();?>
">ID <?php echo $_smarty_tpl->getValue('animal')->getId();?>
 - <?php echo $_smarty_tpl->getValue('animal')->getNombre();?>
 (<?php echo $_smarty_tpl->getValue('animal')->getEspecie();?>
)</option>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </select><br><br>

        <label for="adoptante_id">Seleccionar Adoptante (Habilitado):</label><br>
        <select id="adoptante_id" name="adoptante_id" required>
            <option value="">-- Seleccione un Adoptante --</option>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('habilitados'), 'adoptante');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('adoptante')->value) {
$foreach1DoElse = false;
?>
                <option value="<?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
">ID <?php echo $_smarty_tpl->getValue('adoptante')->getId();?>
 - <?php echo $_smarty_tpl->getValue('adoptante')->getNombre();?>
 (DNI: <?php echo $_smarty_tpl->getValue('adoptante')->getDni();?>
)</option>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </select><br><br>
        
        <p class="alerta peligro">⚠️ Al confirmar, el estado del animal cambiará a **"Adoptado"**.</p>

        <button type="submit" class="btn-primary">Confirmar y Registrar Adopción</button>
        
        <a href="index.php?action=menuPrincipal" class="btn-secondary">Cancelar</a>
    </form>
</div><?php }
}
