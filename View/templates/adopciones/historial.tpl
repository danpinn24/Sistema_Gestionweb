<div class="historial-adopciones">
    <h2>{$titulo}</h2>

    {if isset($historial) && count($historial) > 0}
        <table>
            <thead>
                <tr>
                    <th>ID Adopción</th>
                    <th>Animal Adoptado</th>
                    <th>Adoptante</th>
                    <th>Fecha</th>
                    {* Opcional: Agregar columna de Acciones si se permite anular la adopción *}
                </tr>
            </thead>
            <tbody>
                {foreach $historial as $registro}
                    <tr>
                        <td>{$registro.id}</td>
                        <td>{$registro.animal_nombre}</td>
                        <td>{$registro.adoptante_nombre}</td>
                        <td>{$registro.fecha}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p class="alerta">Aún no hay adopciones registradas en el sistema.</p>
    {/if}
</div>