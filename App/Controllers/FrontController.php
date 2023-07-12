<?php

namespace App\Controllers;

class FrontController extends Controller
{
    public function home()
    {
        echo $this->templates->render('home/index', [
            'router' => $this->router,
        ]);
    }

    public function otraCarpeta()
    {
        echo $this->templates->render('home/otra', [
            'router' => $this->router,
        ]);
    }

    public function producto($id)
    {
        echo $this->templates->render('home/producto', [
            'router' => $this->router,
            'id'     => $id,
        ]);
    }
}