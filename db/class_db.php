<?php
// db/class_db.php (VERSIÓN ANOTADA PARA APRENDER)

// Incluimos los "moldes" (Modelos)
// Los necesitamos para las funciones de "Traducción" al final
require_once __DIR__ . '/../model/ModelAnimal.php';
require_once __DIR__ . '/../model/ModelAdoptante.php';
require_once __DIR__ . '/../model/ModelAdopcion.php';

class DB {

    // =================================================================
    // PARTE 1: EL PATRÓN "SINGLETON" (CONEXIÓN ÚNICA)
    // =================================================================
    
    // $instance guarda la única conexión.
    // "private static" significa que esta variable pertenece a la CLASE,
    // no a un objeto individual.
    private static $instance = null;
    
    // $pdo es la conexión real a la base de datos (nuestro "enchufe")
    private $pdo; 
    
    // La ruta al archivo de la base de datos.
    private static $db_file = __DIR__ . '/refugio.db'; 

    /**
     * El "Portal de Acceso" a la Base de Datos.
     * * Esta es la función que llamas en index.php con `DB::getInstance()`.
     *
     * ¿Por qué no usamos `new DB()`?
     * Porque si hiciéramos `new DB()` en cada controlador, abriríamos
     * 5 o 6 conexiones diferentes.
     *
     * Este método "Singleton" (Instancia Única) es como un vigilante:
     * 1. Revisa si ya existe una conexión (`self::$instance == null`).
     * 2. Si NO existe, crea una (`new DB()`) y la guarda.
     * 3. Si YA existe, simplemente te devuelve la que ya estaba guardada.
     *
     * Así nos aseguramos de que TODA la aplicación usa UNA SOLA conexión.
     */
    public static function getInstance() {
        if (self::$instance == null) {
            // Llama al constructor (ver abajo) SÓLO la primera vez.
            self::$instance = new DB();
        }
        return self::$instance;
    }

    /**
     * El "Constructor" - El trabajo de instalación.
     * * "private function" significa que NADIE puede llamarlo desde fuera.
     * Esto "fuerza" a que todos deban usar el portal `getInstance()` de arriba.
     *
     * Este código se ejecuta UNA SOLA VEZ (la primera vez que se llama a getInstance).
     */
    private function __construct() {
        
        // Vemos si el archivo refugio.db existe.
        $db_es_nuevo = !file_exists(self::$db_file);

        try {
            // 1. Nos conectamos al archivo. Si no existe, lo crea.
            // "pdo" (PHP Data Objects) es el "idioma" estándar de PHP para
            // hablar con bases de datos (SQLite, MySQL, PostgreSQL, etc.)
            $this->pdo = new PDO('sqlite:' . self::$db_file);
            
            // 2. Le decimos a PDO que si hay un error de SQL, "grite"
            // (lance una Excepción) en lugar de fallar en silencio.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // 3. Le decimos que nos devuelva los datos como arrays asociativos
            // (ej. ['nombre' => 'Fido', 'edad' => 3])
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // 4. Si la base de datos era nueva, hay que crear las tablas.
            if ($db_es_nuevo) {
                $this->init(); // Llamamos a la función de abajo.
            }

        } catch (PDOException $e) {
            die("Error de conexión con la base de datos: " . $e->getMessage());
        }
    }
    
    /**
     * El "Arquitecto": Se ejecuta 1 SOLA VEZ para crear las tablas.
     * Dibuja el "plano" (schema) de nuestra base de datos.
     */
    private function init() {
        try {
            // 1. CREAR TABLAS
            // Usamos ->exec() para "ejecutar" comandos SQL que no devuelven datos.
            
            // IF NOT EXISTS: "Créala solo si no existe ya"
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

            // 2. CARGAR DATOS INICIALES
            // Como las tablas están vacías, llamamos a tu script.
            // loadDatos() llamará a los métodos de esta misma clase
            // (ej. agregarUsuario, agregarAnimal)
            require_once __DIR__ . '/../loadDatos.php'; 
            loadDatos($this); 

        } catch (PDOException $e) {
            die("Error al inicializar la base de datos: " . $e->getMessage());
        }
    }
    
    // =================================================================
    // PARTE 2: EL MÉTODO SEGURO DE 2 PASOS (Consultas Preparadas)
    // =================================================================
    
    // DE AQUÍ EN ADELANTE, CASI TODO USA EL MISMO PATRÓN
    //
    // ¿POR QUÉ NO HACEMOS ESTO? (INSEGURO)
    // $this->pdo->exec("INSERT INTO animales (nombre) VALUES ('$nombre')");
    // Porque si $nombre es "Fido'); DROP TABLE usuarios; --"
    // un atacante podría BORRARNOS LA TABLA (Inyección SQL).
    //
    // LA FORMA SEGURA ES USAR "Consultas Preparadas" (2 Pasos):
    // PASO 1: ->prepare(): Enviamos la "plantilla" SQL a la DB,
    //         usando un '?' como marcador de posición.
    // PASO 2: ->execute(): Enviamos los "datos" por separado.
    //
    // La base de datos recibe la plantilla y los datos, y ella misma
    // se encarga de "limpiar" los datos para que sean 100% seguros.

