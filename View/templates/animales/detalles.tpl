<div class="detalles-animal">
    <h2>Detalles de {$animal->getNombre()}</h2>

    <p><strong>ID:</strong> {$animal->getId()}</p>
    <p><strong>Especie:</strong> {$animal->getEspecie()}</p>
    <p><strong>Raza:</strong> {$animal->getRaza()|default:'(No especificada)'}</p>
    <p><strong>Edad:</strong> {$animal->getEdad()} años</p>
    <p><strong>Sexo:</strong> {$animal->getSexo()|default:'(No especificado)'}</p>
    <p><strong>Estado:</strong> **{$animal->getEstado()}**</p>
    <p><strong>Fecha de Ingreso:</strong> {$animal->getFechaIngreso()}</p>
    <p><strong>Características Físicas:</strong> 
        {$animal->getCaracteristicasFisicas()|default:'(No hay descripción)'}
    </p>

    <a href="index.php?action=modificarAnimal&id={$animal->getId()}" class="btn-primary">Modificar Animal</a>
    <a href="index.php?action=listarAnimales" class="btn-secondary">Volver al Listado</a>
</div>