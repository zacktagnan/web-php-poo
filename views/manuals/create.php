<?php $this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'Manuales :: Crear Nuevo',
]) ?>

<h1>Crear un Manual</h1>

<?= $this->insert('partials/errors', ['errors' => $errors]) ?>

<?= $this->insert('manuals/partials/form', [
    'data'   => $data,
    'manual' => $manual,
    'action' => $action,
    'errors' => $errors,
]); ?>
