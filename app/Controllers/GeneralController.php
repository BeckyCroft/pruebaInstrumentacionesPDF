<?php

namespace App\Controllers;

class GeneralController extends \App\Controllers\BaseController
{
    protected $usuarioModel;
    protected $competenciaModel;
    protected $instrumentacionModel;
    protected $matrizModel;

    function __construct()
    {
        $this->usuarioModel = new \App\Models\UsuarioModel();
        $this->competenciaModel = new \App\Models\CompetenciaModel();
        $this->instrumentacionModel = new \App\Models\InstrumentacionDidacticaModel();
        $this->matrizModel = new \App\Models\MatrizEvaluacionModel();
    }

    public function index()
    {
        var_dump($this->instrumentacionModel->getInstrumentacion());
        echo "<br>";
        echo "<br>";
        var_dump($this->matrizModel->getMatriz());
        echo "<br>";
        echo "<br>";
        var_dump($this->competenciaModel->getNivelesPorCompetencia());
        echo "<br>";
        echo "<br>";
        var_dump($this->competenciaModel->getFuentesPorCompetencia());
        echo "<br>";
        echo "<br>";
        var_dump($this->competenciaModel->getActividadesPorCompetencia());
    }
}
