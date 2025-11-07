<?php
/* Smarty version 5.5.1, created on 2025-11-07 01:23:07
  from 'file:adopciones/detalles.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690d3beb515ac9_61814369',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d5ea217e50766d8417d6c296a0406d3beb856c2' => 
    array (
      0 => 'adopciones/detalles.tpl',
      1 => 1762474022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690d3beb515ac9_61814369 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates\\adopciones';
?>

<div class="container mt-4">
    <h2><?php echo $_smarty_tpl->getValue('titulo');?>
 (ID: <?php echo $_smarty_tpl->getValue('adopcion')->getIdAdopcion();?>
)</h2>

    <div class="card">
        <div class="card-header">
            <strong>Fecha de Adopción:</strong> <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('adopcion')->getFechaAdopcion(),"%d/%m/%Y");?>

        </div>
        <div class="card-body">
            <h5 class="card-title">Datos del Animal</h5>
            <?php if ($_smarty_tpl->getValue('animal')) {?>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('animal')->getNombre(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                <p><strong>Especie:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('animal')->getEspecie(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                <p><strong>Raza:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('animal')->getRaza(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                <p><strong>Estado Actual:</strong> <span class="badge bg-success"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('animal')->getEstado(), ENT_QUOTES, 'UTF-8', true);?>
</span></p>
            <?php } else { ?>
                <div class="alert alert-warning">Animal no encontrado (ID: <?php echo $_smarty_tpl->getValue('adopcion')->getIdAnimal();?>
).</div>
            <?php }?>
            
            <hr>

            <h5 class="card-title">Datos del Adoptante</h5>
            <?php if ($_smarty_tpl->getValue('adoptante')) {?>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('adoptante')->getNombre(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('adoptante')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('adoptante')->getTelefono(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                <p><strong>Requisitos:</strong> <?php if ($_smarty_tpl->getValue('adoptante')->cumpleRequisitos()) {?> <span class="badge bg-success">Cumple</span> <?php } else { ?> <span class="badge bg-danger">No Cumple</span> <?php }?></p>
            <?php } else { ?>
                <div class="alert alert-warning">Adoptante no encontrado (ID: <?php echo $_smarty_tpl->getValue('adopcion')->getIdAdoptante();?>
).</div>
            <?php }?>
        </div>
        <div class="card-footer">
             <a href="index.php?action=verHistorialAdopciones" class="btn btn-primary">
                <i class="fas fa-list"></i> Volver al Historial
            </a>
            <a href="index.php?action=modificarAdopcion&id=<?php echo $_smarty_tpl->getValue('adopcion')->getIdAdopcion();?>
" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modificar
            </a>
        </div>
    </div>
</div>

<?php }
}
