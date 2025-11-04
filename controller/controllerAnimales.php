<?php
require_once 'model/ModelAnimal.php'; 
require_once 'db/class_db.php'; 
require_once 'controller/AppController.php';

class ControllerAnimales extends AppController {
    
    public function __construct(DB $db) {
        parent::__construct($db);
    }
   
    /**
     * Muestra el listado de animales. Requiere autenticación.
     */
    public function listarAnimales() {
        $this->protegerAcceso(); // 📌 CRÍTICO: Asegura que el usuario esté logueado
        
        $titulo = 'Listado de Animales';
        $animales = $this->db->getAnimales(); 
        
        $this->render('animales/lista.tpl', $titulo, ['animales' => $animales]);
    }
    
    /**
     * Muestra el formulario de registro (GET) o procesa el formulario (POST).
     */
    public function registrarAnimal() {
        $this->protegerAcceso(); // 📌 CRÍTICO: Asegura que el usuario esté logueado
        $titulo = 'Registrar Nuevo Animal';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('animales/registro_form.tpl', $titulo);
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validación de campos obligatorios
            if (empty($_POST['nombre']) || empty($_POST['especie']) || empty($_POST['edad']) || empty($_POST['estado'])) {
                 $this->render('animales/registro_form.tpl', $titulo, [
                     'error' => 'Por favor, complete todos los campos requeridos (Nombre, Especie, Edad, Estado).'
                 ]);
                 return;
            }
            
            $fechaIngreso = date('Y-m-d'); 
            $nuevoAnimal = new Animal(
                $_POST['nombre'],
                $_POST['especie'],
                $_POST['raza'] ?? '',
                (int)$_POST['edad'],
                $_POST['sexo'] ?? '',
                $_POST['caracteristicasFisicas'] ?? '',
                $fechaIngreso,
                $_POST['estado']
            );
            $this->db->agregarAnimal($nuevoAnimal); 
            $mensaje = 'Animal ' . urlencode($nuevoAnimal->getNombre()) . ' registrado con éxito.';
            header('Location: index.php?action=listarAnimales&msg=' . $mensaje);
            exit;
        }
    }
    
    /**
     * Muestra una página intermedia para confirmar la eliminación.
     */
    public function confirmarBorradoAnimal() {
        $this->protegerAcceso(); // 📌 PROTECCIÓN
        
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?action=listarAnimales&msg=' . urlencode('Error: ID no proporcionado o inválido para confirmar borrado.'));
            exit;
        }

        $id = (int)$_GET['id'];
        $animal = $this->db->buscarAnimalPorId($id);

        if (!$animal) {
            header('Location: index.php?action=listarAnimales&msg=' . urlencode('Error: Animal no encontrado.'));
            exit;
        }

        $titulo = 'Confirmar Borrado de Animal';
        
        $this->render('animales/confirmar_borrado.tpl', $titulo, [
            'animal' => $animal
        ]);
    }
    
    /**
     * Procesa la eliminación final del animal por ID.
     */
    public function borrarAnimal() {
        $this->protegerAcceso(); // 📌 PROTECCIÓN
        
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int)$_GET['id'];
            
            $animal_a_borrar = $this->db->buscarAnimalPorId($id);
            $nombre = $animal_a_borrar ? $animal_a_borrar->getNombre() : 'Animal (ID ' . $id . ')';

            $exito = $this->db->eliminarAnimal($id); 
            
            if ($exito) {
                $mensaje = 'Animal ' . urlencode($nombre) . ' eliminado con éxito.';
            } else {
                $mensaje = 'Error: No se encontró el animal para borrar.';
            }
            
        } else {
            $mensaje = 'Error: ID de animal no proporcionado o inválido.';
        }

        header('Location: index.php?action=listarAnimales&msg=' . $mensaje);
        exit;
    }

    /**
     * Muestra los detalles de un animal específico.
     */
    public function verDetallesAnimal() {
        $this->protegerAcceso(); // 📌 PROTECCIÓN
        
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?action=listarAnimales&msg=' . urlencode('Error: ID no proporcionado.'));
            exit;
        }

        $id = (int)$_GET['id'];
        $animal = $this->db->buscarAnimalPorId($id);

        if (!$animal) {
            header('Location: index.php?action=listarAnimales&msg=' . urlencode('Error: Animal no encontrado.'));
            exit;
        }

        $titulo = 'Detalles de ' . $animal->getNombre();
        
        $this->render('animales/detalles.tpl', $titulo, [
            'animal' => $animal
        ]);
    }

    /**
     * Muestra el formulario de modificación (GET) y procesa la actualización (POST).
     */
    public function modificarAnimal() {
        $this->protegerAcceso(); // 📌 PROTECCIÓN
        $titulo = 'Modificar Animal';
        
        // El ID debe venir siempre, sea por GET o POST
        $id = (int)($_REQUEST['id'] ?? 0); 

        if ($id === 0) {
            header('Location: index.php?action=listarAnimales&msg=' . urlencode('Error: ID no proporcionado para modificar.'));
            exit;
        }

        $animal = $this->db->buscarAnimalPorId($id);

        if (!$animal) {
            header('Location: index.php?action=listarAnimales&msg=' . urlencode('Error: Animal no encontrado.'));
            exit;
        }

        // LÓGICA POST (Guardar cambios)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             
             // Validación
             if (empty($_POST['nombre']) || empty($_POST['especie']) || empty($_POST['edad']) || empty($_POST['estado'])) {
                  $this->render('animales/modificacion_form.tpl', $titulo, [
                      'animal' => $animal,
                      'error' => 'Por favor, complete todos los campos requeridos (Nombre, Especie, Edad, Estado).'
                  ]);
                  return;
             }

             // Crear un nuevo objeto Animal con los datos del POST
             $animal_actualizado = new Animal(
                 $_POST['nombre'],
                 $_POST['especie'],
                 $_POST['raza'] ?? '',
                 (int)$_POST['edad'],
                 $_POST['sexo'] ?? '',
                 $_POST['caracteristicasFisicas'] ?? '',
                 $animal->getFechaIngreso(), // Mantenemos la fecha original de ingreso
                 $_POST['estado']
             );
             
             $animal_actualizado->setId($id); 

             // Llamar al método de la base de datos para guardar los cambios
             $this->db->modificarAnimal($animal_actualizado); 

             // Redireccionar
             $mensaje = 'Animal ' . urlencode($animal_actualizado->getNombre()) . ' modificado con éxito.';
             header('Location: index.php?action=listarAnimales&msg=' . $mensaje);
             exit;
        }
        
        // LÓGICA GET (Mostrar formulario precargado)
        $this->render('animales/modificacion_form.tpl', $titulo, [
            'animal' => $animal
        ]);
    }
}