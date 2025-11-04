<div class="listado-animales">
    <h2>{$titulo}</h2>
    <p><a href="index.php?action=registrarAnimal" class="btn-primary">Registrar Nuevo Animal</a></p>

    {if $animales}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
      
              <th>Especie</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
      
          {foreach $animales as $animal}
                    {* CRÍTICO: Verifica que el elemento NO sea null *}
                    {if $animal} 
                    <tr>
                
        <td>{$animal->getId()}</td>
                        <td>{$animal->getNombre()}</td>
                        <td>{$animal->getEspecie()}</td>
                        <td>{$animal->getEstado()}</td>
                    
    <td>
                            {* Enlace para ver los detalles *}
                            <a href="index.php?action=verDetallesAnimal&id={$animal->getId()}">Ver</a> |
{* Enlace para modificar *}
                            <a href="index.php?action=modificarAnimal&id={$animal->getId()}">Modificar</a> |
{* Enlace de borrado: AHORA LLEVA A LA PÁGINA DE CONFIRMACIÓN PHP *}
                            <a href="index.php?action=confirmarBorradoAnimal&id={$animal->getId()}" class="btn-peligro">
                                Borrar
                            </a>
                        </td>
           
         </tr>
                    {/if}
                {/foreach}
            </tbody>
        </table>
    {else}
        <p class="alerta">No hay animales registrados.</p>
    {/if}
</div>

{* NOTA: Se elimina el código JavaScript y Modal anterior, ya que usamos confirmación PHP. *}