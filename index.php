<?php
// index.php - El Front Controller (Router)

// 1. INCLUSIONES DE CLASES y LIBRERÍAS
require_once 'db/class_db.php'; 
require_once 'controller/AppController.php'; 
require_once 'controller/ControllerAuth.php';
require_once 'controller/controllerAnimales.php';
require_once 'controller/controllerAdoptante.php';
require_once 'controller/ControllerAdopciones.php';
require_once 'controller/HomeController.php'; 

// 2. INICIAR SESIÓN y DB 
session_start(); 
$db = DB::getInstance(); // Inicia la DB (y carga datos iniciales si es la primera vez)

// 3. Determinar la acción solicitada (por URL)
$action = $_GET['action'] ?? 'home'; 

// 4. Ejecutar la acción
switch ($action) {
    // --- ACCIÓN HOME, LOGIN, LOGOUT (ControllerAuth) ---
    case 'home':
    case 'login':
        $controller = new ControllerAuth($db); 
        $controller->login(); 
        break;
        
    case 'logout':
        $controller = new ControllerAuth($db);
        $controller->logout();
        break;

    // --- ACCIÓN DE MENÚ PRINCIPAL DESPUÉS DEL LOGIN (Gestionada por HomeController) ---
    case 'menuPrincipal':
        $controller = new HomeController($db); // 👈 CAMBIO: Usar HomeController
        $controller->menuPrincipal();
        break;

    // --- ACCIONES DE GESTIÓN (Animales) ---
    case 'listarAnimales':
    case 'registrarAnimal':
    case 'modificarAnimal':
    case 'borrarAnimal':
    case 'verDetallesAnimal':
    case 'confirmarBorradoAnimal': 
        $controller = new ControllerAnimales($db);
        $controller->$action();
        break;
        
    // --- ACCIONES DE GESTIÓN (Adoptantes) ---
    case 'listarAdoptantes':
    case 'registrarAdoptante': 
    case 'modificarAdoptante':
    case 'borrarAdoptante':
    case 'verDetallesAdoptante':
    case 'confirmarBorradoAdoptante': // A implementar en ControllerAdoptante
        $controller = new ControllerAdoptante($db);
        $controller->$action();
        break;

    // --- ACCIONES DE GESTIÓN (Adopciones) ---
    case 'verAnimalesDisponibles':
    case 'verAdoptantesHabilitados':
    case 'realizarAdopcion':
    case 'verHistorialAdopciones':
    // --- NUEVAS ACCIONES CRUD ADOPCIONES ---
    case 'verDetallesAdopcion':
    case 'modificarAdopcion':
    case 'confirmarBorradoAdopcion':
    case 'borrarAdopcion':
    // --- FIN NUEVAS ACCIONES ---
        $controller = new ControllerAdopciones($db);
        $controller->$action();
        break;
    
    default:
        // Si la acción no existe
        $controller = new ControllerAuth($db);
        $controller->login();
        break;
}
?>