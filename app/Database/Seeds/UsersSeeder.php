<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $password = password_hash('mrivaldi', PASSWORD_DEFAULT);
        $data = [
            'id_role' => '1',
            'username' => 'mrivaldi',
            'password' => $password,
            'nama' => 'Muhammad Rivaldi',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ];

        $this->db->table('users')->insert($data);
    }
}
