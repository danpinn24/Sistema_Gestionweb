<div class="formulario-registro">
    <h2>Modificar Adoptante: {$adoptante->getNombre()}</h2>

    {* Mostrar el error de validación si existe *}
    {if isset($error)}
        <p class="alerta error">❌ Error: {$error}</p>
    {/if}

    <form method="POST" action="index.php?action=modificarAdoptante&id={$adoptante->getId()}">
        
        <input type="hidden" name="id" value="{$adoptante->getId()}">

        <label for="nombre">Nombre Completo:</label><br>
        <input type="text" id="nombre" name="nombre" value="{$adoptante->getNombre()}" required><br><br>
        
        <label for="dni">DNI/Identificación:</label><br>
        <input type="text" id="dni" name="dni" value="{$adoptante->getDni()}" required><br><br>
        
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="{$adoptante->getTelefono()}" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{$adoptante->getEmail()}"><br><br>
        
        <label for="direccion">Dirección:</label><br>
        <textarea id="direccion" name="direccion">{$adoptante->getDireccion()}</textarea><br><br>

        <label for="requisitosCumplidos">¿Cumple Requisitos para Adopción (Habilitado)?</label><br>
        <input type="checkbox" id="requisitosCumplidos" name="requisitosCumplidos" 
            {if $adoptante->cumpleRequisitos()}checked{/if}
        ><br><br>

        <button type="submit" class="btn-primary">Actualizar Adoptante</button>
        
        <a href="index.php?action=listarAdoptantes" class="btn-secondary">Cancelar y Volver al Listado</a>
    </form>
</div>