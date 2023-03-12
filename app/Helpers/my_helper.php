<?php

function cekAktifSingleNav($slug)
{
    $menuModel = new \App\Models\MenusModel();

    $menu = $menuModel->getMenus($slug);

    $currentUrl = explode('/', uri_string());
    $active = 'collapsed';

    if ($menu['url'] == "/" . $currentUrl[0]) {
        $active = '';
    }

    return $active;
}

function cekAktifParent($idParent)
{
    $menuModel = new \App\Models\MenusModel();

    $currentUrl = explode('/', uri_string());
    $menu = $menuModel->where(['url' => '/' . $currentUrl[0]])->first();

    $active = 'collapsed';

    if ($menu) {
        if ($menu['parent_id'] == $idParent) {
            $active = '';
        }
    }

    return $active;
}

function cekAktifChild($slug)
{
    $menuModel = new \App\Models\MenusModel();

    $menu = $menuModel->getMenus($slug);

    $currentUrl = explode('/', uri_string());
    $active = '';

    if ($menu['url'] == "/" . $currentUrl[0]) {
        $active = 'class="active"';
    }

    return $active;
}

function cekAkses($roleId, $menuId)
{
    $aksesRoleModel = new \App\Models\AksesRoleModel();

    $aksesRole = $aksesRoleModel->getAkses($roleId, $menuId);

    if ($aksesRole) {
        return "checked";
    } else {
        return "";
    }
}
