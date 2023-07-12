<?php

namespace App\Controllers;

use League\Plates\Engine;

class Controller
{
    protected $templates;
    protected $router;

    public function __construct($router)
    {
        $this->templates = new Engine('../views');
        $this->router    = $router;
    }
}