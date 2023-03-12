<?php

namespace App\Controllers;

use App\Models\MenusModel;
use App\Models\RolesModel;
use App\Models\UsersModel;

class Roles extends BaseController
{
    protected $rolesModel;
    protected $menusModel;
    protected $usersModel;

    public function __construct()
    {
        $this->rolesModel = new RolesModel();
        $this->menusModel = new MenusModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Daftar Role',
            'titlePage' => 'Daftar Role Pengguna',
            'roles' => $this->rolesModel->getRole(),
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];


        return view('roles/index', $data);
    }

    public function save()
    {
        $data = [
            'role' => $this->request->getVar('role'),
            'slug' => url_title($this->request->getVar('role'), '-', true)
        ];


        if (!$this->validate([
            'role' => [
                'rules' => 'required|is_unique[roles.role]',
                'errors' => [
                    'required' => 'Nama role tidak boleh kosong',
                    'is_unique' => 'Nama role sudah ada'
                ]
            ]
        ])) {
            return redirect()->to('/daftar-role')->withInput();
        }

        $this->rolesModel->save([
            'role' => $data['role'],
            'slug' => $data['slug']
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('/daftar-role');
    }

    public function update()
    {
        $slugLama = $this->request->getVar('slug');
        $namaInputRole = 'role' . $slugLama;

        $data = [
            'id' => $this->request->getVar('id'),
            'role' => $this->request->getVar($namaInputRole),
            'slug' => url_title($this->request->getVar($namaInputRole), '-', true)
        ];

        if ($data['slug'] == $slugLama) {
            $rules = [
                $namaInputRole => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama role tidak boleh kosong',
                    ]
                ]
            ];
        } else {
            $rules = [
                $namaInputRole => [
                    'rules' => 'required|is_unique[roles.role]',
                    'errors' => [
                        'required' => 'Nama role tidak boleh kosong',
                        'is_unique' => 'Nama role sudah ada'
                    ]
                ]
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to('/daftar-role')->withInput();
        }

        $this->rolesModel->save([
            'id' => $data['id'],
            'role' => $data['role'],
            'slug' => $data['slug']
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/daftar-role');
    }

    public function delete($slug)
    {
        $role = $this->rolesModel->getRole($slug);

        $this->rolesModel->delete($role['id']);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/daftar-role');
    }
}
