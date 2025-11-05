<?php
// controller/ControllerAdopciones.php (COMPLETO)

require_once __DIR__ . '/AppController.php'; 
require_once __DIR__ . '/../model/ModelAdopcion.php';
require_once __DIR__ . '/../model/ModelAnimal.php'; 
require_once __DIR__ . '/../model/ModelAdoptante.php'; 

class ControllerAdopciones extends AppController {
    
    public function __construct($db) {
        parent::__construct($db);
    }

    /**
     * Muestra los animales que tienen estado 'Listo para adopcion'.
     */
    public function verAnimalesDisponibles() {
        $this->protegerAcceso();
        
        $listos = $this->db->getAnimalesListos();

        $this->render(
            'adopciones/animales_disponibles.tpl', 
            'Animales Listos para Adopción', 
            ['listos' => $listos]
        );
    }
    
    /**
     * Muestra la lista de adoptantes que cumplen los requisitos.
     */
    public function verAdoptantesHabilitados() {
        $this->protegerAcceso();
        
        $habilitados = $this->db->getAdoptantesHabilitados();

        $this->render(
            'adopciones/adoptantes_habilitados.tpl', 
            'Adoptantes Habilitados', 
            ['habilitados' => $habilitados]
        );
    }

    /**
     * Muestra el formulario de selección y procesa la adopción.
     */
    public function realizarAdopcion() {
        $this->protegerAcceso();
        $error = null;
        
        $animales_listos = $this->db->getAnimalesListos(); 
        $adoptantes_habilitados = $this->db->getAdoptantesHabilitados(); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idAnimal = (int) ($_POST['animal_id'] ?? 0);
            $idAdoptante = (int) ($_POST['adoptante_id'] ?? 0);

            if ($idAnimal === 0 || $idAdoptante === 0) {
                 $error = 'Error: Debe seleccionar un Animal y un Adoptante válidos.';
            } else {
                $animalSeleccionado = $this->db->buscarAnimalPorId($idAnimal);

                if ($animalSeleccionado) {
                    // 1. Cambiar el estado del animal
                    $animalSeleccionado->setEstado('Adoptado');
                    $this->db->modificarAnimal($animalSeleccionado);
                    
                    // 2. Registrar la nueva Adopción
                    $nuevaAdopcion = new Adopcion($idAnimal, $idAdoptante, date('Y-m-d'));
                    $this->db->agregarAdopcion($nuevaAdopcion);
                    
                    // Redirección exitosa
                    header('Location: index.php?action=verHistorialAdopciones&msg=' . urlencode('Adopción de ' . $animalSeleccionado->getNombre() . ' realizada con éxito.'));
                    exit;
                } else {
                    $error = 'Error: No se encontró el Animal en la base de datos.';
                }
            }
        }
        
        // Mostrar formulario (GET o POST con error)
        $this->render(
            'adopciones/realizar_adopcion_form.tpl', 
            'Realizar Nueva Adopción', 
            [
                'listos' => $animales_listos, 
                'habilitados' => $adoptantes_habilitados,
                'error' => $error
            ]
        );
    }
    
    /**
     * Muestra el listado de todas las adopciones realizadas.
     */
    public function verHistorialAdopciones() {
        $this->protegerAcceso();
        
        $historial = $this->db->getAdopciones();
        $datosAdopciones = [];
        
        foreach ($historial as $adopcion) {
            $animal = $this->db->buscarAnimalPorId($adopcion->getIdAnimal());
            $adoptante = $this->db->buscarAdoptantePorId($adopcion->getIdAdoptante());
            
            $datosAdopciones[] = [
                'id' => $adopcion->getIdAdopcion(),
                'animal_nombre' => $animal ? $animal->getNombre() : 'ID Inválido',
                'adoptante_nombre' => $adoptante ? $adoptante->getNombre() : 'ID Inválido',
                'fecha' => $adopcion->getFechaAdopcion()
            ];
        }

        $this->render(
            'adopciones/historial.tpl', 
            'Historial de Adopciones', 
            ['historial' => $datosAdopciones]
        );
    }
}