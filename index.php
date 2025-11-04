<?php
// index.php - El Front Controller (Router)

// 1. INCLUSIONES DE CLASES
require_once 'db/class_db.php'; 
require_once 'controller/AppController.php'; 
require_once 'controller/ControllerAuth.php';
require_once 'controller/controllerAnimales.php';
require_once 'controller/controllerAdoptante.php';
require_once 'controller/ControllerAdopciones.php';
require_once 'loadDatos.php'; 

// 2. INICIAR SESIÓN y DB 
session_start(); 
$db = DB::getInstance();

// 3. Determinar la acción solicitada (por URL)
$action = $_GET['action'] ?? 'home'; 

// 4. Ejecutar la acción
switch ($action) {
    // --- ACCIÓN HOME, LOGIN, LOGOUT (Manejadas por ControllerAuth) ---
    case 'home':
    case 'login':
        $controller = new ControllerAuth($db); 
        $controller->login(); 
        break;
        
    case 'logout':
        $controller = new ControllerAuth($db);
        $controller->logout();
        break;

    // --- ACCIONES DE GESTIÓN (Protegidas) ---
    case 'listarAnimales':
    case 'registrarAnimal':
    case 'modificarAnimal':
    case 'borrarAnimal':
    case 'verDetallesAnimal':
    case 'confirmarBorradoAnimal': 
        // Lógica para Animales
        if (class_exists('ControllerAnimales')) {
             $controller = new ControllerAnimales($db);
             $controller->$action();
        }
        break;
        
    case 'listarAdoptantes':
    case 'registrarAdoptante': 
    case 'modificarAdoptante':
    case 'borrarAdoptante':
    case 'verDetallesAdoptante':
        // Lógica para Adoptantes
        if (class_exists('ControllerAdoptante')) {
             $controller = new ControllerAdoptante($db);
             $controller->$action();
        }
        break;

    case 'verAnimalesDisponibles':
    case 'verAdoptantesHabilitados':
    case 'realizarAdopcion':
    case 'verHistorialAdopciones':
        // Lógica para Adopciones
        if (class_exists('ControllerAdopciones')) {
             $controller = new ControllerAdopciones($db);
             $controller->$action();
        }
        break;
    
    default:
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1><p>Acción no reconocida: " . htmlspecialchars($action) . "</p>";
        break;
}
?>