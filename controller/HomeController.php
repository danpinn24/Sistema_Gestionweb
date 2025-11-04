<?php
// controller/HomeController.php

// Asume que AppController.php está en el mismo nivel o es accesible
require_once 'controller/AppController.php';

class HomeController extends AppController {
    
    // El constructor hereda la instancia de DB y configura Smarty
    public function __construct(DB $db) {
        parent::__construct($db);
    }
    
    /**
     * Renderiza la página de bienvenida (el hub principal).
     */
    public function home() {
        $titulo = 'Bienvenido al Sistema de Gestión';
        
        // 💡 Renderiza la plantilla principal 'home.tpl'
        // NOTA: Si 'home.tpl' está dentro de una subcarpeta (ej: 'templates/general/home.tpl'), ajusta la ruta aquí.
        $this->render('home.tpl', $titulo); 
    }
}
?>