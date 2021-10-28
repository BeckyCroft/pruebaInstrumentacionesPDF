<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Vendor\autoload;

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
        $instrumentacion = $this->instrumentacionModel->getInstrumentacion();
        var_dump($instrumentacion);
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
        echo "<br>";
        echo "<br>";
        var_dump($this->competenciaModel->getCompetenciaPorFolio($instrumentacion->folio_instrumentacion));
    }

    public function pdf()
    {
        $instrumentacion = $this->instrumentacionModel->getInstrumentacion();
        $matriz = $this->matrizModel->getMatriz();
        $nivelesCompetencia = $this->competenciaModel->getNivelesPorCompetencia();
        $fuentesCompetencia = $this->competenciaModel->getFuentesPorCompetencia();
        $actividadesCompetencia = $this->competenciaModel->getActividadesPorCompetencia();
        $competencia = $this->competenciaModel->getCompetenciaPorFolio($instrumentacion->folio_instrumentacion);
        $dompdf = new Dompdf();

        $dompdf->loadHtml(view('pdf', [
            'instrumentacion' => $instrumentacion,
            'matriz' => $matriz,
            'nivelesCompetencia' => $nivelesCompetencia,
            'fuentesCompetencia' => $fuentesCompetencia,
            'actividadesCompetencia' => $actividadesCompetencia,
            'competencia' => $competencia,
        ]));
        $dompdf->setPaper('letter', 'portrait');
        // Se renderiza el HTML como PDF
        $dompdf->render();
        // Se muestra el PDF generado en el Browser

        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="document.pdf"');
        header('Content-Transfer-Encoding: binary');

        $dompdf->stream($instrumentacion->periodo . "_" . $instrumentacion->clave_asignatura . "_" . $instrumentacion->nombre_asignatura . "_" . $instrumentacion->nombre_area . "_" . $instrumentacion->semestre . "_" . $instrumentacion->grupo . "_" . $instrumentacion->nombre_funcionario . "-" . $instrumentacion->apaterno_funcionario . "-" . $instrumentacion->amaterno_funcionario . ".pdf", array("Attachment" => 0));
        exit();

        return redirect("pdf");
    }
}
