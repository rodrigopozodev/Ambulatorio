<?php

class Paciente {
    private $idPaciente;
    private $dni;
    private $nombre;
    private $apellidos;
    private $genero;
    private $fechaNacimiento;
    private $idMedicosAsignados;

    public function __construct($dni, $nombre, $apellidos, $genero, $fechaNacimiento, $idMedicosAsignados) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->genero = $genero;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->idMedicosAsignados = $idMedicosAsignados;
    }

    public function getIdPaciente() {
        return $this->idPaciente;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getIdMedicosAsignados() {
        return $this->idMedicosAsignados;
    }
}

?>
