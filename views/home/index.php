<?php $this->layout('layouts/public', [
    'router'    => $router,
    'mainTitle' => 'Home del proyecto',
]) ?>

<h1>Separando las vistas</h1>

<p>Estamos haciendo la separación de las vistas.</p>

<p>Todo mientras el proyecto se encuentra en modo <strong>"<?= $_ENV['APP_MODE'] ?>"</strong>.</p>

<?php $this->insert('partials/some-markup', [
    'courseTitle'       => 'Aplicaciones Profesionales con PHP',
    'courseDescription' => 'Técnicas para desarrollar aplicaciones con PHP de manera profesional.',
]); ?>

<?php $this->start('footerLinks') ?>
  <p>
    <a href="/otra/carpeta">Otra ruta</a> |
    <a href="/producto/1">Producto 1</a> |
    <a href="/producto/74">Producto 74</a> |
    <a href="<?= $router->generate('producto', ['id' => 11]); ?>">Producto 11</a>
  </p>
<?php $this->stop() ?>