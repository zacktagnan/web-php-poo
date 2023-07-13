<?php $this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'Manuales :: Listado',
]) ?>

<?php $this->start('headJS') ?>
<script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
<?php $this->stop() ?>

<?php $this->insert('partials/search-form'); ?>

<div class="header-list">
    <h1>Listado de Manuales</h1>
    <a href="<?= $router->generate('manuals-create'); ?>" title="Crear uno nuevo">+</a>
</div>

<?php if (count($manuals) == 0): ?>
<div class="manual">
    <p class="center">
        :: Ningún <strong>MANUAL</strong> disponible en estos momentos ::
    </p>
</div>
<?php else: ?>
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
