<?php $this->layout('layouts/public', [
    //'router'    => $router,
    'mainTitle' => 'Home del proyecto',
]); ?>

<h1>Aloha desde HOME!!</h1>

<p>Cargado con LAYOUT-PUBLIC</p>

<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis quis quae ipsam itaque deleniti veniam pariatur magni accusamus, ut natus iusto tenetur dolorem consectetur officia dicta excepturi nihil soluta? Modi.</p>

<?php $this->insert('partials/some-markup', [
    'courseTitle'       => 'Aplicaciones Profesionales con PHP',
    'courseDescription' => 'Técnicas para desarrollar aplicaciones con PHP de manera profesional.',
]); ?>

<?php $this->start('footerLinks') ?>
  <p>
    <a href="/otra/carpeta">Otra ruta</a> |
    <a href="/producto/1">Producto 1</a> |
    <a href="/producto/74">Producto 74</a><!--  |
    <a href="<?//= $router->generate('producto', ['id' => 11]); ?>">Producto 11</a> -->
  </p>
<?php $this->stop() ?>