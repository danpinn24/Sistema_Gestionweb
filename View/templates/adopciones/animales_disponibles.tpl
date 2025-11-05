<div class="listado-disponibles">
    <h2>{$titulo}</h2>
    
    <p class="alerta exito">Estos animales están listos para ser asignados a un adoptante en la sección <a href="index.php?action=realizarAdopcion">Realizar Nueva Adopción</a>.</p>

    {if isset($listos) && count($listos) > 0}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {foreach $listos as $animal}
                    <tr>
                        <td>{$animal->getId()}</td>
                        <td>{$animal->getNombre()}</td>
                        <td>{$animal->getEspecie()}</td>
                        <td>{$animal->getRaza()|default:'N/A'}</td>
                        <td>
                            <a href="index.php?action=verDetallesAnimal&id={$animal->getId()}">Ver Detalles</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p class="alerta peligro">No hay animales con estado "Listo para Adopción" en el sistema.</p>
    {/if}
</div>