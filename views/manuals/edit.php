<?php $this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'Manuales :: Editar ' . $manual['title'],
]) ?>

<h1>Editar <em><?= $manual['title']; ?></em></h1>

<?= $this->insert('partials/errors', ['errors' => $errors]) ?>

<?php if ($msg !== ''): ?>
  <div class="notification success">
    <?= $msg ?>
  </div>
<?php endif; ?>

<?= $this->insert('manuals/partials/form', [
    'data'   => $data,
    'manual' => $manual,
    'action' => $action,
    'errors' => $errors,
]); ?>
