<div class="formulario-registro">
    <h2>Modificar Animal: {$animal->getNombre()}</h2>

    {* Aquí se mostraría el error de validación si es necesario *}
    {if isset($error)}
        <p class="alerta error">❌ Error: {$error}</p>
    {/if}

    <form method="POST" action="index.php?action=modificarAnimal&id={$animal->getId()}">
        
        <input type="hidden" name="id" value="{$animal->getId()}">

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="{$animal->getNombre()}" required><br><br>
        
        <label for="especie">Especie:</label><br>
        <input type="text" id="especie" name="especie" value="{$animal->getEspecie()}" required><br><br>
        
        <label for="raza">Raza:</label><br>
        <input type="text" id="raza" name="raza" value="{$animal->getRaza()}"><br><br>
        
        <label for="edad">Edad (años):</label><br>
        <input type="number" id="edad" name="edad" value="{$animal->getEdad()}" required min="0"><br><br>
        
        <label for="sexo">Sexo (M/H):</label><br>
        <input type="text" id="sexo" name="sexo" value="{$animal->getSexo()}" maxlength="1"><br><br>
        
        <label for="caracteristicasFisicas">Características Físicas:</label><br>
        <textarea id="caracteristicasFisicas" name="caracteristicasFisicas">{$animal->getCaracteristicasFisicas()}</textarea><br><br>
        
        <label for="estado">Estado de Adopción:</label><br>
        <select id="estado" name="estado">
            <option value="Listo para adopcion" {if $animal->getEstado() eq 'Listo para adopcion'}selected{/if}>Listo para adopción</option>
            <option value="En proceso" {if $animal->getEstado() eq 'En proceso'}selected{/if}>En proceso</option>
            <option value="Adoptado" {if $animal->getEstado() eq 'Adoptado'}selected{/if}>Adoptado</option>
            <option value="En tratamiento" {if $animal->getEstado() eq 'En tratamiento'}selected{/if}>En tratamiento</option>
        </select><br><br>

        <button type="submit" class="btn-primary">Actualizar Animal</button>
        
        <a href="index.php?action=listarAnimales" class="btn-secondary">Cancelar y Volver al Listado</a>
    </form>
</div>