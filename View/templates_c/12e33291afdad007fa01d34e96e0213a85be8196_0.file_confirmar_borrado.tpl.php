<?php
/* Smarty version 5.5.1, created on 2025-11-07 01:24:47
  from 'file:adopciones/confirmar_borrado.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690d3c4f256914_25336990',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12e33291afdad007fa01d34e96e0213a85be8196' => 
    array (
      0 => 'adopciones/confirmar_borrado.tpl',
      1 => 1762475054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690d3c4f256914_25336990 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adopciones';
?>

<div class="container mt-4">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <h2><?php echo $_smarty_tpl->getValue('titulo');?>
</h2>
        </div>
        <div class="card-body">
            <p class="lead">¿Está seguro de que desea anular la adopción de <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('animal_nombre'), ENT_QUOTES, 'UTF-8', true);?>
</strong> por <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('adoptante_nombre'), ENT_QUOTES, 'UTF-8', true);?>
</strong>?</p>
            <p><strong>ID de Adopción:</strong> <?php echo $_smarty_tpl->getValue('adopcion')->getIdAdopcion();?>
</p>
            <p><strong>Fecha:</strong> <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('adopcion')->getFechaAdopcion(),"%d/%m/%Y");?>
</p>
            
            <div class="alert alert-warning">
                <strong><i class="fas fa-exclamation-triangle"></i> ¡Atención!</strong>
                Si confirma, esta acción no se puede deshacer. El animal <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('animal_nombre'), ENT_QUOTES, 'UTF-8', true);?>
</strong> volverá a estar disponible para adopción (estado "Listo para adopcion").
            </div>

            <form action="index.php?action=borrarAdopcion" method="POST" class="mt-4">
                <input type="hidden" name="id_adopcion" value="<?php echo $_smarty_tpl->getValue('adopcion')->getIdAdopcion();?>
">
                
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Sí, anular adopción
                </button>
                <a href="index.php?action=verHistorialAdopciones" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>

<?php }
}
