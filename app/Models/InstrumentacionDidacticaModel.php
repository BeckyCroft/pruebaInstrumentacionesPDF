<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Capa de datos para el modulo [AUTH]
 */
class InstrumentacionDidacticaModel extends Model
{
    protected $returnType   = 'object';
    protected $table = 'instrumentacion_didactica';

    public function getInstrumentaciones()
    {
        return $this->db->table("instrumentacion_didactica")
            ->select("*")
            ->get()->getResult();
    }

    /*
        SELECT * FROM instrumentacion_didactica i
        INNER JOIN estatus_instrumentacion e ON e.id_estatus_instrumentacion = i.id_estatus_instrumentacion
        INNER JOIN asignatura a ON a.clave_asignatura=i.clave_asignatura
        INNER JOIN periodo p ON p.periodo=a.periodo
        INNER JOIN area ar ON ar.id_area =a.id_area
        INNER JOIN funcionario f ON f.rfc_funcionario= i.usuario ;
    */
    public function getInstrumentacion()
    {
        return $this->db->table("instrumentacion_didactica i")
        ->select("*")
        ->join('estatus_instrumentacion e', 'e.id_estatus_instrumentacion = i.id_estatus_instrumentacion')
        ->join('asignatura a', 'a.clave_asignatura=i.clave_asignatura')
        ->join('periodo p', 'p.periodo=a.periodo')
        ->join('area ar', 'ar.id_area =a.id_area')
        ->join('funcionario f', 'f.rfc_funcionario= i.usuario')
        ->get()->getResult();
    }
}
