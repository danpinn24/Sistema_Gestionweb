<?php
// ModelAnimal.php - SOLO LÓGICA DE DATOS
require_once __DIR__ . '/../db/class_db.php';

class Animal
{
    // Propiedades Declaradas
    private $id; 
    private $nombre; 
    private $especie;
    private $raza;
    private $edad;
    private $sexo;
    private $caracteristicasFisicas;
    private $fechaIngreso;
    private $estado;

    public function __construct($nombre, $especie, $raza, $edad, $sexo, $caracteristicasFisicas, $fechaIngreso, $estado, $id = null)
    {
        // El ID es asignado por la clase DB
        $this->id = $id; 
        
        $this->nombre = $nombre;
        $this->especie = $especie;
        $this->raza = $raza;
        $this->edad = $edad;
        $this->sexo = $sexo;
        $this->caracteristicasFisicas = $caracteristicasFisicas;
        $this->fechaIngreso = $fechaIngreso;
        $this->estado = $estado;
    }
    
    // Getters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getEspecie() { return $this->especie; }
    public function getRaza() { return $this->raza; }
    public function getEdad() { return $this->edad; }
    public function getSexo() { return $this->sexo; }
    public function getCaracteristicasFisicas() { return $this->caracteristicasFisicas; }
    public function getFechaIngreso() { return $this->fechaIngreso; }
    public function getEstado() { return $this->estado; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setEspecie($especie) { $this->especie = $especie; } 
    public function setRaza($raza) { $this->raza = $raza; }
    public function setEdad($edad) { $this->edad = $edad; }
    public function setSexo($sexo) { $this->sexo = $sexo; }
    public function setCaracteristicasFisicas($caracteristicasFisicas) { $this->caracteristicasFisicas = $caracteristicasFisicas; }
    public function setFechaIngreso($fechaIngreso) { $this->fechaIngreso = $fechaIngreso; }
    public function setEstado($estado) { $this->estado = $estado; }


}
?>