<div class="container mt-4">
    <h2>{$titulo}</h2>

    {* Mostrar mensajes de éxito o error si existen (vienen por URL) *}
    {if isset($smarty.get.msg)}
        <div class="alert alert-success">{$smarty.get.msg|escape}</div>
    {/if}
    {if isset($smarty.get.error)}
        <div class="alert alert-danger">{$smarty.get.error|escape}</div>
    {/if}

    {if empty($historial)}
        <div class="alert alert-info">Aún no se han registrado adopciones.</div>
    {else}
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Animal</th>
                    <th>Adoptante</th>
                    <th>Fecha de Adopción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$historial item=adopcion}
                <tr>
                    <td>{$adopcion.animal_nombre|escape}</td>
                    <td>{$adopcion.adoptante_nombre|escape}</td>
                    <td>{$adopcion.fecha|date_format:"%d-%m-%Y"}</td>
                    
                    {* --- CELDA DE ACCIONES (MODIFICADA) --- *}
                    <td class="text-nowrap">
                        <a href="index.php?action=verDetallesAdopcion&id={$adopcion.id}">
                            Ver
                        </a> |
                        <a href="index.php?action=modificarAdopcion&id={$adopcion.id}">
                            Modificar
                        </a> |
                        <a href="index.php?action=confirmarBorradoAdopcion&id={$adopcion.id}" class="btn btn-danger btn-sm">
                            Borrar
                        </a>
                    </td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
    
    <a href="index.php?action=menuPrincipal" class="btn btn-secondary mt-3">Volver al Menú</a>
</div>