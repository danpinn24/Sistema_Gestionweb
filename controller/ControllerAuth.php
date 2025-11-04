<?php
// controller/ControllerAuth.php

require_once 'controller/AppController.php';

class ControllerAuth extends AppController {
    
    public function __construct(DB $db) {
        parent::__construct($db);
    }

    public function login() {
        $titulo = 'Acceso al Sistema';

        if ($this->estaLogueado()) {
            header('Location: index.php?action=listarAnimales');
            exit;
        }

        // Si es POST, procesar el intento de login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // 💡 CORRECCIÓN CRÍTICA: Usar trim() para limpiar espacios en blanco
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $usuario = $this->db->verificarCredenciales($username, $password);

            if ($usuario) {
                // Login exitoso: Iniciar sesión
                $_SESSION['logueado'] = true;
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['username'] = $usuario['username'];
                $_SESSION['rol'] = $usuario['rol'] ?? 'admin';
                
                $mensaje = 'Bienvenido ' . urlencode($usuario['nombre']) . '. ¡Acceso exitoso!';
                header('Location: index.php?action=listarAnimales&msg=' . $mensaje);
                exit;

            } else {
                // Login fallido: Mostrar error en la vista home.tpl
                $error_login = 'Usuario o contraseña incorrectos. Inténtalo de nuevo.';
                $data = ['error_login' => $error_login];
                $this->render('home.tpl', $titulo, $data);
                return;
            }
        }
        
        // Si es GET, mostramos la plantilla home.tpl
        $this->render('home.tpl', $titulo);
    }

    public function logout() {
        // Cierra la sesión
        $_SESSION = [];
        session_destroy();

        $mensaje = 'Has cerrado sesión con éxito.';
        header('Location: index.php?action=home&msg=' . $mensaje);
        exit;
    }
}
?>