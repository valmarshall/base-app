<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AksesRoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_role' => 1,
                'id_menu' => 1
            ],
            [
                'id_role' => 1,
                'id_menu' => 2
            ],
            [
                'id_role' => 1,
                'id_menu' => 3
            ],
            [
                'id_role' => 1,
                'id_menu' => 4
            ],
            [
                'id_role' => 1,
                'id_menu' => 5
            ],
            [
                'id_role' => 1,
                'id_menu' => 6
            ],
            [
                'id_role' => 1,
                'id_menu' => 7
            ],
        ];

        foreach ($data as $d) {
            $this->db->table('akses_role')->insert($d);
        }
    }
}
