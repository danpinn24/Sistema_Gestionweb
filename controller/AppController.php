<?php
// controller/AppController.php

require_once 'db/class_db.php'; 

// 🚨 CORRECCIÓN FINAL DE RUTA: Sube un nivel (../) de 'controller' a la raíz
require_once __DIR__ . '/../librerias/smarty-5.5.1/libs/Smarty.class.php'; 

abstract class AppController {
    protected DB $db;
    protected $smarty;
    protected $nav_items; // Array para los ítems de navegación

    public function __construct(DB $db) {
        $this->db = $db;
        
        // 1. Obtener la ruta absoluta de la raíz del proyecto
        $root_path = dirname(__DIR__); 
        
        // 2. Inicialización de Smarty
        $this->smarty = new \Smarty\Smarty(); 
        
        // CONFIGURACIÓN DE RUTAS ABSOLUTAS
        $this->smarty->setTemplateDir($root_path . '/View/templates/'); 
        $this->smarty->setCompileDir($root_path . '/View/templates_c/'); 
        $this->smarty->setCacheDir($root_path . '/View/cache/');
        
        // Configuración adicional
        $this->smarty->setCaching(\Smarty\Smarty::CACHING_OFF);
        $this->smarty->setCompileCheck(true);

        // ===========================================
        // 💡 CRÍTICO: DEFINICIÓN DE LA NAVEGACIÓN
        // ===========================================
        $this->nav_items = [
            ['nombre' => '🏠 Inicio', 'url' => 'index.php?action=menuPrincipal'], 
            ['nombre' => 'Animales', 'url' => 'index.php?action=listarAnimales'],
            ['nombre' => 'Adoptantes', 'url' => 'index.php?action=listarAdoptantes'],
            // ENLACES DE ADOPCIONES AÑADIDOS
            ['nombre' => '📝 Nueva Adopción', 'url' => 'index.php?action=realizarAdopcion'],
            ['nombre' => '📋 Historial Adopciones', 'url' => 'index.php?action=verHistorialAdopciones'],
        ];
        // ===========================================
    }
    
    /**
     * Verifica si el usuario está logueado.
     */
    protected function estaLogueado(): bool {
        return $_SESSION['logueado'] ?? false;
    }

    /**
     * Redirige al login si el usuario no está logueado.
     */
    protected function protegerAcceso() {
        if (!$this->estaLogueado()) {
            $mensaje = urlencode("Debes iniciar sesión para acceder a esta página.");
            header('Location: index.php?action=home&error_login=' . $mensaje);
            exit;
        }
    }

    /**
     * Muestra la plantilla principal inyectando el contenido y los datos.
     */
    protected function render($template, $titulo, $data = []) {
        
        // 1. Asignar datos base
        $this->smarty->assign('CSS_PATH', 'style.css'); 
        $this->smarty->assign('titulo', $titulo);
        
        // 2. Asignar navegación (basada en si está logueado)
        if ($this->estaLogueado()) {
            $nav = $this->nav_items;
            // Añadir el enlace de Cerrar Sesión
            $nav[] = ['nombre' => '❌ Cerrar Sesión (' . ($_SESSION['username'] ?? 'Usuario') . ')', 'url' => 'index.php?action=logout'];
            $this->smarty->assign('nav_items', $nav);
        } else {
            // Mostrar solo Home si no está logueado
            $this->smarty->assign('nav_items', [['nombre' => '🏠 Inicio', 'url' => 'index.php?action=home']]);
        }
        
        // 3. Asignar datos específicos del controlador
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        
        // 4. Renderizar
        $this->smarty->assign('contenido_tpl', $template);
        $this->smarty->display('base.tpl');
    }
}
?>