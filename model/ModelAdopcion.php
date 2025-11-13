<?php
require_once __DIR__ . '/../db/class_db.php';

class Adopcion
{
    private static $ultimoId = 0;
    private $idAdopcion;
    private $idAnimal;
    private $idAdoptante;
    private $fechaAdopcion;

    public function __construct($idAnimal, $idAdoptante, $fechaAdopcion, $idAdopcion = null)
    {
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

    public function getIdAdopcion() { return $this->idAdopcion; }
    public function getIdAnimal() { return $this->idAnimal; }
    public function getIdAdoptante() { return $this->idAdoptante; }
    public function getFechaAdopcion() { return $this->fechaAdopcion; }

    public function setIdAdopcion($id) { $this->idAdopcion = $id; }
    public function setIdAnimal($id) { $this->idAnimal = $id; }
    public function setIdAdoptante($id) { $this->idAdoptante = $id; }
    public function setFechaAdopcion($fecha) { $this->fechaAdopcion = $fecha; }

  
}
?>