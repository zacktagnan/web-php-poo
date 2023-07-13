<div class="manual">
    <h2 class="sin_margin_bottom"><?= $manual['title']; ?></h2>
    <p class="created_at_header">
        <?php $created_at = date_create($manual['created_at']); ?>
        Creado el <span><?= date_format($created_at, 'd/m/Y H:i:s'); ?></span>
    </p>
    <p>
        <?= $manual['excerpt']; ?>
    </p>
    <div class="actions-list">
        <!-- <a href="/manuales/<?= $manual['slug']; ?>" title="Ver detalle">Acceder</a> -->
        <a href="<?= $router->generate('manuals-detail', [
            'slug' => $manual['slug'],
        ]); ?>" title="Ver detalle"><i class="fas fa-info-circle"></i></a>
    </div>
</div>
