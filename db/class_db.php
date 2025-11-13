<?php

require_once __DIR__ . '/../model/ModelAnimal.php';
require_once __DIR__ . '/../model/ModelAdoptante.php';
require_once __DIR__ . '/../model/ModelAdopcion.php';

class DB {

    private static $instance = null;
    private $pdo; 
    private static $db_file = __DIR__ . '/refugio.db'; 

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    private function __construct() {
        
        $db_es_nuevo = !file_exists(self::$db_file);

        try {
            $this->pdo = new PDO('sqlite:' . self::$db_file);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            if ($db_es_nuevo) {
                $this->init();
            }

        } catch (PDOException $e) {
            die("Error de conexión con la base de datos: " . $e->getMessage());
        }
    }
    
    private function init() {
        try {
            $this->pdo->exec("
                CREATE TABLE IF NOT EXISTS usuarios (
                    id INTEGER PRIMARY KEY,
                    username TEXT,
                    password TEXT,
                    nombre TEXT,
                    rol TEXT
                );
            ");
            
            $this->pdo->exec("
                CREATE TABLE IF NOT EXISTS animales (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT,
                    especie TEXT,
                    raza TEXT,
                    edad INTEGER,
                    sexo TEXT,
                    caracteristicasFisicas TEXT,
                    fechaIngreso TEXT,
                    estado TEXT
                );
            ");
            
            $this->pdo->exec("
                CREATE TABLE IF NOT EXISTS adoptantes (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT,
                    dni TEXT,
                    direccion TEXT,
                    telefono TEXT,
                    email TEXT,
                    requisitosCumplidos INTEGER
                );
            ");

            $this->pdo->exec("
                CREATE TABLE IF NOT EXISTS adopciones (
                    idAdopcion INTEGER PRIMARY KEY AUTOINCREMENT,
                    idAnimal INTEGER,
                    idAdoptante INTEGER,
                    fechaAdopcion TEXT
                );
            ");

            require_once __DIR__ . '/../loadDatos.php'; 
            loadDatos($this); 

        } catch (PDOException $e) {
            die("Error al inicializar la base de datos: " . $e->getMessage());
        }
    }
    
    public function getAnimales() { 
        $stmt = $this->pdo->query("SELECT * FROM animales");
        
        return $this->arrayToAnimales($stmt->fetchAll());
    }
    
    public function agregarAnimal($animal) {
        $sql = "INSERT INTO animales (nombre, especie, raza, edad, sexo, caracteristicasFisicas, fechaIngreso, estado) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $animal->getNombre(),
            $animal->getEspecie(),
            $animal->getRaza(),
            $animal->getEdad(),
            $animal->getSexo(),
            $animal->getCaracteristicasFisicas(),
            $animal->getFechaIngreso(),
            $animal->getEstado()
        ]);

        $animal->setId($this->pdo->lastInsertId());
    }
    
    public function buscarAnimalPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM animales WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(); 

        return $row ? $this->arrayToAnimal($row) : null;
    }

    public function modificarAnimal($animal) {
        $sql = "UPDATE animales SET 
                    nombre = ?, especie = ?, raza = ?, edad = ?, sexo = ?, 
                    caracteristicasFisicas = ?, fechaIngreso = ?, estado = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $animal->getNombre(),
            $animal->getEspecie(),
            $animal->getRaza(),
            $animal->getEdad(),
            $animal->getSexo(),
            $animal->getCaracteristicasFisicas(),
            $animal->getFechaIngreso(),
            $animal->getEstado(),
            $animal->getId()
        ]);
    }

    public function eliminarAnimal($id) {
        $stmt = $this->pdo->prepare("DELETE FROM animales WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getAdoptantes() { 
        $stmt = $this->pdo->query("SELECT * FROM adoptantes");
        return $this->arrayToAdoptantes($stmt->fetchAll());
    }
    public function agregarAdoptante($adoptante) {
        $sql = "INSERT INTO adoptantes (nombre, dni, direccion, telefono, email, requisitosCumplidos) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $adoptante->getNombre(),
            $adoptante->getDni(),
            $adoptante->getDireccion(),
            $adoptante->getTelefono(),
            $adoptante->getEmail(),
            $adoptante->cumpleRequisitos() ? 1 : 0
        ]);
        $adoptante->setId($this->pdo->lastInsertId());
    }
    public function buscarAdoptantePorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM adoptantes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? $this->arrayToAdoptante($row) : null;
    }
    public function modificarAdoptante($adoptante) {
        $sql = "UPDATE adoptantes SET 
                    nombre = ?, dni = ?, direccion = ?, telefono = ?, 
                    email = ?, requisitosCumplidos = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $adoptante->getNombre(),
            $adoptante->getDni(),
            $adoptante->getDireccion(),
            $adoptante->getTelefono(),
            $adoptante->getEmail(),
            $adoptante->cumpleRequisitos() ? 1 : 0,
            $adoptante->getId()
        ]);
    }
    public function eliminarAdoptante($id) {
        $stmt = $this->pdo->prepare("DELETE FROM adoptantes WHERE id = ?");
        $stmt->execute([$id]);
    }
    
    public function getAdopciones() { 
        $stmt = $this->pdo->query("SELECT * FROM adopciones");
        return $this->arrayToAdopciones($stmt->fetchAll());
    }
    public function agregarAdopcion($adopcion) {
        $sql = "INSERT INTO adopciones (idAnimal, idAdoptante, fechaAdopcion) 
                VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $adopcion->getIdAnimal(),
            $adopcion->getIdAdoptante(),
            $adopcion->getFechaAdopcion()
        ]);
        $adopcion->setIdAdopcion($this->pdo->lastInsertId());
    }
    public function buscarAdopcionPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM adopciones WHERE idAdopcion = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? $this->arrayToAdopcion($row) : null;
    }
    public function modificarAdopcion($adopcion) {
        $sql = "UPDATE adopciones SET 
                    idAnimal = ?, idAdoptante = ?, fechaAdopcion = ?
                WHERE idAdopcion = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $adopcion->getIdAnimal(),
            $adopcion->getIdAdoptante(),
            $adopcion->getFechaAdopcion(),
            $adopcion->getIdAdopcion()
        ]);

    }
    public function eliminarAdopcion($id) {
        $stmt = $this->pdo->prepare("DELETE FROM adopciones WHERE idAdopcion = ?");
        $stmt->execute([$id]);
    }

    public function getAnimalesListos() {
        $stmt = $this->pdo->prepare("SELECT * FROM animales WHERE LOWER(estado) = ?");
        $stmt->execute(['listo para adopcion']);
        return $this->arrayToAnimales($stmt->fetchAll());
    }
    public function getAdoptantesHabilitados() {
        $stmt = $this->pdo->prepare("SELECT * FROM adoptantes WHERE requisitosCumplidos = ?");
        $stmt->execute([1]);
        return $this->arrayToAdoptantes($stmt->fetchAll());
    }

    public function agregarUsuario($usuario) {
        $sql = "INSERT INTO usuarios (id, username, password, nombre, rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $usuario['id'],
            $usuario['username'],
            $usuario['password'],
            $usuario['nombre'],
            $usuario['rol']
        ]);
    }
    public function verificarCredenciales($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $usuario = $stmt->fetch();
        if ($usuario && $usuario['password'] === $password) {
            return $usuario;
        }
        return false;
    }

    private function arrayToAnimal($row) {
        return new Animal(
            $row['nombre'],
            $row['especie'],
            $row['raza'],
            $row['edad'],
            $row['sexo'],
            $row['caracteristicasFisicas'],
            $row['fechaIngreso'],
            $row['estado'],
            $row['id']
        );
    }
    
    private function arrayToAnimales($rows) {
        $animales = [];
        foreach ($rows as $row) {
            $animales[] = $this->arrayToAnimal($row);
        }
        return $animales;
    }
    
    private function arrayToAdoptante($row) {
        return new Adoptante(
            $row['nombre'],
            $row['dni'],
            $row['direccion'],
            $row['telefono'],
            $row['email'],
            (bool)$row['requisitosCumplidos'],
            $row['id'] 
        );
    }
    private function arrayToAdoptantes($rows) {
        $adoptantes = [];
        foreach ($rows as $row) {
            $adoptantes[] = $this->arrayToAdoptante($row);
        }
        return $adoptantes;
    }
    
    private function arrayToAdopcion($row) {
        return new Adopcion(
            $row['idAnimal'],
            $row['idAdoptante'],
            $row['fechaAdopcion'],
            $row['idAdopcion']
        );
    }
    private function arrayToAdopciones($rows) {
        $adopciones = [];
        foreach ($rows as $row) {
            $adopciones[] = $this->arrayToAdopcion($row);
        }
        return $adopciones;
    }
    
    private function guardarEnSesion() {}

}
?>