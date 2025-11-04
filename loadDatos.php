<?php
// loadDatos.php

// 1. Inclusión de Modelos
require_once 'model/ModelAnimal.php'; 
require_once 'model/ModelAdoptante.php';
require_once 'model/ModelAdopcion.php'; 


function loadDatos(DB $db) {
    
    // CRÍTICO: Comprobación para evitar duplicados
    if (count($db->getAnimales()) > 0) {
        return; 
    }
    
    // ===================================
    // 📌 DATOS DE EJEMPLO DE ANIMALES
    // ===================================
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
    
    // ===================================
    // 📌 DATOS DE EJEMPLO DE ADOPTANTES (DESCOMENTADO)
    // ===================================
    // ADVERTENCIA: Asegúrate de que la clase Adoptante existe en ModelAdoptante.php
    $db->agregarAdoptante(new Adoptante(
        'Juan Pérez', 
        '12345678', 
        'Calle Falsa 123', 
        '555-1234', 
        'juan@ej.com', 
        true // Habilitado
    ));
    $db->agregarAdoptante(new Adoptante(
        'Ana Gómez', 
        '87654321', 
        'Av. Siempre Viva', 
        '555-5678', 
        'ana@ej.com', 
        false // No habilitado
    ));
    
    // ===================================
    // 📌 DATOS DE EJEMPLO DE ADOPCIONES (Asegúrate de que la clase Adopcion existe)
    // ===================================
    /*$db->agregarAdopcion(new Adopcion(
        3, // ID Animal (Rocky)
        1, // ID Adoptante (Juan Pérez)
        '2025-04-10', 
        'Exitosa'
    ));*/
    
    // ===================================
    // 📌 DATOS DE USUARIOS (LOGIN)
    // ===================================
    $usuarios = [
        [
            'id' => 1,
            'username' => 'admin',
            'password' => '1234admin', // Clave de prueba para admin
            'nombre' => 'Administrador',
            'rol' => 'admin'
        ],
        [
            'id' => 2,
            'username' => 'refugio',
            'password' => 'pass', // Clave de prueba para editor
            'nombre' => 'Personal Refugio',
            'rol' => 'editor'
        ]
    ];

    foreach ($usuarios as $usuario) {
        $db->agregarUsuario($usuario); 
    }
}
?>