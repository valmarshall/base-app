<?php

namespace App\Controllers;

use App\Models\MenusModel;
use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $usersModel;
    protected $menusModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->menusModel = new MenusModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Login',
        ];

        return view('auth/login', $data);
    }

    public function login()
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password')
        ];

        $rules = [
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/login')->withInput();
        }

        $user = $this->usersModel->getUsers($data['username']);
        $sessTry = session()->getTempdata('try');
        $randomSessionTime = rand(300, 900);

        if ($sessTry <= 3) {
            if ($user) {
                if (password_verify($data['password'], $user['password'])) {
                    $sessionData = [
                        'username' => $data['username'],
                        'role' => $user['id_role']
                    ];

                    session()->set($sessionData);
                    return redirect()->to('/');
                } else {
                    $sessTry += 1;

                    session()->setTempdata('try', $sessTry, $randomSessionTime);
                    session()->setFlashdata('pesan', 'Password salah!');

                    return redirect()->to('/login')->withInput();
                }
            } else {
                $sessTry += 1;

                session()->setTempdata('try', $sessTry, $randomSessionTime);
                session()->setFlashdata('pesan', 'Username tidak terdaftar!');

                return redirect()->to('/login')->withInput();
            }
        } else {
            session()->setFlashdata('pesan', 'Anda sudah gagal login sebanyak 3 kali, coba lagi dalam beberapa menit!');

            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }

    public function changepassword()
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Dashboard',
            'titlePage' => 'Dashboard',
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];

        return view('auth/changepassword', $data);
    }

    public function change()
    {
        $me = $this->usersModel->getUsers(session()->get('username'));

        $data = [
            'password' => $this->request->getVar('password'),
            'newPassword' => $this->request->getVar('newPassword'),
            'rePassword' => $this->request->getVar('rePassword')
        ];

        $rules = [
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'newPassword' => [
                'rules' => 'required|min_length[6]|matches[rePassword]',
                'errors' => [
                    'required' => 'Password baru harus diisi',
                    'min_length' => 'Password minimal 6 karakter',
                    'matches' => 'Password tidak sama dengan konfirmasi password'
                ]
            ],
            'rePassword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Konfirmasi Password harus diisi',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/ganti-password')->withInput();
        }

        if (password_verify($data['password'], $me['password'])) {
            $passwordHash = password_hash($data['newPassword'], PASSWORD_DEFAULT);

            $this->usersModel->save([
                'id' => $me['id'],
                'password' => $passwordHash
            ]);

            session()->setFlashdata('pesan', 'Password berhasil di ganti');
            return redirect()->to('/ganti-password');
        } else {
            session()->setFlashdata('pesanGagal', 'Password anda salah');
            return redirect()->to('/ganti-password');
        }
    }
}
