<?php
// controller/ControllerAdoptante.php

require_once __DIR__ . '/AppController.php'; 
require_once __DIR__ . '/../model/ModelAdoptante.php';

class ControllerAdoptante extends AppController {

    public function __construct(DB $db) {
        parent::__construct($db);
    }
    
    // --- LECTURA ---
    /**
     * Muestra el listado de adoptantes.
     */
    public function listarAdoptantes() {
        $this->protegerAcceso();
        
        $titulo = 'Listado de Adoptantes';
        $adoptantes = $this->db->getAdoptantes(); 
        
        $this->render(
            'adoptantes/lista.tpl', 
            $titulo, 
            ['adoptantes' => $adoptantes]
        );
    }

    /**
     * Muestra los detalles de un adoptante.
     */
    public function verDetallesAdoptante() {
        $this->protegerAcceso();
        $id = (int)($_GET['id'] ?? 0); 
        $adoptante = $this->db->buscarAdoptantePorId($id); 

        if (!$adoptante) {
            header('Location: index.php?action=listarAdoptantes&msg=' . urlencode('Error: Adoptante no encontrado.'));
            exit;
        }

        $titulo = 'Detalles de ' . $adoptante->getNombre();
        
        $this->render('adoptantes/detalles.tpl', $titulo, ['adoptante' => $adoptante]);
    }
    
    // --- CREACIÓN ---
    /**
     * Muestra el formulario de registro (GET) o procesa el formulario (POST).
     */
    public function registrarAdoptante() {
        $this->protegerAcceso();
        $titulo = 'Registrar Nuevo Adoptante';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('adoptantes/registro_form.tpl', $titulo);
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nombre']) || empty($_POST['dni']) || empty($_POST['telefono'])) {
                 $this->render('adoptantes/registro_form.tpl', $titulo, [
                     'error' => 'Por favor, complete Nombre, DNI y Teléfono.'
                 ]);
                 return;
            }
            
            $requisitos = (isset($_POST['requisitosCumplidos']) && $_POST['requisitosCumplidos'] == 'on');
            
            $nuevoAdoptante = new Adoptante(
                $_POST['nombre'],
                $_POST['dni'],
                $_POST['direccion'] ?? '',
                $_POST['telefono'],
                $_POST['email'] ?? '',
                $requisitos
            );
            $this->db->agregarAdoptante($nuevoAdoptante); 
            $mensaje = 'Adoptante ' . urlencode($nuevoAdoptante->getNombre()) . ' registrado con éxito.';
            header('Location: index.php?action=listarAdoptantes&msg=' . $mensaje);
            exit;
        }
    }

    // --- ACTUALIZACIÓN ---
    /**
     * Muestra el formulario de modificación (GET) y procesa la actualización (POST).
     */
    public function modificarAdoptante() {
        $this->protegerAcceso();
        $titulo = 'Modificar Adoptante';
        $id = (int)($_REQUEST['id'] ?? 0); 

        if ($id === 0) {
            header('Location: index.php?action=listarAdoptantes&msg=' . urlencode('Error: ID no proporcionado.'));
            exit;
        }

        $adoptante = $this->db->buscarAdoptantePorId($id);

        if (!$adoptante) {
            header('Location: index.php?action=listarAdoptantes&msg=' . urlencode('Error: Adoptante no encontrado.'));
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             if (empty($_POST['nombre']) || empty($_POST['dni']) || empty($_POST['telefono'])) {
                  $this->render('adoptantes/modificacion_form.tpl', $titulo, [
                      'adoptante' => $adoptante,
                      'error' => 'Por favor, complete Nombre, DNI y Teléfono.'
                  ]);
                  return;
             }
             
             $requisitos = (isset($_POST['requisitosCumplidos']) && $_POST['requisitosCumplidos'] == 'on');
             
             // Crear un nuevo objeto Adoptante (o usar setters)
             $adoptanteActualizado = new Adoptante(
                 $_POST['nombre'],
                 $_POST['dni'],
                 $_POST['direccion'] ?? '',
                 $_POST['telefono'],
                 $_POST['email'] ?? '',
                 $requisitos,
                 $id // Pasamos el ID para que la DB lo identifique
             );

             $this->db->modificarAdoptante($adoptanteActualizado); 
             $mensaje = 'Adoptante ' . urlencode($adoptanteActualizado->getNombre()) . ' modificado con éxito.';
             header('Location: index.php?action=listarAdoptantes&msg=' . $mensaje);
             exit;
        }
        
        // Muestra formulario precargado (GET)
        $this->render('adoptantes/modificacion_form.tpl', $titulo, [
            'adoptante' => $adoptante
        ]);
    }

    // --- ELIMINACIÓN ---
    /**
     * Muestra la página de confirmación.
     */
    public function confirmarBorradoAdoptante() {
        $this->protegerAcceso();
        $id = (int)($_GET['id'] ?? 0);

        $adoptante = $this->db->buscarAdoptantePorId($id);

        if (!$adoptante) {
            header('Location: index.php?action=listarAdoptantes&msg=' . urlencode('Error: Adoptante no encontrado.'));
            exit;
        }

        $titulo = 'Confirmar Borrado de Adoptante';
        
        // Necesitas crear la plantilla adoptantes/confirmar_borrado.tpl
        $this->render('adoptantes/confirmar_borrado.tpl', $titulo, [ 
            'adoptante' => $adoptante
        ]);
    }

    /**
     * Procesa la eliminación final.
     */
    public function borrarAdoptante() {
        $this->protegerAcceso();
        
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int)$_GET['id'];
            $adoptante_a_borrar = $this->db->buscarAdoptantePorId($id);
            $nombre = $adoptante_a_borrar ? $adoptante_a_borrar->getNombre() : 'Adoptante (ID ' . $id . ')';

            $exito = $this->db->eliminarAdoptante($id); 
            
            if ($exito) {
                $mensaje = 'Adoptante ' . urlencode($nombre) . ' eliminado con éxito.';
            } else {
                $mensaje = 'Error: No se encontró el adoptante para borrar.';
            }
            
        } else {
            $mensaje = 'Error: ID de adoptante no proporcionado o inválido.';
        }

        header('Location: index.php?action=listarAdoptantes&msg=' . $mensaje);
        exit;
    }
}