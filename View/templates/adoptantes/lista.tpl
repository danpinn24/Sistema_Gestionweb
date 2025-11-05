<div class="listado-adoptantes">
    <h2>{$titulo}</h2>
    <p><a href="index.php?action=registrarAdoptante" class="btn-primary">Registrar Nuevo Adoptante</a></p>

    {if isset($adoptantes) && count($adoptantes) > 0}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Habilitado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {foreach $adoptantes as $adoptante}
                    <tr>
                        <td>{$adoptante->getId()}</td>
                        <td>{$adoptante->getNombre()}</td>
                        <td>{$adoptante->getDni()}</td>
                        <td>{$adoptante->getTelefono()}</td>
                        <td>
                            {if $adoptante->cumpleRequisitos()}
                                <span style="color: green; font-weight: bold;">✅ SÍ</span>
                            {else}
                                <span style="color: red; font-weight: bold;">❌ NO</span>
                            {/if}
                        </td>
                        <td>
                            <a href="index.php?action=verDetallesAdoptante&id={$adoptante->getId()}">Ver</a> |
                            <a href="index.php?action=modificarAdoptante&id={$adoptante->getId()}">Modificar</a> |
                            <a href="index.php?action=confirmarBorradoAdoptante&id={$adoptante->getId()}" class="btn-peligro">Borrar</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p class="alerta">No hay adoptantes registrados.</p>
    {/if}
</div>