<div class="formulario-registro">
    <h2>Registrar Nuevo Animal</h2>

    {* Mostrar el error si existe *}
    {if isset($error)}
        <p class="alerta error">❌ Error: {$error}</p>
    {/if}

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
</div>