<?php
// db/class_db.php

class DB {
    private static $instance = null; 
    
    private $animales = [];
    private $adoptantes = [];
    private $adopciones = [];
    private $usuarios = [];
    
    private static $ultimoIdAnimal = 0; 
    private static $ultimoIdAdoptante = 0; 
    private static $ultimoIdAdopcion = 0;

    private function __construct() {
        require_once __DIR__ . '/../loadDatos.php'; 

        // Cargar/Inicializar datos desde la sesión
        if (isset($_SESSION['animales_data'])) {
            $this->animales = $_SESSION['animales_data'];
            $this->adoptantes = $_SESSION['adoptantes_data'] ?? [];
            $this->adopciones = $_SESSION['adopciones_data'] ?? [];
            $this->usuarios = $_SESSION['usuarios_data'] ?? [];
            
            self::$ultimoIdAnimal = $_SESSION['ultimoIdAnimal'] ?? 0;
            self::$ultimoIdAdoptante = $_SESSION['ultimoIdAdoptante'] ?? 0;
            self::$ultimoIdAdopcion = $_SESSION['ultimoIdAdopcion'] ?? 0;
            
        } else {
            // Cargar datos iniciales si no hay sesión (llama a loadDatos)
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
        
        $_SESSION['adoptantes_data'] = $this->adoptantes;
        $_SESSION['ultimoIdAdoptante'] = self::$ultimoIdAdoptante;
        
        $_SESSION['adopciones_data'] = $this->adopciones;
        $_SESSION['ultimoIdAdopcion'] = self::$ultimoIdAdopcion;
        
        $_SESSION['usuarios_data'] = $this->usuarios;
    }
    
    // === AUTENTICACIÓN ===
    public function agregarUsuario($usuario) {
        $this->usuarios[] = $usuario;
    }
    
    public function verificarCredenciales($username, $password) {
        foreach ($this->usuarios as $usuario) {
            if ($usuario['username'] === $username && $usuario['password'] === $password) {
                return $usuario;
            }
        }
        return false;
    }

    // === GESTIÓN DE ANIMALES (CRUD) ===
    
    public function getAnimales() { return $this->animales; }
    
    public function agregarAnimal($animal) {
        self::$ultimoIdAnimal++;
        $animal->setId(self::$ultimoIdAnimal); 
        $this->animales[] = $animal;
        $this->guardarEnSesion(); 
    }
    
    public function buscarAnimalPorId($id) {
        foreach ($this->animales as $animal) {
            if ($animal->getId() == $id) {
                return $animal;
            }
        }
        return null;
    }

    public function modificarAnimal($animalActualizado) {
        foreach ($this->animales as $key => $animal) {
            if ($animal->getId() === $animalActualizado->getId()) {
                $this->animales[$key] = $animalActualizado;
                $this->guardarEnSesion();
                return true;
            }
        }
        return false;
    }

    public function eliminarAnimal($id) {
        foreach ($this->animales as $key => $animal) {
            if ($animal->getId() == $id) {
                unset($this->animales[$key]);
                $this->animales = array_values($this->animales); // Reindexar el array
                $this->guardarEnSesion();
                return true;
            }
        }
        return false;
    }

    // === GESTIÓN DE ADOPTANTES (CRUD) ===
    
    public function getAdoptantes() { return $this->adoptantes; } 
    
    public function agregarAdoptante($adoptante) {
        self::$ultimoIdAdoptante++;
        $adoptante->setId(self::$ultimoIdAdoptante); 
        $this->adoptantes[] = $adoptante;
        $this->guardarEnSesion(); 
    }
    
    public function buscarAdoptantePorId($id) {
        foreach ($this->adoptantes as $adoptante) {
            if ($adoptante->getId() == $id) {
                return $adoptante;
            }
        }
        return null;
    }
public function modificarAdoptante($adoptanteActualizado) {
        foreach ($this->adoptantes as $key => $adoptante) {
            if ($adoptante->getId() === $adoptanteActualizado->getId()) {
                $this->adoptantes[$key] = $adoptanteActualizado;
                $this->guardarEnSesion();
                return true;
            }
        }
        return false;
    }

    /**
     * Elimina un Adoptante por su ID.
     */
    public function eliminarAdoptante($id) {
        foreach ($this->adoptantes as $key => $adoptante) {
            if ($adoptante->getId() == $id) {
                unset($this->adoptantes[$key]);
                $this->adoptantes = array_values($this->adoptantes); // Reindexar el array
                $this->guardarEnSesion();
                return true;
            }
        }
        return false;
    }
    
    // NOTA: Agregar modificarAdoptante y eliminarAdoptante (similar a los métodos de Animales)

    // === GESTIÓN DE ADOPCIONES ===

    public function getAdopciones() { return $this->adopciones; }
    
    public function agregarAdopcion($adopcion) {
        self::$ultimoIdAdopcion++;
        $adopcion->setIdAdopcion(self::$ultimoIdAdopcion);
        $this->adopciones[] = $adopcion;
        $this->guardarEnSesion();
    }
    
    // === MÉTODOS AUXILIARES PARA CONTROLADORES ===
    
    public function getAnimalesListos() {
        return array_filter($this->animales, function($a) {
            return strtolower($a->getEstado()) === 'listo para adopcion';
        });
    }

    public function getAdoptantesHabilitados() {
        return array_filter($this->adoptantes, function($a) {
            return $a->cumpleRequisitos();
        });
    }
}
?>