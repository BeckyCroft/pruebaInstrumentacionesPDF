<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Capa de datos para el modulo [AUTH]
 */
class CompetenciaModel extends Model
{
    protected $returnType   = 'object';
    protected $table = 'competencia';

    public function getCompetencias()
    {
        return $this->db->table("competencia")
            ->select("*")
            ->get()->getResult();
    }

    /* SELECT * FROM nivel_desempenio nd
        INNER JOIN competencia c ON c.id_competencia = nd.id_competencia;
    */

    public function getNivelesPorCompetencia()
    {
        return $this->db->table("nivel_desempenio nd")
            ->select("*")
            ->join('competencia c', 'c.id_competencia = nd.id_competencia')
            ->get()->getResult();
    }

    /*SELECT * FROM fuente_informacion fi
        INNER JOIN competencia c ON c.id_competencia = fi.id_competencia; */

    public function getFuentesPorCompetencia()
    {
        return $this->db->table("fuente_informacion fi")
            ->select("*")
            ->join('competencia c', 'c.id_competencia = fi.id_competencia')
            ->get()->getResult();
    }

    /*SELECT * FROM actividad_aprendizaje ai
        INNER JOIN competencia c ON c.id_competencia = ai.id_competencia;*/

    public function getActividadesPorCompetencia()
    {
        return $this->db->table("actividad_aprendizaje ai")
            ->select("*")
            ->join('competencia c', 'c.id_competencia = ai.id_competencia')
            ->get()->getResult();
    }
}
