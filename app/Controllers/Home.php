<?php

namespace App\Controllers;

use App\Models\MenusModel;
use App\Models\UsersModel;

class Home extends BaseController
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
            'title' => 'Perpustakaan STIKES Papua | Dashboard',
            'titlePage' => 'Dashboard',
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username'))
        ];

        return view('dashboard', $data);
    }
}
