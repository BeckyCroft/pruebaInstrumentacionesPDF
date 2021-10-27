<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Capa de datos para el modulo [AUTH]
 */
class MatrizEvaluacionModel extends Model
{
    protected $returnType   = 'object';
    protected $table = 'matriz_evaluacion';

    public function getMatrices()
    {
        return $this->db->table("matriz_evaluacion")
            ->select("*")
            ->get()->getResult();
    }

    /* SELECT * FROM matriz_evaluacion me
        INNER JOIN competencia c ON c.id_competencia = me.id_competencia
        INNER JOIN detalle_matriz dm ON dm.id_detalle_matriz = me.id_detalle_matriz
        INNER JOIN actividad_aprendizaje aa ON aa.id_actividad = dm.id_actividad
        INNER JOIN indicador_alcance ia ON ia.id_indicador = dm.id_indicador;
    */

    public function getMatriz()
    {
        return $this->db->table("matriz_evaluacion me")
            ->select("*")
            ->join('competencia c', 'c.id_competencia = me.id_competencia')
            ->join('detalle_matriz dm', 'dm.id_detalle_matriz = me.id_detalle_matriz')
            ->join('actividad_aprendizaje aa', 'ON aa.id_actividad = dm.id_actividad')
            ->join('indicador_alcance ia', 'ia.id_indicador = dm.id_indicador')
            ->get()->getResult();
    }
}
