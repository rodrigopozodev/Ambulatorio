<?php

class Medico {
    private $idMedico;
    private $nombre;
    private $apellidos;
    private $especialidad;

    public function __construct($nombre, $apellidos, $especialidad) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->especialidad = $especialidad;
    }

    public function getIdMedico() {
        return $this->idMedico;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEspecialidad() {
        return $this->especialidad;
    }
}

?>
