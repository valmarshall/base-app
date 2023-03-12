<?php

namespace App\Controllers;

use App\Models\AksesRoleModel;
use App\Models\MenusModel;
use App\Models\RolesModel;
use App\Models\UsersModel;

class AksesRole extends BaseController
{
    protected $menusModel;
    protected $usersModel;
    protected $rolesModel;
    protected $aksesRoleModel;

    public function __construct()
    {
        $this->menusModel = new MenusModel();
        $this->usersModel = new UsersModel();
        $this->rolesModel = new RolesModel();
        $this->aksesRoleModel = new AksesRoleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Akses Role',
            'titlePage' => 'Akses Role',
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username')),
            'roles' => $this->rolesModel->getRole()
        ];

        return view('aksesrole/index', $data);
    }

    public function aksesList($slug)
    {
        $role = $this->rolesModel->getRole($slug);
        $data = [
            'title' => 'Perpustakaan STIKES Papua | Akses Role',
            'titlePage' => 'Akses ' . $role['role'],
            'sidebarMenu' => $this->menusModel->getMenus(),
            'me' => $this->usersModel->getUsers(session()->get('username')),
            'menus' => $this->menusModel->getMenus(),
            'role' => $role
        ];

        return view('aksesrole/akses', $data);
    }

    public function gantiAkses()
    {
        $data = [
            'menuId' => $this->request->getVar('menuId'),
            'roleId' => $this->request->getVar('roleId'),
        ];

        $role = $this->rolesModel->find($data['roleId']);
        $cekAkses = $this->aksesRoleModel->getAkses($data['roleId'], $data['menuId']);
        $menu = $this->menusModel->find($data['menuId']);

        if (!$cekAkses) {
            if ($menu['url'] == '#') {
                $childMenu = $this->menusModel->getMenusChild($menu['id']);

                foreach ($childMenu as $cm) {
                    $this->aksesRoleModel->save([
                        'id_role' => $data['roleId'],
                        'id_menu' => $cm['id']
                    ]);
                }
            }

            if ($menu['parent_id'] != 0) {
                $cekAksesParent = $this->aksesRoleModel->getAkses($role['id'], $menu['parent_id']);

                if (!$cekAksesParent) {
                    $this->aksesRoleModel->save([
                        'id_role' => $data['roleId'],
                        'id_menu' => $menu['parent_id']
                    ]);
                }
            }

            $this->aksesRoleModel->save([
                'id_role' => $data['roleId'],
                'id_menu' => $data['menuId']
            ]);
        } else {
            $this->aksesRoleModel->delete($cekAkses['id']);

            if ($menu['url'] == '#') {
                $childMenu = $this->menusModel->getMenusChild($menu['id']);

                foreach ($childMenu as $cm) {
                    $cekAksesChild = $this->aksesRoleModel->getAkses($role['id'], $cm['id']);
                    $this->aksesRoleModel->delete($cekAksesChild['id']);
                }
            }

            if ($menu['parent_id'] != 0) {
                $childMenu = $this->menusModel->getMenusChild($menu['parent_id']);
                $cekAksesParent = $this->aksesRoleModel->getAkses($role['id'], $menu['parent_id']);
                $countAkses = 0;

                foreach ($childMenu as $cm) {
                    $cekAksesChild = $this->aksesRoleModel->getAkses($role['id'], $cm['id']);

                    if ($cekAksesChild) {
                        $countAkses++;
                    }
                }

                if ($countAkses == 0) {
                    $this->aksesRoleModel->delete($cekAksesParent['id']);
                }
            }
        }
    }
}
