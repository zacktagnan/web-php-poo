<?php

namespace App\Requests;

use Libs\Utilities;
use App\Models\Manual;

class ManualStoreRequest
{
    private $utilities;

    public function __construct()
    {
        $this->utilities = new Utilities();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    private function rules()
    {
        return [
            'title' => [
                'required' => 1,
                'unique'   => 1,
                'length'   => [
                    'between' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
            ],
            'excerpt' => [
                'required' => 1,
                'length'   => [
                    'between' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
            ],
            'order' => [
                'required' => 1,
                'type'     => FILTER_VALIDATE_INT,
            ],
            'description' => [
                'required' => 1,
                'length'   => [
                    'min' => 50,
                ],
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    private function messages()
    {
        return [
            'title' => [
                'required' => '',
                'unique'   => 'El TÍTULO debe ser único. Éste ya existe para otro manual registrado.',
                'length'   => [
                    'between' => "El TÍTULO debe tener un tamaño comprendido entre los {$this->rules()['title']['length']['between']['min']} y {$this->rules()['title']['length']['between']['max']} caracteres.",
                ],
            ],
            'excerpt' => [
                'required' => '',
                'length'   => [
                    'between' => "El EXTRACTO debe tener un tamaño comprendido entre los {$this->rules()['excerpt']['length']['between']['min']} y {$this->rules()['excerpt']['length']['between']['max']} caracteres.",
                ],
            ],
            'order' => [
                'required' => '',
                'type'     => 'El ORDEN asignado debe ser un número entero.',
            ],
            'description' => [
                'required' => '',
                'length'   => [
                    'min' => "La DESCRIPCIÓN debe tener un tamaño mínimo de {$this->rules()['description']['length']['min']} caracteres.",
                ],
            ],
        ];
    }

    /**
     * Sanitize the received data by the request with PHP filters
     *
     * @param array $request
     * @return array
     */
    public function sanitize()
    {
        // $data                = [];
        // $data['title']       = filter_var(trim($_POST['title'] ?? ''), FILTER_SANITIZE_STRING);
        // $data['excerpt']     = filter_var(trim($_POST['excerpt'] ?? ''), FILTER_SANITIZE_STRING);
        // $data['order']       = filter_var(trim($_POST['order'] ?? ''), FILTER_SANITIZE_NUMBER_INT);
        // $data['description'] = filter_var(trim($_POST['description'] ?? ''), FILTER_SANITIZE_STRING);

        // FILTER_SANITIZE_STRING deprecado desde PHP 8.1
        // ===============================================

        // var_dump($_POST);
        // die();

        $data = $_POST;
        $data = $this->utilities->formatArrayData($data);

        return $data;
    }

    public function validate($data)
    {
        $errors = [];

        if (strlen($data['title']) < $this->rules()['title']['length']['between']['min'] || strlen($data['title']) > $this->rules()['title']['length']['between']['max']) {
            $errors[] = $this->messages()['title']['length']['between'];
        }

        if ($this->rules()['title']['unique']) {
            $model   = new Manual();
            $results = $model->searchIfExists('title', $data['title']);
            if (count($results) > 0) {
                $errors[] = $this->messages()['title']['unique'];
            }
        }

        if (strlen($data['excerpt']) < $this->rules()['excerpt']['length']['between']['min'] || strlen($data['excerpt']) > $this->rules()['excerpt']['length']['between']['max']) {
            $errors[] = $this->messages()['excerpt']['length']['between'];
        }

        if (!filter_var($data['order'], $this->rules()['order']['type'])) {
            $errors[] = $this->messages()['order']['type'];
        }

        if (strlen($data['description']) < $this->rules()['description']['length']['min']) {
            $errors[] = $this->messages()['description']['length']['min'];
        }

        return $errors;
    }
}
