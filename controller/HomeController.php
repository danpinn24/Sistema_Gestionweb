<?php
// controller/HomeController.php

require_once __DIR__ . '/AppController.php'; 
require_once __DIR__ . '/../db/class_db.php';

class HomeController extends AppController {
    
    public function __construct(DB $db) {
        parent::__construct($db);
    }
    
    /**
     * Muestra el dashboard principal con estadísticas tras el login.
     */
    public function menuPrincipal() {
        $this->protegerAcceso(); 
        
        // 1. OBTENER DATOS PARA ESTADÍSTICAS
        // (Usamos los métodos que ya existen en tu class_db.php)
        $animales_totales = count($this->db->getAnimales());
        $animales_listos = count($this->db->getAnimalesListos());
        $adopciones_totales = count($this->db->getAdopciones());
        $adoptantes_habilitados = count($this->db->getAdoptantesHabilitados());

        // 2. AGRUPAR DATOS PARA LA PLANTILLA
        $stats = [
            'animales_totales' => $animales_totales,
            'animales_listos' => $animales_listos,
            'adopciones_totales' => $adopciones_totales,
            'adoptantes_habilitados' => $adoptantes_habilitados
        ];

        // 3. RENDERIZAR
        $this->render(
            'menu_principal.tpl', 
            'Dashboard de Bienvenida',
            [
                'username' => $_SESSION['username'] ?? 'Administrador',
                'stats' => $stats // 👈 Pasamos el nuevo array de estadísticas
            ]
        );
    }
}
?>