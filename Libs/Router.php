<?php

namespace Libs;

use AltoRouter;
use App\Controllers\ErrorController;

class Router
{
    private $router;
    private $match;

    public function __construct()
    {
        $this->router = new AltoRouter();
    }

    public function mappingRoutes()
    {
        $this->router->addRoutes([
            // [ ADMIN ]
            ['GET', '/admin/factories/[a:model]', 'Admin\FactoryController#executeFactory', 'admin-factories-execute'],
            ['GET', '/admin', 'Admin\AdminController#index', 'admin-index'],
            // [ PUBLIC ]
            ['GET', '/', 'FrontController#home', 'home_index'],
            ['GET', '/otra/carpeta', 'FrontController#otraCarpeta', 'otra-carpeta'],
            ['GET', '/producto/[i:id]', 'FrontController#producto', 'producto'],
            ['GET', '/manuales/crear', 'ManualController#create', 'manuals-create'],
            ['POST', '/manuales/guardar', 'ManualController#save', 'manuals-save'],
            ['GET', '/manuales/[*:slug]/editar', 'ManualController#edit', 'manuals-edit'],
            ['POST', '/manuales/[*:slug]/actualizar', 'ManualController#update', 'manuals-update'],
            ['GET', '/manuales/[*:slug]', 'ManualController#showBySlug', 'manuals-detail'],
            ['POST', '/manuales/buscar', 'ManualController#search', 'manuals-search'],
            ['GET', '/manuales', 'ManualController#index', 'manuals-index'],
        ]);
    }

    public function matchingRequests()
    {
        $this->match = $this->router->match();// var_dump($this->match);

        if ($this->match === false) {
            $this->open404Error($this->router);
        } else {
            $this->callController($this->match);
        }
    }

    public function open404Error($router)
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        $controllerObject = new ErrorController($router);
        $controllerObject->error404();
    }

    public function callController($match)
    {
        list($controller, $action) = explode('#', $match['target']);
        $controller                = 'App\\Controllers\\' . $controller;
        if (method_exists($controller, $action)) {
            $controllerObject = new $controller($this->router);
            call_user_func_array([$controllerObject, $action], $match['params']);
        } else {
            $this->open404Error($this->router);
        }
    }
}
