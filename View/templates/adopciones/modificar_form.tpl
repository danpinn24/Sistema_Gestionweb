<div class="container mt-4">
    <h2>{$titulo}</h2>

    {if $error}
        <div class="alert alert-danger">{$error|escape}</div>
    {/if}

    <form action="index.php?action=modificarAdopcion" method="POST">
        {* Enviamos el ID de la adopción de forma oculta *}
        <input type="hidden" name="id_adopcion" value="{$adopcion->getIdAdopcion()}">

        <div class="form-group">
            <label for="animal_id">Animal:</label>
            <select name="animal_id" id="animal_id" class="form-control" required>
                {foreach from=$listos item=animal}
                    <option value="{$animal->getId()}" {if $animal->getId() == $adopcion->getIdAnimal()}selected{/if}>
                        {$animal->getNombre()|escape} (ID: {$animal->getId()})
                    </option>
                {/foreach}
            </select>
            <small class="form-text text-muted">Incluye animales listos y el animal actualmente asignado.</small>
        </div>

        <div class="form-group">
            <label for="adoptante_id">Adoptante:</label>
            <select name="adoptante_id" id="adoptante_id" class="form-control" required>
                {foreach from=$habilitados item=adoptante}
                    <option value="{$adoptante->getId()}" {if $adoptante->getId() == $adopcion->getIdAdoptante()}selected{/if}>
                        {$adoptante->getNombre()|escape} (ID: {$adoptante->getId()})
                    </option>
                {/foreach}
            </select>
            <small class="form-text text-muted">Incluye adoptantes habilitados y el adoptante actualmente asignado.</small>
        </div>
        
        <div class="form-group">
            <label for="fecha">Fecha de Adopción:</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{$adopcion->getFechaAdopcion()}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="index.php?action=verHistorialAdopciones" class="btn btn-secondary">Cancelar</a>
    </form>
</div>