<?php

namespace App\Models;

use CodeIgniter\Model;

class MenusModel extends Model
{
    protected $table = 'menus';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'parent_id', 'url', 'icon'];

    public function getMenus($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getMenusChild($parentId)
    {
        return $this->where(['parent_id' => $parentId])->findAll();
    }
}
