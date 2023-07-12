<?php $this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'Página no encontrada',
]) ?>

<h1>Página no encontrada</h1>

<h2>Error 404 ... :)</h2>

<p>No se ha encontrado el recurso que ha sido solicitado en el servidor.</p>

<p>Volver al <strong><a href="<?= $router->generate('home_index'); ?>" title="Volver al INICIO" style="color: <?= $color; ?>;">INICIO</a></strong></p>