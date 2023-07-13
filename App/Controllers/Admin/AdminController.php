<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;

class AdminController extends Controller
{
    public function index($errors = [], $msg = '')
    {
        echo $this->templates->render('admin/index', [
            'router'   => $this->router,
            'errors'   => $errors,
            'msg'      => $msg,
        ]);
    }
}
