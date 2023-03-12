<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Dashboard',
                'slug' => 'dashboard',
                'parent_id' => '0',
                'url' => '/',
                'icon' => 'bi bi-speedometer',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'Pengaturan Pengguna',
                'slug' => 'pengaturan-pengguna',
                'parent_id' => '0',
                'url' => '#',
                'icon' => 'bi bi-person-fill-gear',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'Daftar Role',
                'slug' => 'daftar-role',
                'parent_id' => '2',
                'url' => '/daftar-role',
                'icon' => 'bi bi-circle',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'Daftar User',
                'slug' => 'daftar-user',
                'parent_id' => '2',
                'url' => '/daftar-user',
                'icon' => 'bi bi-circle',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'Management Menu',
                'slug' => 'management-menu',
                'parent_id' => '0',
                'url' => '#',
                'icon' => 'bi bi-menu-button-wide',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'Daftar Menu',
                'slug' => 'daftar-menu',
                'parent_id' => '5',
                'url' => '/daftar-menu',
                'icon' => 'bi bi-circle',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'Akses Role',
                'slug' => 'akses-role',
                'parent_id' => '5',
                'url' => '/akses-role',
                'icon' => 'bi bi-circle',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]
        ];

        foreach ($data as $d) {
            $this->db->table('menus')->insert($d);
        }
    }
}
