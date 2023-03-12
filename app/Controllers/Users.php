<?php

namespace App\Controllers;

use App\Models\MenusModel;
use App\Models\RolesModel;
use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;
    protected $rolesModel;
    protected $menusModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->rolesModel = new RolesModel();
        $this->menusModel = new MenusModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Daftar User',
            'titlePage' => 'Daftar User',
            'roles' => $this->rolesModel->getRole(),
            'users' => $this->usersModel->getUsers(),
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];

        return view('users/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Tambah User',
            'titlePage' => 'Tambah User',
            'roles' => $this->rolesModel->getRole(),
            'users' => $this->usersModel->getUsers(),
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];

        return view('users/add', $data);
    }

    public function save()
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'idRole' => $this->request->getVar('role'),
            'password' => $this->request->getVar('password'),
            'rePassword' => $this->request->getVar('rePassword')
        ];

        if ($data['password']) {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi'
                    ]
                ],
                'username' => [
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username harus diisi',
                        'is_unique' => 'Username sudah dipakai'
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role harus dipilih'
                    ]
                ],
                'password' => [
                    'rules' => 'required|matches[rePassword]|min_length[6]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'matches' => 'Password tidak sama dengan konfirmasi password',
                        'min_length' => 'Password minimal 6 karakter'
                    ]
                ],
                'rePassword' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konfirmasi password harus diisi',
                    ]
                ],
            ];
        } else {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi'
                    ]
                ],
                'username' => [
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username harus diisi',
                        'is_unique' => 'Username sudah dipakai'
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role harus dipilih'
                    ]
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to('/daftar-user/tambah')->withInput();
        }

        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->usersModel->save([
            'id_role' => $data['idRole'],
            'username' => $data['username'],
            'password' => $passwordHash,
            'nama' => $data['nama']
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('/daftar-user');
    }

    public function edit($username)
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Edit User',
            'titlePage' => 'Edit User',
            'roles' => $this->rolesModel->getRole(),
            'user' => $this->usersModel->getUsers($username),
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];

        return view('users/edit', $data);
    }

    public function update()
    {
        $data = [
            'id' => $this->request->getVar('id'),
            'usernameLama' => $this->request->getVar('usernameLama'),
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'role' => $this->request->getVar('role')
        ];

        if ($data['usernameLama'] == $data['username']) {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi'
                    ]
                ],
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username harus diisi',
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role harus dipilih'
                    ]
                ],
            ];
        } else {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi'
                    ]
                ],
                'username' => [
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username harus diisi',
                        'is_unique' => 'Username sudah dipakai'
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role harus dipilih'
                    ]
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to('/daftar-user/edit/' . $data['usernameLama'])->withInput();
        }

        $this->usersModel->save([
            'id' => $data['id'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'id_role' => $data['role']
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/daftar-user');
    }

    public function delete($username)
    {
        $user = $this->usersModel->getUsers($username);

        $this->usersModel->delete($user['id']);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/daftar-user');
    }
}
