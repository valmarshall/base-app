<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_role', 'username', 'password', 'nama', 'id_mahasiswa', 'foto'];

    public function getUsers($username = false)
    {
        if ($username == false) {
            $this->orderBy('nama', 'ASC');
            return $this->findAll();
        }

        return $this->where(['username' => $username])->first();
    }
}
