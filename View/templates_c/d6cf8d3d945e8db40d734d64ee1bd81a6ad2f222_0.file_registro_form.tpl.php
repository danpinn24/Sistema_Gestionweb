<?php
/* Smarty version 5.5.1, created on 2025-11-04 21:13:14
  from 'file:animales/registro_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690a5e5a212be9_18174275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd6cf8d3d945e8db40d734d64ee1bd81a6ad2f222' => 
    array (
      0 => 'animales/registro_form.tpl',
      1 => 1761602443,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5e5a212be9_18174275 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\animales';
?><div class="formulario-registro">
    <h2>Registrar Nuevo Animal</h2>

        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
        <p class="alerta error">❌ Error: <?php echo $_smarty_tpl->getValue('error');?>
</p>
    <?php }?>

    <form method="POST" action="index.php?action=registrarAnimal">
        
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="especie">Especie:</label><br>
        <input type="text" id="especie" name="especie" required><br><br>
        
        <label for="raza">Raza:</label><br>
        <input type="text" id="raza" name="raza"><br><br>
        
        <label for="edad">Edad (años):</label><br>
        <input type="number" id="edad" name="edad" required min="0"><br><br>
        
        <label for="sexo">Sexo (M/H):</label><br>
        <input type="text" id="sexo" name="sexo" maxlength="1"><br><br>
        
        <label for="caracteristicasFisicas">Características Físicas:</label><br>
        <textarea id="caracteristicasFisicas" name="caracteristicasFisicas"></textarea><br><br>
        
        <label for="estado">Estado de Adopción:</label><br>
        <select id="estado" name="estado">
            <option value="Listo para adopcion">Listo para adopción</option>
            <option value="En proceso">En proceso</option>
            <option value="Adoptado">Adoptado</option>
            <option value="En tratamiento">En tratamiento</option>
        </select><br><br>

        <button type="submit" class="btn-primary">Guardar Animal</button>
        
        <a href="index.php?action=listarAnimales" class="btn-secondary">Cancelar y Volver al Listado</a>
    </form>
</div><?php }
}
