<?php

namespace App\Models;

use CodeIgniter\Model;

class AksesRoleModel extends Model
{
    protected $table = 'akses_role';
    protected $allowedFields = ['id_role', 'id_menu'];

    public function getAksesByRole($idRole)
    {
        return $this->where(['id_role' => $idRole])->findAll();
    }

    public function getAkses($idRole, $idMenu)
    {
        return $this->where(['id_role' => $idRole, 'id_menu' => $idMenu])->first();
    }
}
