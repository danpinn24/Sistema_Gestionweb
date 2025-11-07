

<div class="container mt-4">
    <h2>{$titulo} (ID: {$adopcion->getIdAdopcion()})</h2>

    <div class="card">
        <div class="card-header">
            <strong>Fecha de Adopción:</strong> {$adopcion->getFechaAdopcion()|date_format:"%d/%m/%Y"}
        </div>
        <div class="card-body">
            <h5 class="card-title">Datos del Animal</h5>
            {if $animal}
                <p><strong>Nombre:</strong> {$animal->getNombre()|escape}</p>
                <p><strong>Especie:</strong> {$animal->getEspecie()|escape}</p>
                <p><strong>Raza:</strong> {$animal->getRaza()|escape}</p>
                <p><strong>Estado Actual:</strong> <span class="badge bg-success">{$animal->getEstado()|escape}</span></p>
            {else}
                <div class="alert alert-warning">Animal no encontrado (ID: {$adopcion->getIdAnimal()}).</div>
            {/if}
            
            <hr>

            <h5 class="card-title">Datos del Adoptante</h5>
            {if $adoptante}
                <p><strong>Nombre:</strong> {$adoptante->getNombre()|escape}</p>
                <p><strong>Email:</strong> {$adoptante->getEmail()|escape}</p>
                <p><strong>Teléfono:</strong> {$adoptante->getTelefono()|escape}</p>
                <p><strong>Requisitos:</strong> {if $adoptante->cumpleRequisitos()} <span class="badge bg-success">Cumple</span> {else} <span class="badge bg-danger">No Cumple</span> {/if}</p>
            {else}
                <div class="alert alert-warning">Adoptante no encontrado (ID: {$adopcion->getIdAdoptante()}).</div>
            {/if}
        </div>
        <div class="card-footer">
             <a href="index.php?action=verHistorialAdopciones" class="btn btn-primary">
                <i class="fas fa-list"></i> Volver al Historial
            </a>
            <a href="index.php?action=modificarAdopcion&id={$adopcion->getIdAdopcion()}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modificar
            </a>
        </div>
    </div>
</div>

