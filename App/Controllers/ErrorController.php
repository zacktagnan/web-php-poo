<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    private $color;

    public function __construct($router)
    {
        parent::__construct($router);
        $this->color = '#00ccff';
    }

    public function error404()
    {
        echo $this->templates->render('errors/404', [
            'router' => $this->router,
            'color'  => $this->color,
        ]);
    }
}
