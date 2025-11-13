<?php

require_once __DIR__ . '/AppController.php'; 
require_once __DIR__ . '/../model/ModelAdopcion.php';
require_once __DIR__ . '/../model/ModelAnimal.php'; 
require_once __DIR__ . '/../model/ModelAdoptante.php'; 

class ControllerAdopciones extends AppController {
    
    public function __construct($db) {
        parent::__construct($db);
    }

    public function verAnimalesDisponibles() {
        $this->protegerAcceso();
        
        $listos = $this->db->getAnimalesListos();

        $this->render(
            'adopciones/animales_disponibles.tpl', 
            'Animales Listos para Adopción', 
            ['listos' => $listos]
        );
    }
    
    public function verAdoptantesHabilitados() {
        $this->protegerAcceso();
        
        $habilitados = $this->db->getAdoptantesHabilitados();

        $this->render(
            'adopciones/adoptantes_habilitados.tpl', 
            'Adoptantes Habilitados', 
            ['habilitados' => $habilitados]
        );
    }

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
                    $animalSeleccionado->setEstado('Adoptado');
                    $this->db->modificarAnimal($animalSeleccionado);
                    
                    $nuevaAdopcion = new Adopcion($idAnimal, $idAdoptante, date('Y-m-d'));
                    $this->db->agregarAdopcion($nuevaAdopcion);
                    
                    header('Location: index.php?action=verHistorialAdopciones&msg=' . urlencode('Adopción de ' . $animalSeleccionado->getNombre() . ' realizada con éxito.'));
                    exit;
                } else {
                    $error = 'Error: No se encontró el Animal en la base de datos.';
                }
            }
        }
    
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
            $idAnimalNuevo = (int) ($_POST['animal_id'] ?? 0);
            $idAdoptanteNuevo = (int) ($_POST['adoptante_id'] ?? 0);
            $fechaNueva = $_POST['fecha'] ?? date('Y-m-d');
            
            $idAnimalAntiguo = $adopcion->getIdAnimal();

            if ($idAnimalNuevo === 0 || $idAdoptanteNuevo === 0) {
                 $error = 'Error: Debe seleccionar un Animal y un Adoptante válidos.';
            } else {
                if ($idAnimalAntiguo != $idAnimalNuevo) {
                    $animalAntiguo = $this->db->buscarAnimalPorId($idAnimalAntiguo);
                    if ($animalAntiguo) {
                        $animalAntiguo->setEstado('Listo para adopcion');
                        $this->db->modificarAnimal($animalAntiguo);
                    }
                    $animalNuevo = $this->db->buscarAnimalPorId($idAnimalNuevo);
                    if ($animalNuevo) {
                        $animalNuevo->setEstado('Adoptado');
                        $this->db->modificarAnimal($animalNuevo);
                    }
                }

                $adopcion->setIdAnimal($idAnimalNuevo);
                $adopcion->setIdAdoptante($idAdoptanteNuevo);
                $adopcion->setFechaAdopcion($fechaNueva);
                $this->db->modificarAdopcion($adopcion);
                
                header('Location: index.php?action=verHistorialAdopciones&msg=' . urlencode('Adopción actualizada con éxito.'));
                exit;
            }

        }

        $animales_listos = $this->db->getAnimalesListos(); 
        $adoptantes_habilitados = $this->db->getAdoptantesHabilitados();
        $animal_actual = $this->db->buscarAnimalPorId($adopcion->getIdAnimal());
        $adoptante_actual = $this->db->buscarAdoptantePorId($adopcion->getIdAdoptante());

        if ($animal_actual && !in_array($animal_actual, $animales_listos, true)) {
             array_unshift($animales_listos, $animal_actual);
        }
        if ($adoptante_actual && !in_array($adoptante_actual, $adoptantes_habilitados, true)) {
             array_unshift($adoptantes_habilitados, $adoptante_actual);
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

    public function confirmarBorradoAdopcion() {
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
            'adopciones/confirmar_borrado.tpl', 
            'Confirmar Borrado de Adopción', 
            [
                'adopcion' => $adopcion,
                'animal_nombre' => $animal ? $animal->getNombre() : 'Animal Desconocido',
                'adoptante_nombre' => $adoptante ? $adoptante->getNombre() : 'Adoptante Desconocido'
            ]
        );
    }

    public function borrarAdopcion() {
        $this->protegerAcceso();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             header('Location: index.php?action=verHistorialAdopciones');
             exit;
        }
        
        $id = (int) ($_POST['id_adopcion'] ?? 0);
        $adopcion = $this->db->buscarAdopcionPorId($id);

        if ($adopcion) {
            $animal = $this->db->buscarAnimalPorId($adopcion->getIdAnimal());
            if ($animal) {
                $animal->setEstado('Listo para adopcion');
                $this->db->modificarAnimal($animal);
            }

            $this->db->eliminarAdopcion($id);
            
            header('Location: index.php?action=verHistorialAdopciones&msg=' . urlencode('Adopción eliminada con éxito. El animal vuelve a estar disponible.'));
            exit;
            
        } else {
            header('Location: index.php?action=verHistorialAdopciones&error=' . urlencode('No se pudo eliminar la adopción.'));
            exit;
        }
    }

}
?>