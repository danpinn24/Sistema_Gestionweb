<?php

require_once 'controller/AppController.php';
require_once 'db/class_db.php';

class ControllerAuth extends AppController {
    
    public function __construct(DB $db) {
        parent::__construct($db);
    }

    public function login() {
        $titulo = 'Acceso al Sistema';

        if ($this->estaLogueado()) {
            header('Location: index.php?action=menuPrincipal');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $usuario = $this->db->verificarCredenciales($username, $password);

            if ($usuario) {
                $_SESSION['logueado'] = true;
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['username'] = $usuario['username'];
                $_SESSION['rol'] = $usuario['rol'] ?? 'admin';
                
                $mensaje = 'Bienvenido ' . urlencode($usuario['username']) . '. ¡Acceso exitoso!';

                header('Location: index.php?action=menuPrincipal&msg=' . $mensaje);
                exit;

            } else {
                $error_login = 'Usuario o contraseña incorrectos. Inténtalo de nuevo.';
                $data = ['error_login' => $error_login];
                $this->render('home.tpl', $titulo, $data);
                return;
            }
        }
        
        $this->render('home.tpl', $titulo);
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        $mensaje = 'Has cerrado sesión con éxito.';
        header('Location: index.php?action=home&msg=' . urlencode($mensaje));
        exit;
    }
}
?>