    // ==========================================================
    // === GESTIÓN DE ANIMALES ===
    // ==========================================================
    
    public function getAnimales() { 
        // ->query() es un atajo para consultas simples que no tienen
        // datos del usuario (no hay riesgo de Inyección SQL).
        $stmt = $this->pdo->query("SELECT * FROM animales");
        
        // fetchAll() recoge todos los resultados en un array.
        // Y se lo pasamos al "Traductor" (ver PARTE 3)
        return $this->arrayToAnimales($stmt->fetchAll());
    }
    
    public function agregarAnimal($animal) {
        // La "plantilla" SQL.
        $sql = "INSERT INTO animales (nombre, especie, raza, edad, sexo, caracteristicasFisicas, fechaIngreso, estado) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // PASO 1: Preparar la plantilla
        $stmt = $this->pdo->prepare($sql);
        
        // PASO 2: Ejecutar con los datos (en el mismo orden que los '?')
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
        // Le asignamos al objeto el ID que la DB le acaba de dar
        $animal->setId($this->pdo->lastInsertId());
    }
    
    public function buscarAnimalPorId($id) {
        // PASO 1: Preparar la plantilla
        $stmt = $this->pdo->prepare("SELECT * FROM animales WHERE id = ?");
        // PASO 2: Ejecutar con los datos
        $stmt->execute([$id]);
        
        // fetch() recoge solo la PRIMERA fila que encontró
        $row = $stmt->fetch(); 
        
        // Si $row no está vacío, lo traducimos a Objeto. Si no, devolvemos null.
        return $row ? $this->arrayToAnimal($row) : null;
    }

    public function modificarAnimal($animal) {
        $sql = "UPDATE animales SET 
                    nombre = ?, especie = ?, raza = ?, edad = ?, sexo = ?, 
                    caracteristicasFisicas = ?, fechaIngreso = ?, estado = ?
                WHERE id = ?"; // El ID también es un dato
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
            $animal->getId() // El último '?'
        ]);
    }

    public function eliminarAnimal($id) {
        $stmt = $this->pdo->prepare("DELETE FROM animales WHERE id = ?");
        $stmt->execute([$id]);
    }

    // ... [Los métodos de Adoptantes y Adopciones son IDÉNTICOS en lógica] ...
    
    // === GESTIÓN DE ADOPTANTES ===
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
            $adoptante->cumpleRequisitos() ? 1 : 0 // Guardamos 1 (true) o 0 (false)
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
    
    // === GESTIÓN DE ADOPCIONES ===
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
    
    // === MÉTODOS DE BÚSQUEDA ESPECÍFICOS ===
    public function getAnimalesListos() {
        $stmt = $this->pdo->prepare("SELECT * FROM animales WHERE LOWER(estado) = ?");
        $stmt->execute(['listo para adopcion']);
        return $this->arrayToAnimales($stmt->fetchAll());
    }
    public function getAdoptantesHabilitados() {
        $stmt = $this->pdo->prepare("SELECT * FROM adoptantes WHERE requisitosCumplidos = ?");
        $stmt->execute([1]); // 1 = true
        return $this->arrayToAdoptantes($stmt->fetchAll());
    }

    // === AUTENTICACIÓN ===
    public function agregarUsuario($usuario) {
        $sql = "INSERT INTO usuarios (id, username, password, nombre, rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $usuario['id'], // Usamos el ID de loadDatos
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

    // =================================================================
    // PARTE 3: LOS "TRADUCTORES" (Hidratación)
    // =================================================================
    
    // Este grupo de funciones es CRUCIAL.
    // La base de datos nos da ARRAYS (ej. ['nombre' => 'Fido', 'id' => 1]).
    // Pero tus Controladores y Vistas (Smarty) esperan OBJETOS
    // (para poder hacer $animal->getNombre()).
    //
    // Estas funciones son "traductores" que convierten los arrays de la
    // base de datos en los objetos (Animal, Adoptante) que
    // el resto de tu aplicación entiende.
    
    /**
     * Traductor: Convierte un Array de la DB en un Objeto Animal
     */
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
            $row['id'] // ID al final, como espera el constructor
        );
    }
    
    /**
     * Traductor Múltiple: Convierte un array de filas en un array de Objetos
     */
    private function arrayToAnimales($rows) {
        $animales = [];
        foreach ($rows as $row) {
            // Llama al traductor de arriba por cada fila
            $animales[] = $this->arrayToAnimal($row);
        }
        return $animales;
    }
    
    // Hacemos lo mismo para Adoptante...
    private function arrayToAdoptante($row) {
        return new Adoptante(
            $row['nombre'],
            $row['dni'],
            $row['direccion'],
            $row['telefono'],
            $row['email'],
            (bool)$row['requisitosCumplidos'], // Convertir 1/0 a true/false
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
    
    // Y para Adopcion...
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
    
    // Esta función ya no hace nada (no usamos Sesión)
    private function guardarEnSesion() {}

} // Fin de la clase DB
?>