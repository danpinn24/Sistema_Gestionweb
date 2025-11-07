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
    

    // === NUEVOS MÉTODOS PARA CRUD ADOPCIONES ===

    /**
     * Muestra los detalles de una adopción específica.
     */
    public function verDetallesAdopcion() {
        $this->protegerAcceso();
        $id = (int) ($_GET['id'] ?? 0);
        
        $adopcion = $this->db->buscarAdopcionPorId($id);
        
        if (!$adopcion) {
            header('Location: index.php?action=verHistorialAdopciones&error=' . urlencode('Adopción no encontrada.'));
            exit;
        }
        
        $animal = $this->db->buscarAnimalPorId($adopcion->getIdAnimal());
        $adoptante = $this->db->buscarAdoptantePorId($adopcion->getIdAdoptante());

        $this->render(
            'adopciones/detalles.tpl', 
            'Detalles de la Adopción', 
            [
                'adopcion' => $adopcion,
                'animal' => $animal,
                'adoptante' => $adoptante
            ]
        );
    }
    
    /**
     * Muestra el formulario para modificar una adopción y procesa el cambio.
     */
    public function modificarAdopcion() {
        $this->protegerAcceso();
        $id = (int) ($_GET['id'] ?? $_POST['id_adopcion'] ?? 0);
        $error = null;

        $adopcion = $this->db->buscarAdopcionPorId($id);

        if (!$adopcion) {
            header('Location: index.php?action=verHistorialAdopciones&error=' . urlencode('Adopción no encontrada.'));
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // --- PROCESAR EL FORMULARIO ---
            $idAnimalNuevo = (int) ($_POST['animal_id'] ?? 0);
            $idAdoptanteNuevo = (int) ($_POST['adoptante_id'] ?? 0);
            $fechaNueva = $_POST['fecha'] ?? date('Y-m-d');
            
            $idAnimalAntiguo = $adopcion->getIdAnimal();

            if ($idAnimalNuevo === 0 || $idAdoptanteNuevo === 0) {
                 $error = 'Error: Debe seleccionar un Animal y un Adoptante válidos.';
            } else {
                
                // Si el animal cambió, gestionamos los estados
                if ($idAnimalAntiguo != $idAnimalNuevo) {
                    // 1. Devolver el animal antiguo a "Listo"
                    $animalAntiguo = $this->db->buscarAnimalPorId($idAnimalAntiguo);
                    if ($animalAntiguo) {
                        $animalAntiguo->setEstado('Listo para adopcion');
                        $this->db->modificarAnimal($animalAntiguo);
                    }
                    
                    // 2. Poner el animal nuevo como "Adoptado"
                    $animalNuevo = $this->db->buscarAnimalPorId($idAnimalNuevo);
                    if ($animalNuevo) {
                        $animalNuevo->setEstado('Adoptado');
                        $this->db->modificarAnimal($animalNuevo);
                    }
                }
                
                // 3. Actualizar la adopción
                $adopcion->setIdAnimal($idAnimalNuevo);
                $adopcion->setIdAdoptante($idAdoptanteNuevo);
                $adopcion->setFechaAdopcion($fechaNueva);
                $this->db->modificarAdopcion($adopcion);
                
                header('Location: index.php?action=verHistorialAdopciones&msg=' . urlencode('Adopción actualizada con éxito.'));
                exit;
            }

        }
        
        // --- MOSTRAR EL FORMULARIO (GET o POST con error) ---
        
        // Obtenemos las listas de disponibles
        $animales_listos = $this->db->getAnimalesListos(); 
        $adoptantes_habilitados = $this->db->getAdoptantesHabilitados();
        
        // Añadimos el animal/adoptante actuales a las listas (por si no estuvieran "listos/habilitados" pero ya están asignados)
        $animal_actual = $this->db->buscarAnimalPorId($adopcion->getIdAnimal());
        $adoptante_actual = $this->db->buscarAdoptantePorId($adopcion->getIdAdoptante());
        
        // Aseguramos que el animal actual esté en la lista para el <select>
        if ($animal_actual && !in_array($animal_actual, $animales_listos, true)) {
             array_unshift($animales_listos, $animal_actual); // Lo ponemos al principio
        }
        // Aseguramos que el adoptante actual esté en la lista para el <select>
        if ($adoptante_actual && !in_array($adoptante_actual, $adoptantes_habilitados, true)) {
             array_unshift($adoptantes_habilitados, $adoptante_actual); // Lo ponemos al principio
        }

        $this->render(
            'adopciones/modificar_form.tpl', 
            'Modificar Adopción', 
            [
                'adopcion' => $adopcion,
                'listos' => $animales_listos, 
                'habilitados' => $adoptantes_habilitados,
                'error' => $error
            ]
        );
    }
    
    /**
     * Muestra la página de confirmación antes de borrar.
     */
    public function confirmarBorradoAdopcion() {
        $this->protegerAcceso();
        $id = (int) ($_GET['id'] ?? 0);
        $adopcion = $this->db->buscarAdopcionPorId($id);
        
        if (!$adopcion) {
            header('Location: index.php?action=verHistorialAdopciones&error=' . urlencode('Adopción no encontrada.'));
            exit;
        }
        
        // Obtenemos los nombres para la confirmación
        $animal = $this->db->buscarAnimalPorId($adopcion->getIdAnimal());
        $adoptante = $this->db->buscarAdoptantePorId($adopcion->getIdAdoptante());

        $this->render(
            'adopciones/confirmar_borrado.tpl', 
            'Confirmar Borrado de Adopción', 
            [
                'adopcion' => $adopcion,
                'animal_nombre' => $animal ? $animal->getNombre() : 'Animal Desconocido',
                'adoptante_nombre' => $adoptante ? $adoptante->getNombre() : 'Adoptante Desconocido'
            ]
        );
    }
    
    /**
     * Procesa la eliminación de una adopción.
     */
    public function borrarAdopcion() {
        $this->protegerAcceso();
        
        // Solo debe funcionar por POST para seguridad
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             header('Location: index.php?action=verHistorialAdopciones');
             exit;
        }
        
        $id = (int) ($_POST['id_adopcion'] ?? 0);
        $adopcion = $this->db->buscarAdopcionPorId($id);

        if ($adopcion) {
            // 1. Devolver el animal al estado "Listo para adopcion"
            $animal = $this->db->buscarAnimalPorId($adopcion->getIdAnimal());
            if ($animal) {
                $animal->setEstado('Listo para adopcion');
                $this->db->modificarAnimal($animal);
            }
            
            // 2. Eliminar el registro de adopción
            $this->db->eliminarAdopcion($id);
            
            header('Location: index.php?action=verHistorialAdopciones&msg=' . urlencode('Adopción eliminada con éxito. El animal vuelve a estar disponible.'));
            exit;
            
        } else {
            header('Location: index.php?action=verHistorialAdopciones&error=' . urlencode('No se pudo eliminar la adopción.'));
            exit;
        }
    }

} // Fin de la clase ControllerAdopciones
?>