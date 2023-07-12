<?php

require_once '../vendor/autoload.php';

use Libs\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

$router = new Router();
$router->mappingRoutes();
$router->matchingRequests();
