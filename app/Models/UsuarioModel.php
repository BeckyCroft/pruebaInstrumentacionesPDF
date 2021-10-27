<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Capa de datos para el modulo [AUTH]
 */
class UsuarioModel extends Model
{
    protected $returnType   = 'object';
    protected $table = 'usuario';

    public function getUsuarios()
    {
        return $this->db->table("usuario")
            ->select("*")
            ->get()->getResult();
    }
}
