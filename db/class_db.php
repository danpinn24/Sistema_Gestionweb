<?php
class DB {
    private static $instance = null; 
    
    private $animales = [];
    private $adoptantes = []; // <-- Incluido para la estructura
    private $adopciones = [];
    private $usuarios = [];
    
    private static $ultimoIdAnimal = 0; 
    private static $ultimoIdAdoptante = 0; // <-- Incluido
    private static $ultimoIdAdopcion = 0;

    private function __construct() {
        // La ruta asume que loadDatos.php está un nivel arriba de db/
        require_once __DIR__ . '/../loadDatos.php'; 

        // 1. Intentar cargar los datos de la sesión
        if (isset($_SESSION['animales_data'])) {
            $this->animales = $_SESSION['animales_data'];
            $this->adoptantes = $_SESSION['adoptantes_data'] ?? []; // <-- Cargar Adoptantes
            $this->usuarios = $_SESSION['usuarios_data'] ?? [];
            
            self::$ultimoIdAnimal = $_SESSION['ultimoIdAnimal'] ?? 0;
            self::$ultimoIdAdoptante = $_SESSION['ultimoIdAdoptante'] ?? 0; // <-- Cargar último ID
            
        } else {
            // 2. Si no hay datos en la sesión, cargar datos iniciales
            loadDatos($this); 
            $this->guardarEnSesion(); 
        }
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }
    
    private function guardarEnSesion() {
        $_SESSION['animales_data'] = $this->animales;
        $_SESSION['ultimoIdAnimal'] = self::$ultimoIdAnimal;
        
        $_SESSION['adoptantes_data'] = $this->adoptantes; // <-- Guardar Adoptantes
        $_SESSION['ultimoIdAdoptante'] = self::$ultimoIdAdoptante; // <-- Guardar ID
        
        $_SESSION['usuarios_data'] = $this->usuarios;
    }
    
    // === MÉTODOS PARA AUTENTICACIÓN ===
    
    public function agregarUsuario($usuario) {
        $this->usuarios[] = $usuario;
    }
    
    public function verificarCredenciales($username, $password) {
        foreach ($this->usuarios as $usuario) {
            // NOTA: Simulación de verificación simple
            if ($usuario['username'] === $username && $usuario['password'] === $password) {
                return $usuario;
            }
        }
        return false;
    }

    // === MÉTODOS DE ANIMALES ===
    public function getAnimales() { return $this->animales; }
    
    public function agregarAnimal($animal) {
        self::$ultimoIdAnimal++;
        $animal->setId(self::$ultimoIdAnimal); 
        $this->animales[] = $animal;
        $this->guardarEnSesion(); 
    }
    
    // ... (modificarAnimal, eliminarAnimal, buscarAnimalPorId) ...
    
    // === MÉTODOS DE ADOPTANTES (NUEVOS, para resolver el error original) ===
    
    public function getAdoptantes() { return $this->adoptantes; } // Getter
    
    public function agregarAdoptante($adoptante) {
        self::$ultimoIdAdoptante++;
        $adoptante->setId(self::$ultimoIdAdoptante); 
        $this->adoptantes[] = $adoptante;
        $this->guardarEnSesion(); 
    }
    
    // ... (modificarAdoptante, eliminarAdoptante, buscarAdoptantePorId) ...

    // === MÉTODOS DE ADOPCIONES ===
    // ... (agregarAdopcion, etc.) ...
}
?>