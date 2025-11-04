<?php
// ModelAdopcion.php - SOLO LÓGICA DE DATOS
require_once __DIR__ . '/../db/class_db.php';

class Adopcion
{
    private static $ultimoId = 0;
    
    // 🛑 PROPIEDADES DECLARADAS (SOLUCIÓN AL ERROR) 🛑
    private $idAdopcion;
    private $idAnimal;
    private $idAdoptante;
    private $fechaAdopcion;
    // ---------------------------------------------

    public function __construct($idAnimal, $idAdoptante, $fechaAdopcion, $idAdopcion = null)
    {
        // Generación del ID (Corregido para permitir carga desde DB)
        if ($idAdopcion === null) {
            self::$ultimoId++;
            $this->idAdopcion = self::$ultimoId;
        } else {
            $this->idAdopcion = $idAdopcion;
        }
        
        $this->idAnimal = $idAnimal;
        $this->idAdoptante = $idAdoptante;
        $this->fechaAdopcion = $fechaAdopcion;
    }

    // Getters y Setters
    public function getIdAdopcion() { return $this->idAdopcion; }
    public function getIdAnimal() { return $this->idAnimal; }
    public function getIdAdoptante() { return $this->idAdoptante; }
    public function getFechaAdopcion() { return $this->fechaAdopcion; }

    public function setIdAdopcion($id) { $this->idAdopcion = $id; }
    public function setIdAnimal($id) { $this->idAnimal = $id; }
    public function setIdAdoptante($id) { $this->idAdoptante = $id; }
    public function setFechaAdopcion($fecha) { $this->fechaAdopcion = $fecha; }

    // Métodos de persistencia
    public function agregar()
    {
        $db = DB::getInstance();
        $db->agregarAdopcion($this);
    }

    public function modificar($data)
    {
        if (isset($data['idAnimal'])) { $this->setIdAnimal($data['idAnimal']); }
        if (isset($data['idAdoptante'])) { $this->setIdAdoptante($data['idAdoptante']); }
        if (isset($data['fechaAdopcion'])) { $this->setFechaAdopcion($data['fechaAdopcion']); }
        
        $db = DB::getInstance();
        $db->modificarAdopcionPorId($this->idAdopcion, $data);
    }

    public function eliminar()
    {
        $db = DB::getInstance();
        $db->eliminarAdopcion($this->idAdopcion);
    }
}
?>