<?php
// controlador/controllerAdoptante.php

require_once __DIR__ . '/AppController.php'; 
require_once __DIR__ . '/../model/ModelAdoptante.php';

class ControllerAdoptante extends AppController {

    public function __construct($db) {
        parent::__construct($db);
    }

    public function listarAdoptantes() {
        $adoptantes = $this->db->getAdoptantes();
        
        $this->render(
            'adoptantes/lista.tpl', 
            'Lista de Adoptantes', 
            ['adoptantes' => $adoptantes]
        );
    }
    
    // Nota: Se elimina el método `ejecutarMenu()` que era de consola.
    // ... Y el resto de métodos (registrar, modificar, borrar) se adaptan como en ControllerAnimales.
}
?>