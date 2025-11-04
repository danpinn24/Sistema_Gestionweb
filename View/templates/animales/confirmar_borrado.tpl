<div class="confirmacion">
    <h2>{$titulo}</h2>
    
    <h3>¿Estás seguro de que deseas eliminar a "{$animal->getNombre()}"?</h3>

    <div class="alerta peligro" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 4px; margin-top: 15px;">
        <p>Esta acción es **irreversible** y eliminará permanentemente el registro del animal con ID: **{$animal->getId()}**.</p>
    </div>

    <div class="acciones-confirmacion" style="margin-top: 20px;">
        
        {* Botón que ejecuta la acción de borrado final en el servidor (ControllerAnimales::borrarAnimal) *}
        <a href="index.php?action=borrarAnimal&id={$animal->getId()}" class="btn-peligro">
            Sí, Confirmar Eliminación
        </a>
        
        {* Botón para cancelar y volver al listado *}
        <a href="index.php?action=listarAnimales" class="btn-secondary" style="margin-left: 10px;">
            No, Cancelar y Volver
        </a>
    </div>
</div>