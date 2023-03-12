<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('my_helper');
        $menusModel = new \App\Models\MenusModel();
        $authSession = session()->get('username');

        if (!$authSession) {
            return redirect()->to('/login');
        }

        $currentUrl = explode('/', uri_string());
        $menu = $menusModel->where(['url' => '/' . $currentUrl[0]])->first();

        if (cekAkses(session()->get('role'), $menu['id']) != 'checked') {
            return throw new \Exception("Anda tidak bisa mengakses halaman ini");
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
