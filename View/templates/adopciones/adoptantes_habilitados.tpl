<div class="listado-habilitados">
    <h2>{$titulo}</h2>
    
    <p class="alerta exito">Solo los adoptantes marcados como **"Habilitados"** aparecerán en esta lista y en el formulario de adopción.</p>

    {if isset($habilitados) && count($habilitados) > 0}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {foreach $habilitados as $adoptante}
                    <tr>
                        <td>{$adoptante->getId()}</td>
                        <td>{$adoptante->getNombre()}</td>
                        <td>{$adoptante->getDni()}</td>
                        <td>{$adoptante->getTelefono()}</td>
                        <td>
                            <a href="index.php?action=verDetallesAdoptante&id={$adoptante->getId()}">Ver Detalles</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p class="alerta peligro">No hay adoptantes marcados como "Habilitados" en el sistema.</p>
    {/if}
</div>