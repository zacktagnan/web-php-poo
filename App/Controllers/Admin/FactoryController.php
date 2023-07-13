<?php

namespace App\Controllers\Admin;

use Exception;
use App\Controllers\Controller;
use Database\Factories\ManualFactory;

class FactoryController extends Controller
{
    private $errors;
    private $msg;

    public function __construct($router)
    {
        parent::__construct($router);
        session_start();
        $this->errors = [];
        $this->msg    = '';
    }

    public function executeFactory($model)
    {
        $this->errors = [];

        try {
            switch ($model) {
                case 'manual':
                    $factory = new ManualFactory();
                    $factory->executeFactory();
                    break;

                default:
                    // code...
                    break;
            }
            $this->msg = 'El FACTORY del modelo "' . $model . '" se ejecutó correctamente.';
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        } finally {
            $_SESSION['errors'] = $this->errors;
            $_SESSION['msg']    = $this->msg;

            header('Location: ' . $_SERVER['HTTP_REFERER']);

            // return false;
            // o
            exit;
        }
    }
}
