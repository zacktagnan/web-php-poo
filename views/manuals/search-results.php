<?php $this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'Manuales :: Resultado(s) de Búsqueda',
]) ?>

<?php $this->start('headJS') ?>
<script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
<?php $this->stop() ?>

<?= $this->insert('partials/search-form'); ?>

<h1>Resultado(s) de Búsqueda de Manuales</h1>

<p>Criterio de búsqueda: [<strong class="highlight"><?= $query;?></strong>]</p>

<?php if (count($manuals) === 0): ?>
<p>No se han encontrado manuales relacionados con el criterio de búsqueda especificado.</p>

<?php else: ?>

  <?php if ($query === ''): ?>
<p>Sin haber especificado un criterio de búsqueda concreto, se muestra el listado completo disponible.</p>
  <?php else: ?>
<p>Encontrado(s) <strong class="highlight"><?= count($manuals) ?></strong> manual(es) relacionado(s).
  <?php endif; ?>

  <?php foreach ($manuals as $manual): ?>
    <?= $this->insert('manuals/partials/card', [
        'router' => $router,
        'manual' => $manual,
    ]) ?>
  <?php endforeach; ?>

<?php endif; ?>

<a href="#" class="to-top">
    <i class="fas fa-chevron-up"></i>
</a>

<?php $this->start('footerJS') ?>
  <script src="/assets/js/app.js"></script>
<?php $this->stop() ?>
