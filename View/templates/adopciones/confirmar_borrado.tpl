

<div class="container mt-4">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <h2>{$titulo}</h2>
        </div>
        <div class="card-body">
            <p class="lead">¿Está seguro de que desea anular la adopción de <strong>{$animal_nombre|escape}</strong> por <strong>{$adoptante_nombre|escape}</strong>?</p>
            <p><strong>ID de Adopción:</strong> {$adopcion->getIdAdopcion()}</p>
            <p><strong>Fecha:</strong> {$adopcion->getFechaAdopcion()|date_format:"%d/%m/%Y"}</p>
            
            <div class="alert alert-warning">
                <strong><i class="fas fa-exclamation-triangle"></i> ¡Atención!</strong>
                Si confirma, esta acción no se puede deshacer. El animal <strong>{$animal_nombre|escape}</strong> volverá a estar disponible para adopción (estado "Listo para adopcion").
            </div>

            <form action="index.php?action=borrarAdopcion" method="POST" class="mt-4">
                <input type="hidden" name="id_adopcion" value="{$adopcion->getIdAdopcion()}">
                
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

