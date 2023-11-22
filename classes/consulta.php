<?php

class Consulta {
    private $idConsulta;
    private $idMedico;
    private $idPaciente;
    private $fechaConsulta;
    private $diagnostico;
    private $sintomatologia;

    public function __construct($idMedico, $idPaciente, $fechaConsulta, $diagnostico, $sintomatologia) {
        $this->idMedico = $idMedico;
        $this->idPaciente = $idPaciente;
        $this->fechaConsulta = $fechaConsulta;
        $this->diagnostico = $diagnostico;
        $this->sintomatologia = $sintomatologia;
    }

    public function getIdConsulta() {
        return $this->idConsulta;
    }

    public function getIdMedico() {
        return $this->idMedico;
    }

    public function getIdPaciente() {
        return $this->idPaciente;
    }

    public function getFechaConsulta() {
        return $this->fechaConsulta;
    }

    public function getDiagnostico() {
        return $this->diagnostico;
    }

    public function getSintomatologia() {
        return $this->sintomatologia;
    }
}

?>
