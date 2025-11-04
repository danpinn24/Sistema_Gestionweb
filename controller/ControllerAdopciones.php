<?php
// controlador/ControllerAdopciones.php

// Incluye el controlador base (AppController) que maneja Smarty
require_once __DIR__ . '/AppController.php'; 
require_once __DIR__ . '/../model/ModelAdopcion.php';
require_once __DIR__ . '/../model/ModelAnimal.php'; 
require_once __DIR__ . '/../model/ModelAdoptante.php'; 

// Eliminar el require_once para ViewAdopciones.php

class ControllerAdopciones extends AppController {
    
    public function __construct($db) {
        // Llama al constructor padre para inicializar Smarty y la DB
        parent::__construct($db);
    }

    // Método para mostrar el menú de adopciones (Ahora es un listado web)
    public function mostrarMenuAdopciones() {
        
        // Simplemente redirige al listado principal de animales disponibles (una acción común)
        header('Location: index.php?action=verAnimalesDisponibles');
        exit;
        
        // Si quisieras un menú de opciones aquí:
        /*
        $menuAdopciones = [
            ['nombre' => 'Ver Animales Disponibles', 'url' => '?action=verAnimalesDisponibles'],
            ['nombre' => 'Ver Adoptantes Habilitados', 'url' => '?action=verAdoptantesHabilitados'],
            ['nombre' => 'Realizar Adopción', 'url' => '?action=formAdopcion'],
            // etc.
        ];
        $this->render('adopciones/menu.tpl', 'Gestión de Adopciones', ['menu' => $menuAdopciones]);
        */
    }

    public function verAnimalesDisponibles() {
        $animales = $this->db->getAnimales();
        
        // Filtra animales que están listos para adopción
        $listos = array_filter($animales, function($a) {
            return strtolower($a->getEstado()) === 'listo para adopcion';
        });

        // Utiliza el método render de AppController para mostrar la vista
        $this->render(
            'adopciones/animales_disponibles.tpl', 
            'Animales Listos para Adopción', 
            ['listos' => $listos]
        );
    }
    
    // Método para mostrar la lista de adoptantes habilitados (Nuevo método web)
    public function verAdoptantesHabilitados() {
        $adoptantes = $this->db->getAdoptantes();

        $habilitados = array_filter($adoptantes, function($a) {
            return $a->cumpleRequisitos();
        });

        $this->render(
            'adopciones/adoptantes_habilitados.tpl', 
            'Adoptantes Habilitados', 
            ['habilitados' => $habilitados]
        );
    }

    // NOTA: Los métodos realizarAdopcion, modificarAdopcion, etc., deben ser reescritos
    // para procesar datos de formularios $_POST en lugar de leer de la consola.
    public function realizarAdopcion() {
        // En un entorno web, esto sería un formulario POST

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lógica de procesamiento de formulario:
            $idAnimal = (int) $_POST['animal_id'];
            $idAdoptante = (int) $_POST['adoptante_id'];
            
            $animalSeleccionado = $this->db->buscarAnimalPorId($idAnimal);
            $adoptanteSeleccionado = $this->db->buscarAdoptantePorId($idAdoptante);

            if ($animalSeleccionado && $adoptanteSeleccionado) {
                $animalSeleccionado->setEstado('Adoptado');
                $fechaActual = date('Y-m-d');

                $nuevaAdopcion = new Adopcion($idAnimal, $idAdoptante, $fechaActual);
                $this->db->agregarAdopcion($nuevaAdopcion);
                
                header('Location: index.php?action=verHistorialAdopciones&msg=Adopción realizada con éxito.');
                exit;
            } else {
                // Si falla la búsqueda o validación, redirigir al formulario con error
                header('Location: index.php?action=formAdopcion&error=Datos inválidos.');
                exit;
            }
        }
        
        // Si es método GET, muestra el formulario de selección de adopción
        $listos = array_filter($this->db->getAnimales(), function($a) { return strtolower($a->getEstado()) === 'listo para adopcion'; });
        $habilitados = array_filter($this->db->getAdoptantes(), function($a) { return $a->cumpleRequisitos(); });
        
        $this->render(
            'adopciones/realizar_adopcion_form.tpl', 
            'Realizar Nueva Adopción', 
            ['listos' => $listos, 'habilitados' => $habilitados]
        );
    }
    
    // ... y se crean los métodos verHistorialAdopciones, modificarAdopcion, etc.
}
?>