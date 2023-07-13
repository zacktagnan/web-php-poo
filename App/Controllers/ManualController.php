<?php

namespace App\Controllers;

use Libs\Dates;
use Libs\Router;
use Libs\Utilities;
use App\Models\Manual;
use App\Requests\ManualStoreRequest;
use App\Requests\ManualUpdateRequest;

class ManualController extends Controller
{
    private $manual;
    private $utilities;

    public function __construct($router)
    {
        parent::__construct($router);
        session_start();
        $this->manual    = new Manual();
        $this->utilities = new Utilities();
    }

    public function index()
    {
        $manuals = $this->manual->getAll();
        echo $this->templates->render('manuals/index', [
            'router'  => $this->router,
            'manuals' => $manuals,
        ]);
    }

    public function create()
    {
        $data = [
            'title'       => '',
            'excerpt'     => '',
            'order'       => '',
            'description' => '',
        ];

        echo $this->templates->render('manuals/create', [
            'router'  => $this->router,
            'data'    => $data,
            'manual'  => [],
            'action'  => '/manuales/guardar',
            'errors'  => [],
        ]);
    }

    public function save()
    {
        $manualStoreRequest = new ManualStoreRequest();
        $data               = $manualStoreRequest->sanitize();
        $errors             = $manualStoreRequest->validate($data);

        if (count($errors) === 0) {
            $data['description'] = $this->utilities->formatFromTextAreaToBD($this->utilities->formatToArray($data['description']));

            $id = $this->manual->insert($data);

            if ($id) {
                $manual = $this->manual->getById($id);
                // header("Location: /manuales/{$manual['slug']}");
                // o
                // header('Location: /manuales/' . $manual['slug']);
                // ------------------------------------------------------------
                $this->utilities->redirectTo('/manuales/' . $manual['slug']);
                // return false;
                // o
                exit;
            } else {
                $errors = ['Error al INSERTAR. Intentarlo de nuevo más tarde.'];
            }
        }

        echo $this->templates->render('manuals/create', [
            'router'  => $this->router,
            'data'    => $data,
            'manual'  => [],
            'action'  => '/manuales/guardar',
            'errors'  => $errors,
        ]);
    }

    public function edit($slug)
    {
        $manual                = $this->getRecordData($slug);
        $manual['description'] = $this->utilities->formatFromBDToTextArea($manual['description']);

        if (isset($_SESSION['arrayData']) && $_SESSION['arrayData'] !== '') {
            if (isset($_SESSION['arrayData']['data']) && is_array($_SESSION['arrayData']['data'])) {
                $data = $_SESSION['arrayData']['data'];
            }
            if (isset($_SESSION['arrayData']['errors']) && is_array($_SESSION['arrayData']['errors'])) {
                $errors = $_SESSION['arrayData']['errors'];
            }
            if (isset($_SESSION['arrayData']['msg']) && $_SESSION['arrayData']['msg'] !== '') {
                $msg = $_SESSION['arrayData']['msg'];
            }
            unset($_SESSION['arrayData']);
        }

        echo $this->templates->render('manuals/edit', [
            'router'  => $this->router,
            'data'    => $data ?? [],
            'manual'  => $manual,
            'action'  => "/manuales/{$manual['slug']}/actualizar",
            'errors'  => $errors ?? [],
            'msg'     => $msg ?? '',
        ]);
    }

    public function update($slug)
    {
        $manual                        = $this->manual->getBySlug($slug);
        $manualUpdateRequest           = new ManualUpdateRequest();
        $data                          = $_SESSION['arrayData']['data']   = $manualUpdateRequest->sanitize();
        $errors                        = $_SESSION['arrayData']['errors'] = $manualUpdateRequest->validate($data, $manual['id']);

        if (count($errors) === 0) {
            $data['description'] = $this->utilities->formatFromTextAreaToBD($this->utilities->formatToArray($data['description']));

            $manual                = $this->manual->update($slug, $data);
            $manual['description'] = $this->utilities->formatFromBDToTextArea($manual['description']);

            if ($manual) {
                $_SESSION['arrayData']['data'] = [];
                $_SESSION['arrayData']['msg']  = 'Editado correctamente';
            } else {
                $_SESSION['arrayData']['errors'] = ['Error al ACTUALIZAR. Intentarlo de nuevo más tarde.'];
            }
        }

        header('Location: /manuales/' . $manual['slug'] . '/editar');
        exit;
    }

    public function showBySlug($slug)
    {
        $manual     = $this->getRecordData($slug);
        $wasUpdated = Dates::datesAreDifferent($manual['created_at'], $manual['updated_at']);

        echo $this->templates->render('manuals/detail', [
            'router'      => $this->router,
            'manual'      => $manual,
            'wasUpdated'  => $wasUpdated,
        ]);
    }

    private function getRecordData($slug)
    {
        $manual = $this->manual->getBySlug($slug);

        if (is_null($manual)) {
            $routerError = new Router();
            $routerError->open404Error($this->router);
            exit;
        }

        return $manual;
    }

    public function search()
    {
        $query = $_POST['query'] ?? '';
        // $query = trim($query);
        // $query = filter_var($query, FILTER_SANITIZE_STRING);
        $query = $this->utilities->formatData($query);

        $manuals = $this->manual->search($query);

        echo $this->templates->render('manuals/search-results', [
            'router'   => $this->router,
            'manuals'  => $manuals,
            'query'    => $query,
        ]);
    }
}
