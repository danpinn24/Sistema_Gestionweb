<?php

require_once 'db/class_db.php'; 
require_once 'controller/AppController.php'; 
require_once 'controller/ControllerAuth.php';
require_once 'controller/controllerAnimales.php';
require_once 'controller/controllerAdoptante.php';
require_once 'controller/ControllerAdopciones.php';
require_once 'controller/HomeController.php'; 

session_start(); 
$db = DB::getInstance();
$action = $_GET['action'] ?? 'home'; 

switch ($action) {
    case 'home':
    case 'login':
        $controller = new ControllerAuth($db); 
        $controller->login(); 
        break;
        
    case 'logout':
        $controller = new ControllerAuth($db);
        $controller->logout();
        break;

    case 'menuPrincipal':
        $controller = new HomeController($db);
        $controller->menuPrincipal();
        break;

    case 'listarAnimales':
    case 'registrarAnimal':
    case 'modificarAnimal':
    case 'borrarAnimal':
    case 'verDetallesAnimal':
    case 'confirmarBorradoAnimal': 
        $controller = new ControllerAnimales($db);
        $controller->$action();
        break;
        
    case 'listarAdoptantes':
    case 'registrarAdoptante': 
    case 'modificarAdoptante':
    case 'borrarAdoptante':
    case 'verDetallesAdoptante':
    case 'confirmarBorradoAdoptante':
        $controller = new ControllerAdoptante($db);
        $controller->$action();
        break;

    case 'verAnimalesDisponibles':
    case 'verAdoptantesHabilitados':
    case 'realizarAdopcion':
    case 'verHistorialAdopciones':
    case 'verDetallesAdopcion':
    case 'modificarAdopcion':
    case 'confirmarBorradoAdopcion':
    case 'borrarAdopcion':
        $controller = new ControllerAdopciones($db);
        $controller->$action();
        break;
    
    default:
        $controller = new ControllerAuth($db);
        $controller->login();
        break;
}
?>