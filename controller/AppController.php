<?php

require_once 'db/class_db.php'; 

require_once __DIR__ . '/../librerias/smarty-5.5.1/libs/Smarty.class.php'; 

abstract class AppController {
    protected DB $db;
    protected $smarty;
    protected $nav_items;

    public function __construct(DB $db) {
        $this->db = $db;
    
        $root_path = dirname(__DIR__); 

        $this->smarty = new \Smarty\Smarty(); 

        $this->smarty->setTemplateDir($root_path . '/View/templates/'); 
        $this->smarty->setCompileDir($root_path . '/View/templates_c/'); 
        $this->smarty->setCacheDir($root_path . '/View/cache/');
        

        $this->smarty->setCaching(\Smarty\Smarty::CACHING_OFF);
        $this->smarty->setCompileCheck(true);


        $this->nav_items = [
            ['nombre' => '🏠 Inicio', 'url' => 'index.php?action=menuPrincipal'], 
            ['nombre' => 'Animales', 'url' => 'index.php?action=listarAnimales'],
            ['nombre' => 'Adoptantes', 'url' => 'index.php?action=listarAdoptantes'],
            ['nombre' => '📝 Nueva Adopción', 'url' => 'index.php?action=realizarAdopcion'],
            ['nombre' => '📋 Historial Adopciones', 'url' => 'index.php?action=verHistorialAdopciones'],
        ];
    
    }
    
    protected function estaLogueado(): bool {
        return $_SESSION['logueado'] ?? false;
    }

    protected function protegerAcceso() {
        if (!$this->estaLogueado()) {
            $mensaje = urlencode("Debes iniciar sesión para acceder a esta página.");
            header('Location: index.php?action=home&error_login=' . $mensaje);
            exit;
        }
    }

    protected function render($template, $titulo, $data = []) {
    
        $this->smarty->assign('CSS_PATH', 'style.css'); 
        $this->smarty->assign('titulo', $titulo);
        
        if ($this->estaLogueado()) {
            $nav = $this->nav_items;
            $nav[] = ['nombre' => '❌ Cerrar Sesión (' . ($_SESSION['username'] ?? 'Usuario') . ')', 'url' => 'index.php?action=logout'];
            $this->smarty->assign('nav_items', $nav);
        } else {
            $this->smarty->assign('nav_items', [['nombre' => '🏠 Inicio', 'url' => 'index.php?action=home']]);
        }
        
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        $this->smarty->assign('contenido_tpl', $template);
        $this->smarty->display('base.tpl');
    }
}
?>