<div class="formulario-adopcion">
    <h2>Realizar Nueva Adopción</h2>
    
    {if isset($error)}
        <p class="alerta error">❌ Error: {$error}</p>
    {/if}

    <form method="POST" action="index.php?action=realizarAdopcion">
        
        <label for="animal_id">Seleccionar Animal (Listo para Adopción):</label><br>
        <select id="animal_id" name="animal_id" required>
            <option value="">-- Seleccione un Animal --</option>
            {foreach $listos as $animal}
                <option value="{$animal->getId()}">ID {$animal->getId()} - {$animal->getNombre()} ({$animal->getEspecie()})</option>
            {/foreach}
        </select><br><br>

        <label for="adoptante_id">Seleccionar Adoptante (Habilitado):</label><br>
        <select id="adoptante_id" name="adoptante_id" required>
            <option value="">-- Seleccione un Adoptante --</option>
            {foreach $habilitados as $adoptante}
                <option value="{$adoptante->getId()}">ID {$adoptante->getId()} - {$adoptante->getNombre()} (DNI: {$adoptante->getDni()})</option>
            {/foreach}
        </select><br><br>
        
        <p class="alerta peligro">⚠️ Al confirmar, el estado del animal cambiará a **"Adoptado"**.</p>

        <button type="submit" class="btn-primary">Confirmar y Registrar Adopción</button>
        
        <a href="index.php?action=menuPrincipal" class="btn-secondary">Cancelar</a>
    </form>
</div>