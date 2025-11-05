<div class="confirmacion">
    <h2>Confirmar Borrado de Adoptante</h2>
    
    <h3>¿Estás seguro de que deseas eliminar a "{$adoptante->getNombre()}"?</h3>

    <div class="alerta peligro" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 4px; margin-top: 15px;">
        <p>Esta acción es **irreversible** y eliminará permanentemente el registro del adoptante con ID: **{$adoptante->getId()}**.</p>
    </div>

    <div class="acciones-confirmacion" style="margin-top: 20px;">
        
        {* Botón que ejecuta la acción de borrado final en el servidor *}
        <a href="index.php?action=borrarAdoptante&id={$adoptante->getId()}" class="btn-peligro">
            Sí, Confirmar Eliminación
        </a>
        
        {* Botón para cancelar y volver al listado *}
        <a href="index.php?action=listarAdoptantes" class="btn-secondary" style="margin-left: 10px;">
            No, Cancelar y Volver
        </a>
    </div>
</div>