<?php

namespace App\Controllers;

use App\Models\MenusModel;
use App\Models\UsersModel;

class Menus extends BaseController
{
    protected $menusModel;
    protected $usersModel;

    public function __construct()
    {
        $this->menusModel = new MenusModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Daftar Menu',
            'titlePage' => 'Daftar Menu',
            'menus' => $this->menusModel->getMenus(),
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];

        return view('menus/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Tambah Menu',
            'titlePage' => 'Tambah Menu',
            'menus' => $this->menusModel->getMenus(),
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];

        return view('menus/add', $data);
    }

    public function save()
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'parentId' => $this->request->getVar('parent'),
            'url' => $this->request->getVar('url'),
            'iconClass' => $this->request->getVar('icon')
        ];

        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[menus.nama]',
                'errors' => [
                    'required' => 'Nama menu harus diisi',
                    'is_unique' => 'Nama menu sudah ada, silahkan pilih nama lain'
                ]
            ],
            'parent' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Parent Menu harus dipilih',
                ]
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'URL harus diisi',
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon Class harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/daftar-menu/tambah')->withInput();
        }

        $slug = url_title($data['nama'], '-', true);

        $this->menusModel->save([
            'nama' => $data['nama'],
            'slug' => $slug,
            'parent_id' => $data['parentId'],
            'url' => $data['url'],
            'icon' => $data['iconClass']
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('/daftar-menu');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Edit Menu',
            'titlePage' => 'Edit Menu',
            'menus' => $this->menusModel->getMenus(),
            'menu' => $this->menusModel->getMenus($slug),
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];

        return view('menus/edit', $data);
    }

    public function update()
    {
        $data = [
            'id' => $this->request->getVar('id'),
            'slugLama' => $this->request->getVar('slugLama'),
            'nama' => $this->request->getVar('nama'),
            'parentId' => $this->request->getVar('parent'),
            'url' => $this->request->getVar('url'),
            'iconClass' => $this->request->getVar('icon'),

        ];

        $slug = url_title($data['nama'], '-', true);

        if ($slug == $data['slugLama']) {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama menu harus diisi',
                        'is_unique' => 'Nama menu sudah ada, silahkan pilih nama lain'
                    ]
                ],
                'parent' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Parent Menu harus dipilih',
                    ]
                ],
                'url' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'URL harus diisi',
                    ]
                ],
                'icon' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Icon Class harus diisi',
                    ]
                ],
            ];
        } else {
            $rules = [
                'nama' => [
                    'rules' => 'required|is_unique[menus.nama]',
                    'errors' => [
                        'required' => 'Nama menu harus diisi',
                        'is_unique' => 'Nama menu sudah ada, silahkan pilih nama lain'
                    ]
                ],
                'parent' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Parent Menu harus dipilih',
                    ]
                ],
                'url' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'URL harus diisi',
                    ]
                ],
                'icon' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Icon Class harus diisi',
                    ]
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to('/daftar-menu/edit/' . $data['slugLama'])->withInput();
        }

        $this->menusModel->save([
            'id' => $data['id'],
            'nama' => $data['nama'],
            'slug' => $slug,
            'parent_id' => $data['parentId'],
            'url' => $data['url'],
            'icon' => $data['iconClass']
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/daftar-menu');
    }

    public function delete($slug)
    {
        $menu = $this->menusModel->getMenus($slug);

        $this->menusModel->delete($menu['id']);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/daftar-menu');
    }
}
