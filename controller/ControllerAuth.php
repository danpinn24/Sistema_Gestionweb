<?php
// controller/ControllerAuth.php

// Incluye el controlador base (AppController) que maneja Smarty y la lógica de sesión
require_once 'controller/AppController.php';
require_once 'db/class_db.php';

class ControllerAuth extends AppController {
    
    public function __construct(DB $db) {
        // Llama al constructor padre para inicializar Smarty y la DB
        parent::__construct($db);
    }

    /**
     * Muestra el formulario de login (GET) o procesa el inicio de sesión (POST).
     */
    public function login() {
        $titulo = 'Acceso al Sistema';

        // Si ya está logueado, lo redirige directamente al menú principal
        if ($this->estaLogueado()) {
            header('Location: index.php?action=menuPrincipal'); // Redirección si ya está logueado
            exit;
        }

        // Si es POST, procesar el intento de login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Recoger y limpiar datos del formulario
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $usuario = $this->db->verificarCredenciales($username, $password);

            if ($usuario) {
                // Login exitoso: Iniciar sesión y guardar datos
                $_SESSION['logueado'] = true;
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['username'] = $usuario['username'];
                $_SESSION['rol'] = $usuario['rol'] ?? 'admin';
                
                $mensaje = 'Bienvenido ' . urlencode($usuario['username']) . '. ¡Acceso exitoso!';
                
                // 📌 CAMBIO CRÍTICO: Redirigir al nuevo menú principal
                header('Location: index.php?action=menuPrincipal&msg=' . $mensaje);
                exit;

            } else {
                // Login fallido: Mostrar error en la vista
                $error_login = 'Usuario o contraseña incorrectos. Inténtalo de nuevo.';
                $data = ['error_login' => $error_login];
                $this->render('home.tpl', $titulo, $data);
                return;
            }
        }
        
        // Si es GET, o después de un error fallido, mostramos la plantilla home.tpl
        // En esta vista el usuario verá el formulario de login.
        $this->render('home.tpl', $titulo);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout() {
        // Limpia todas las variables de sesión
        $_SESSION = [];
        // Destruye la sesión
        session_destroy();

        $mensaje = 'Has cerrado sesión con éxito.';
        
        // Redirige al home (que es la página de login)
        header('Location: index.php?action=home&msg=' . urlencode($mensaje));
        exit;
    }
}
?>