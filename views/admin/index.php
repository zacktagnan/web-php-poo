<?php
session_start();

$this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'ADMIN - Escritorio',
]) ?>

<h1>ADMIN</h1>

<?= $this->insert('partials/admin/errors', ['errors' => $errors]) ?>
<?php //if ($msg !== ''):?>
<?php if (isset($_SESSION['msg']) && $_SESSION['msg'] !== ''): ?>
<?php
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
?>
  <div class="notification success">
    <?= $msg ?>
  </div>
<?php endif; ?>

<div class="dashboard-panel">
    <h2>Ejecutar Factorías</h2>
    <div>
        <div><a href="/admin/factories/manual" title="Generar FACTORY correspondiente">Para el modelo <strong>Manual</strong></a></div>
        <div><a href="#" title="Generar FACTORY correspondiente">Para el modelo <strong>Xxx2</strong></a></div>
        <div><a href="#" title="Generar FACTORY correspondiente">Para el modelo <strong>Xxx3</strong></a></div>
        <div><a href="#" title="Generar FACTORY correspondiente">Para el modelo <strong>Xxx4</strong></a></div>
        <div><a href="#" title="Generar FACTORY correspondiente">Para el modelo <strong>Xxx5</strong></a></div>
    </div>
</div>