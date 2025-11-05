<div class="detalles-adoptante">
    <h2>Detalles del Adoptante: {$adoptante->getNombre()}</h2>

    <p><strong>ID de Adoptante:</strong> {$adoptante->getId()}</p>
    <p><strong>DNI/Identificación:</strong> {$adoptante->getDni()}</p>
    <p><strong>Teléfono:</strong> {$adoptante->getTelefono()}</p>
    <p><strong>Email:</strong> {$adoptante->getEmail()|default:'(No especificado)'}</p>
    <p><strong>Dirección:</strong> {$adoptante->getDireccion()|default:'(No especificada)'}</p>
    
    <p>
        <strong>Estado de Habilitación:</strong> 
        {if $adoptante->cumpleRequisitos()}
            <span style="color: green; font-weight: 700;">✅ HABILITADO</span>
        {else}
            <span style="color: red; font-weight: 700;">❌ NO HABILITADO</span>
        {/if}
    </p>

    <div style="margin-top: 30px;">
        <a href="index.php?action=modificarAdoptante&id={$adoptante->getId()}" class="btn-primary">Modificar Adoptante</a>
        <a href="index.php?action=listarAdoptantes" class="btn-secondary" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</div>