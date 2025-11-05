<div class="formulario-registro">
    <h2>Registrar Nuevo Adoptante</h2>

    {if isset($error)}
        <p class="alerta error">❌ Error: {$error}</p>
    {/if}

    <form method="POST" action="index.php?action=registrarAdoptante">
        
        <label for="nombre">Nombre Completo:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="dni">DNI/Identificación:</label><br>
        <input type="text" id="dni" name="dni" required><br><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="direccion">Dirección:</label><br>
        <textarea id="direccion" name="direccion"></textarea><br><br>

        <label for="requisitosCumplidos">¿Cumple Requisitos para Adopción?</label><br>
        <input type="checkbox" id="requisitosCumplidos" name="requisitosCumplidos"><br><br>

        <button type="submit" class="btn-primary">Guardar Adoptante</button>
        
        <a href="index.php?action=listarAdoptantes" class="btn-secondary">Cancelar y Volver</a>
    </form>
</div>