<?php $this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'Producto ' . $id,
]) ?>

<h1>Producto <?= $id ?></h1>