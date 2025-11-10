<?php
// ModelAdoptante.php - SOLO LÓGICA DE DATOS
require_once __DIR__ . '/../db/class_db.php';

class Adoptante {
    private static $ultimoId = 0;
    
    
    private $id;
    private $nombre;
    private $dni;
    private $direccion;
    private $telefono;
    private $email;
    private $requisitosCumplidos;
    // ---------------------------------------------

    public function __construct($nombre, $dni, $direccion, $telefono, $email, $requisitosCumplidos, $id = null) {
        // Generación del ID (Corregido para permitir carga desde DB)
        if ($id === null) {
            self::$ultimoId++;
            $this->id = self::$ultimoId;
        } else {
            $this->id = $id;
        }
        
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->requisitosCumplidos = $requisitosCumplidos;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getDni() { return $this->dni; }
    public function getDireccion() { return $this->direccion; }
    public function getTelefono() { return $this->telefono; }
    public function getEmail() { return $this->email; }
    public function cumpleRequisitos() { return $this->requisitosCumplidos; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDni($dni) { $this->dni = $dni; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setEmail($email) { $this->email = $email; }
    public function setRequisitosCumplidos($valor) { $this->requisitosCumplidos = $valor; }

}
?>