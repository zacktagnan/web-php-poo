<?php $this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'Manuales :: Detalle',
]) ?>

<?php $this->start('headJS') ?>
<script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
<?php $this->stop() ?>

<h1><?= $manual['title'] ?></h1>

<div class="manual">
    <h2><?= $manual['excerpt']; ?></h2>
    <?= $manual['description']; ?>
    <!-- <p class="created_at">
        <?php $created_at = date_create($manual['created_at']); ?>
        Creado el <span><?= date_format($created_at, 'd/m/Y H:i:s'); ?></span>
    </p> -->
    <div class="actions-detail">
        <div class="dates">
            <div class="created_at">
                <?php $created_at = date_create($manual['created_at']); ?>
                Creado el <span><?= date_format($created_at, 'd/m/Y H:i:s'); ?></span>
            </div>
            <?php if ($wasUpdated): ?>
            <div class="updated_at">
                <?php $updated_at = date_create($manual['updated_at']); ?>
                (editado: <span><?= date_format($updated_at, 'd/m/Y H:i:s'); ?>)</span>
            </div>
            <?php endif; ?>
        </div>
        <div class="actions-links">
            <a href="<?= $router->generate('manuals-edit', [
                'slug' => $manual['slug'],
            ]); ?>" title="Modificar datos"><i class="fas fa-edit"></i></a>
            <a href="#" title="Eliminar registro" id="btn-delete"><i class="fas fa-trash"></i></a>
        </div>
    </div>
</div>

<?php $this->start('footerJS') ?>
  <script src="/assets/js/app.js"></script>
<?php $this->stop() ?>
