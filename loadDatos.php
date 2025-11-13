<?php

require_once 'model/ModelAnimal.php'; 
require_once 'model/ModelAdoptante.php';
require_once 'model/ModelAdopcion.php'; 


function loadDatos(DB $db) {
    
    if (count($db->getAnimales()) > 0) {
        return; 
    }

    $db->agregarAnimal(new Animal(
        'Fido', 
        'Perro', 
        'Labrador', 
        3, 
        'M', 
        'Grande y juguetón', 
        '2025-01-15', 
        'Listo para adopcion'
    ));
    $db->agregarAnimal(new Animal(
        'Luna', 
        'Gato', 
        'Siames', 
        1, 
        'H', 
        'Pelaje gris, ojos azules', 
        '2025-02-20', 
        'Listo para adopcion'
    ));
    $db->agregarAnimal(new Animal(
        'Rocky', 
        'Perro', 
        'Boxer', 
        5, 
        'M', 
        'Cicatriz en oreja', 
        '2025-03-01', 
        'En tratamiento'
    ));
    
    $db->agregarAdoptante(new Adoptante(
        'Juan Pérez', 
        '12345678', 
        'Calle Falsa 123', 
        '555-1234', 
        'juan@ej.com', 
        true
    ));
    $db->agregarAdoptante(new Adoptante(
        'Ana Gómez', 
        '87654321', 
        'Av. Siempre Viva', 
        '555-5678', 
        'ana@ej.com', 
        false
    ));
    
    $usuarios = [
        [
            'id' => 1,
            'username' => 'admin',
            'password' => '1234admin',
            'nombre' => 'Administrador',
            'rol' => 'admin'
        ],
        [
            'id' => 2,
            'username' => 'refugio',
            'password' => 'pass',
            'nombre' => 'Personal Refugio',
            'rol' => 'editor'
        ]
    ];

    foreach ($usuarios as $usuario) {
        $db->agregarUsuario($usuario); 
    }
}
?>